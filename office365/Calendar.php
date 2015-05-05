<?php

namespace Office365;

class Calendar extends ApiResource
{
	/**
	 * Retrieve 30 days of upcoming calendar events using the Calendar API's CalendarView
	 * @param  string $user user email address
	 * @return array CalendarView response
	 */
	public function retrieve($user) 
	{
		$accessToken = $_SESSION['access_token'];

		// Set the start of our view window to midnight of today.
		$date = new \DateTime('now');
		$start = $date->setTime(0,0,0);
		$startUrl = self::encodeDateTime($start);

		// Add 30 days to the start date to get the end date.
		$end = $start->add(new \DateInterval("P30D"));
		$endUrl = self::encodeDateTime($end);

		// Build the API request paramaters
		$queryParams  = "?"
		                 ."startDateTime=".$startUrl
		                 ."&endDateTime=".$endUrl
		                 ."&\$select=Subject,Start,End"
		                 ."&\$orderby=Start";
		
		// Build the API Base Url
		$url = Office365::$resourceBaseUrl . 'api/v' . Office365::$apiVersion 
				. '/users/' . $user . '/CalendarView/';

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
