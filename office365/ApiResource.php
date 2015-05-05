<?php

namespace Office365;

use Rhumsaa\Uuid\Uuid as Uuid;

abstract class ApiResource
{
    /**
     * Encode data base64 Url safe
     * 
     * @param  string|array
     * @return string encoded string
     */
	protected function encode($data) 
    {
    	return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Decode base64 string
     * 
     * @param  string $base64data
     * @return string
     */
	protected function decode($base64data) 
    {
        return base64_decode($base64data);
    }

    /**
     * Create a UNIX epoch time value for now - 5 minutes
     * 
     * @return int
     */
    protected function now() 
    {
    	return (int)time() - 300;
    }

    /**
     * Create a UNIX epoch time value for now + 10 minutes
     * 
     * @param  int $now UNIX epoch time value
     * @return int
     */
    protected function tenMinutesFromNow($now) 
    {
    	return $now + 900;
    }

    /**
     * Json encode
     * 
     * @param  array $array
     * @return string|false
     */
    protected function toJson($array) 
    {
    	return json_encode($array);
    }

    /**
     * Create nonce value as a version 4 (random) UUID object
     * 
     * @return string
     */
    protected static function nonce() 
    {
        $uuid4 = Uuid::uuid4();
        return $uuid4->toString();
    }

    /**
     * Converts dateTime from local TZ to UTC
     * Returns dateTime in format expected by the Outlook API
     * 
     * @param  dateTime $dateTime
     * @return dateTime
     */
    protected static function encodeDateTime($dateTime) 
    {
      $utcDateTime = $dateTime->setTimeZone(new \DateTimeZone("UTC"));
      $dateFormat = "Y-m-d\TH:i:s\Z";
      return date_format($utcDateTime, $dateFormat);
    }
}
