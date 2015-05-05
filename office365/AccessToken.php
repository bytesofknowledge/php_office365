<?php

namespace Office365;

class AccessToken extends ApiResource
{
	/**
	 * Access Token Id as base64 encoded string (2nd element returned in token_id key)
	 * @var string
	 */
	private $id;

	/**
	 * Redirect URI
	 * @var string
	 */
	private $redirectUri;

	/**
	 * Resource Base Url
	 * @var string
	 */
	private $resource;

	/**
	 * Custom request Url including tenant id
	 * @var string
	 */
	private $tokenUrl;

	/**
	 * Authorization Base Url
	 * @var string
	 */
	private $authorizationBaseUrl = 'https://login.microsoftonline.com';

	public function __construct($id) 
	{
		$this->id = $id;
		$this->redirectUri = Office365::getAuthorizationRedirectUrl();
		$this->resource = Office365::$resourceBaseUrl;
	}

	/**
	 * Retrieve Access Token
	 * @return array response from access token request
	 */
	public function retrieve() 
	{
		// parse token and get the tenant id. array key tid in response
		$parsedToken = $this->parse();
		$tenantId = $parsedToken['tid'];

		if ( $tenantId ) {
			// if we have a tenant id built the token url and generate the assertion
            $this->tokenUrl = $this->authorizationBaseUrl . '/' . $tenantId . '/oauth2/token';
            $assertion = new Assertion();
            $getAssertion = $assertion->get($this->tokenUrl);

            //build the post data array
            $queryParams = array(
			                'resource' => $this->resource,
			                'client_id' => Office365::getClientId(),
			                'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
			                'client_assertion' => $getAssertion,
			                'grant_type' => 'client_credentials',
			                'redirect_uri' => $this->redirectUri,
		                );

            //generate a new API request using the tokenUrl and post_form array
            $request = new HttpPost($this->tokenUrl);
	        $request->setPostData($queryParams);
	        $request->send();

	        $responseObj = json_decode($request->getHttpResponse());
	        return $responseObj;
        }
	}

	/**
	 * Parse and decode the tenant id from the Token_Id key
	 * @return array Decoded Token Id
	 */
	private function parse() 
	{
		try {
            $tokenParts = explode('.', $this->id);
            $decodedToken = $this->decode($tokenParts[1]);
        } catch (Exception $e) {
            return 'Invalid token value: ' . $tokenParts[1];
        }
        return json_decode($decodedToken, true);
	}
}
