<?php

namespace Office365;

class Office365
{

	/**
	 * Client Id generated from Azure application
	 * @var string
	 */
	public static $clientId;

	/**
	 * secret key generated from Azure application
	 * @var string
	 */
	public static $secret;

	/**
	 * thumbprint generated from X.509 certificate
	 * @var string
	 */
	public static $thumbprint;

	/**
	 * Office 365 API Version to use for requests
	 * @var string|null
	 */
	public static $apiVersion = '1.0';

	/**
	 * Base Url for Authorization request
	 * @var string
	 */
	public static $authorizationBaseUrl = 'https://login.windows.net/common/oauth2/authorize';

	/**
	 * Base Url for Resource
	 * @var string
	 */
	public static $resourceBaseUrl = 'https://outlook.office365.com/';

	/**
	 * Redirect Url 
	 * @var string
	 */
	public static $authorizationRedirectUrl;

    /**
     * Name of .pem private key file 
     * @var string
     */
    public static $privateKeyFileName = 'appcert';

	/**
	 * Verify SSL Defaults to true
	 * @var boolean
	 */
	public static $verifySslCerts = true;

	const VERSION = '1.0.0';

	/**
     * @return string The client id used for requests.
     */
    public static function getClientId()
    {
        return self::$clientId;
    }

    /**
     * Sets the client id to be used for requests.
     *
     * @param string $clientId
     */
    public static function setClientId($clientId)
    {
        self::$clientId = $clientId;
    }

    /**
     * @return string The secret key used for requests.
     */
    public static function getSecret()
    {
        return self::$secret;
    }

    /**
     * Sets the secret key to be used for requests.
     *
     * @param string $secret
     */
    public static function setSecret($secret)
    {
        self::$secret = $secret;
    }

    /**
     * @return string The thumbprint used for requests.
     */
    public static function getThumbprint()
    {
        return self::$thumbprint;
    }

    /**
     * Sets the thumbprint to be used for requests.
     *
     * @param string $thumbprint
     */
    public static function setThumbprint($thumbprint)
    {
        self::$thumbprint = $thumbprint;
    }

    /**
     * @return string The API version used for requests.
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    /**
     * @param string $apiVersion The API version to use for requests.
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }

    /**
     * @return boolean
     */
    public static function getVerifySslCerts()
    {
        return self::$verifySslCerts;
    }

    /**
     * @param boolean $verify
     */
    public static function setVerifySslCerts($verify)
    {
        self::$verifySslCerts = $verify;
    }

    /**
     * @return boolean
     */
    public static function getAuthorizationRedirectUrl()
    {
        return self::$authorizationRedirectUrl;
    }

    /**
     * @param boolean $verify
     */
    public static function setAuthorizationRedirectUrl($url)
    {
        self::$authorizationRedirectUrl = $url;
    }

}