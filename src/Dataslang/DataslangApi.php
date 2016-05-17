<?php

namespace Dataslang;

use GuzzleHttp\Client;

class DataslangApi {
	
	const BASE_URI = 'http://api.dataslang.com';
	
	private $client = null;
	private $settings = array();
	private $timeout = 2.0;
  
	public function __construct(){
		$this->initSettings();
		$this->client = new Client($this->settings);
	}

	public function validate($xml, $xsd){
		$result = null;
		
		try {
		

			//     	$response = $this->client->request('POST', '/validate', [
			//         	'form_params' => [
			//             	'field_name' => 'abc',
			//             	'other_field' => '123',
			//             	'nested_field' => [
			//                 	'nested' => 'hello'
			//             	]
			//         	]
			//     	]);
			
			$response = $this->client->request('POST', '/validate', [
				'form_params' => [
					'parametro' => 'prova'
				]
			]);
			
			$result = $res->getBody();
			
		} catch (\Exception $e) {
			
		}
		
		return $result;
  	}
  
  	private function initSettings(){
  		$this->settings['base_uri'] = $this->getBaseUri();
  		$this->settings['timeout'] = $this->getTimeout();
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

}
