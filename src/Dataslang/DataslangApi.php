<?php

namespace Dataslang;

use GuzzleHttp\Client;

class DataslangApi {
	
	const BASE_URI = 'http://api.dataslang.com';
	
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
					'xsd' => urlencode($xsd),
					'response-type' => urlencode('txt')
				]
			]);
			
			$result = $response->getBody();
			
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		
		return $result;
  	}
  	
  	public function transformToXml($xml, $xsl, $dest_path){
  		$result = null;
  		
  		try {
  				
  			$client = $this->getClient();
  			$response = $client->request('POST', '/xml/transform/xml', [
  				'form_params' => [
  					'xml' => urlencode($xml),
  					'xsl' => urlencode($xsl),
  					'dest_path' => urlencode($dest_path),
  					'response-type' => urlencode('txt')
  				]
  			]);
  				
  			$result = $response->getBody();
  				
  		} catch (\Exception $e) {
  			$result = $e->getMessage();
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
					'dest_path' => urlencode($dest_path),
					'response-type' => urlencode('txt')
				]
  			]);
  		
  			$result = $response->getBody();
  		
  		} catch (\Exception $e) {
  			$result = $e->getMessage();
  		}
  		
  		return $result;
  	}
  
	public function setTimeout($timeout){
		$this->timeout = $timeout;
	}
	
	public function getTimeout(){
		return $this->timeout;
	}
	
	public function getBaseUri(){
		return self::BASE_URI;
	}
	
	private function getClient(){
		if ($this->client === null){
			$settings = array();
			$settings['base_uri'] = $this->getBaseUri();
			$settings['timeout'] = $this->getTimeout();
		
			$this->client = new Client($settings);
		}
		
		return $this->client;
	}
}
