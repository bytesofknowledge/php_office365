<?php

namespace Office365;

class Authorize extends ApiResource
{
    /**
     * Retrieve Authorize Url
     * @return string
     */
    public static function retrieve()
    {
        return self::authorizeUrl();
    }

    /**
     * Generate authorize url for admin consent SSO
     * @return string
     */
	public static function authorizeUrl() 
	{
		$queryParams = array (
                            'client_id' => Office365::getClientId(),
                            'redirect_uri' => Office365::getAuthorizationRedirectUrl(),
                            'response_type' => 'code id_token',
                            'scope' => 'openid',
                            'nonce' => self::nonce(),
                            'prompt' => 'admin_consent',
                            'response_mode' => 'form_post',
                            'resource' => Office365::$resourceBaseUrl
                        );

        $auth_url = Office365::$authorizationBaseUrl . '?' . http_build_query( $queryParams );
        return $auth_url;
	}
}
