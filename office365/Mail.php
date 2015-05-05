<?php

namespace Office365;

class Mail extends ApiResource
{
	/** 
	 * Retrieve user emails using the Email API's Messages
	 * @param  string $user  user email address
	 * @param  int $count number of emails to request
	 * @param  string $order order in which to query emails (desc or asc)
	 * @return array Messages resposnse
	 */
	public function retrieve($user, $count='10', $order='desc') 
	{
		$accessToken = $_SESSION['access_token'];

		// Build the API request paramaters
		$queryParams = '?$select=
						From,
						Subject,
						DateTimeReceived
						&$orderby=DateTimeReceived
						%20' . $order .
						'&$top=' . $count;

		// Build the API Base Url
		$url = Office365::$resourceBaseUrl . 'api/v' . Office365::$apiVersion 
				. '/users/' . $user . '/Messages/';

		// Build the header object
        $headers = array(
		            	'Authorization: Bearer ' . $accessToken, 
		            	'Content-Type: application/json', 
		            	'Accept:application/json'
		        	);

        // generate a new API request and return the response as an array
        $request = new HttpPost ( $url . $queryParams );
        $request->setPostHeaders ( $headers );
        $request->send();

        $responseObj = json_decode($request->getHttpResponse ());
        return $responseObj;
	}

}
