<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

class DataslangApi {
  
  public function __construct(){
    $this->client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'http://api.dataslang.com',
        // You can set any number of default request options.
        'timeout'  => 2.0,
    ]);
}

  public function validate($xml, $xsd){
    $b = false;
    $response = $this->client->request('POST', '/validate', [
        'form_params' => [
            'field_name' => 'abc',
            'other_field' => '123',
            'nested_field' => [
                'nested' => 'hello'
            ]
        ]
    ]);
  return $b;
  }

}
