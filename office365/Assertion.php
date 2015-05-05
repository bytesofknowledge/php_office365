<?php

namespace Office365;

class Assertion extends ApiResource
{
	/**
	 * Algorithm
	 * @var string
	 */
	private $alg = 'RS256';

	/**
	 * Get Client Assertion
	 * Generates base64 Url safe client assertion
	 * @param  string $get_token_url
	 * @return string
	 */
	public function get($getTokenUrl) 
	{
		$clientAssertionHeader = array(
					                'alg' => $this->alg,
					                'x5t' => Office365::getThumbprint()
					            );

		$now = $this->now();

		$clientAssertionPayload = array(
									'sub' => Office365::getClientId(),
									'iss' => Office365::getClientId(),
									'jti' => self::nonce(),
									'exp' => $this->tenMinutesFromNow($now),
									'nbf' => $now,
									'aud' => $getTokenUrl
								);

		$assertionBlob = $this->getBlob($clientAssertionHeader, $clientAssertionPayload);
		$signature = $this->getSignature($assertionBlob);
		$clientAssertion = $assertionBlob . '.' . $signature;
        return $clientAssertion;
	}

	/**
	 * Encode and merge client assertion header and payload
	 * @param  array $header
	 * @param  array $payload
	 * @return string
	 */
	private function getBlob($header, $payload) 
	{
		$encodedHeader = $this->encode($this->toJson($header));
		$encodedPayload = $this->encode($this->toJson($payload));
        $assertionBlob = $encodedHeader . '.' . $encodedPayload;
        return $assertionBlob;
	}

	/**
	 * Retrieve private key and return encoded signature on message using RSA PKCSQ SHA-256 bit encryption
	 * @param  string $message
	 * @return string encoded signature
	 */
	public function getSignature($message) 
	{   
		// open and read private key file.
		try {
			$keyFileLocation = "office365/certificates/" . \Office365\Office365::$privateKeyFileName . ".pem";
	        $keyFile = fopen($keyFileLocation, "r");
	        if (empty($keyFile)) {
	        	throw new Exception('Unable to open certificate file at location: ' . $keyFile);
	        }
	        $privateKey = fread($keyFile, filesize($keyFileLocation));
	    } catch (Exception $e) {
	        throw $e;
	    }

	    // sign and encode message
		openssl_sign ($message, $signature, $privateKey, 'SHA256');
		$encodedSignature = $this->encode($signature);
		return $encodedSignature;
    }
}
