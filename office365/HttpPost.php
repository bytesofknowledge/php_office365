<?php

namespace Office365;
 
class HttpPost 
{
    /**
     * Url
     * @var string
     */
    public $url;
    
    /**
     * post string
     * @var string
     */
    public $postString;
    
    /**
     * http response
     * @var string
     */
    public $httpResponse;
    
    /**
     * curl object
     * @var object
     */
    public $ch;
    
    public function __construct($url) 
    {
        $this->url = $url; 
    }
    
    public function __destruct() 
    {
        curl_close ( $this->ch );
    }

    /**
     * Set Post Data
     * @param array $params
     */
    public function setPostData($params) 
    {
        $this->ch = curl_init ( $this->url );
        curl_setopt ( $this->ch, CURLOPT_FOLLOWLOCATION, false );
        curl_setopt ( $this->ch, CURLOPT_HEADER, false );
        curl_setopt ( $this->ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $this->ch, CURLOPT_SSL_VERIFYPEER, true );

        $this->postString = rawurldecode ( http_build_query ( $params ) );
        curl_setopt ( $this->ch, CURLOPT_POST, true );
        curl_setopt ( $this->ch, CURLOPT_POSTFIELDS, $this->postString );
    }

    /**
     * Set Post Headers
     * @param array $headers
     */
    public function setPostHeaders($headers) 
    {
        $this->ch = curl_init();
        curl_setopt( $this->ch, CURLOPT_URL,$this->url );
        curl_setopt( $this->ch, CURLOPT_RETURNTRANSFER,true );
        curl_setopt( $this->ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $this->ch, CURLOPT_VERBOSE, true );
        curl_setopt( $this->ch, CURLINFO_HEADER_OUT, true );
    }
    
    /**
     * Send Request
     * @return string response
     */
    public function send() 
    {
        $this->httpResponse = curl_exec ( $this->ch );
    }
    
    /**
     * Get request response
     * @return string
     */
    public function getHttpResponse() 
    {
        return $this->httpResponse;
    }

    /**
     * Get Info for debugging requests
     * @return object
     */
    public function getInfo() 
    {
        return curl_getinfo($this->ch);
    }
}
