<?php

namespace App\Traits;
use Exception;
use GuzzelHttp\Client;

trait RequestTrait {
	public function makeAPICallToShopify($method = 'GET', $url, $url_params = null, $headers, $requestBody =  null){
		//Headers
		/*
		  Content-Type: application/json
		  X-Shopify-Access-Token: value
		*/
		  try{
		  	$client = new Client();
		  	$response = null;
		  	switch($method){
		  		case 'GET' : $response = $client->request($method,$url,['headers'=> $headers]); break;
		  	}
			$response = $client->request($method, $url);
			return [
				'statuscode' => $response->getStatusCode(),
				'body' => $response->getBody(),
			];
		  } catch(Exception $e){
		  	 return [
		  	 	'statuscode' => $e->getCode(),
		  	 	'message' => $e->getMessage(),
		  	 	'body' => null
		  	 ];
		  }
	}
}