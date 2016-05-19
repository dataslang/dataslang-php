<?php

namespace Dataslang;

use GuzzleHttp\Client;

class DataslangApi {
	
	const BASE_URI = 'http://api.dataslang';
	
	private $client = null;
	private $settings = array();
	private $timeout = 7;

	public function validate($xml, $xsd){
		$result = null;

		try {
			
			$client = $this->getClient();
			$response = $client->request('POST', '/xml/validate', [
				'form_params' => [
					'xml' => urlencode($xml),
					'xsd' => urlencode($xsd)
				]
			]);
			
			$result = $response->getBody();
			
		} catch (\Exception $e) {

		}
		
		return $result;
  	}
  	
  	public function transformToXml($xml){
  		$result = null;
  		
  		try {
  				
  			$client = $this->getClient();
  			$response = $client->request('POST', '/xml/transform/xml', [
  				'form_params' => [
  					'xml' => urlencode($xml)
  				]
  			]);
  				
  			$result = $response->getBody();
  				
  		} catch (\Exception $e) {

  		}
  		
  		return $result;
  	}
  	
  	public function transformToHtml($xml, $xsl, $dest_path){
  		$result = null;
  		
  		try {
  		
  			$client = $this->getClient();
  			$response = $client->request('POST', '/xml/transform/html', [
				'form_params' => [
					'xml' => urlencode($xml),
					'xsl' => urlencode($xsl),
					'dest_path' => urlencode($dest_path)
				]
  			]);
  		
  			$result = $response->getBody();
  		
  		} catch (\Exception $e) {

  		}
  		
  		return $result;
  	}
  
  	/**
  	 * 
  	 * @param int $timeout
  	 */
	public function setTimeout($timeout){
		$this->timeout = $timeout;
	}
	
	/**
	 * 
	 * @return int $timeout
	 */
	public function getTimeout(){
		return $this->timeout;
	}
	
	/**
	 * 
	 * @return string BASE_URI
	 */
	public function getBaseUri(){
		return self::BASE_URI;
	}
	
	/**
	 * 
	 * @return \GuzzleHttp\Client
	 */
	private function getClient(){
		$settings = array();
		$settings['base_uri'] = $this->getBaseUri();
		$settings['timeout'] = $this->getTimeout();
		
		return new Client($settings);
	}

}
