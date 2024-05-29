<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Traits\FunctionTrait;
use App\Traits\RequestTrait;

class InstallationController extends Controller
{
    use FunctionTrait, RequestTrait;
    public function startInstallation(Request $request){
        /*
          1.New Installation
          2.Re-Installation
          3.Opening the app
        */  

        try {
            $validRequest = $this->vaildRequestFromShopify($request->all());
            if($validRequest) {
                $shop = $request->has('shop');
                if($shop) {
                    $storeDetails = $this->getStoreByDomain($request->shop);
                    if($storeDetails !== null && $storeDetails !== false) {
                        /* 
                           store record exist and now determine whether the access token vaild or not
                           if not then forword them to re-installation flow
                           if yes then redirect them to login page 
                        */

                        $validAccessToken = $this->checkifAccessTokenIsValid($storeDetails);

                        if($validAccessToken) {
                            // Token is valid for Shopify API Call so redirect them to login page.
                            print_r('Here is valid token part');exit;
                        } else {
                            // Token is not valid so redirect the user to the re-installation phase
                            print_r('Here is not an valid token part');exit;
                        }
                    } else {
                        // New installation flow should be carried out.
                        \Log::info('New Installation for shop '.$request->shop);
                        $endpoint = 'https://'.$request->shop.'/admin/oauth/authorize?client_id='.config('custom.shopify_api_key').'&scope='.config('custom.api_scopes').'&redirect_uri='.route('app_install_redirect');
                        return Redirect::to($endpoint);
                    }
                    
                } else throw new Exception("Shop paramter not present in the request");
            } else throw new Exception("Request is not valid"); 
        } catch(Exception $e) {
            \Log::info($e->getMessage().' '.$e->getLine());
            dd($e->getMessage().' '.$e->getLine());
        }
    }

    public function handleRedirect(Request $request){

    }

    private function vaildRequestFromShopify($request) {
        try {
            $ar= [];
            $hmac = $request['hmac'];
            unset($request['hmac']);

              foreach($request as $key=> $value){
                $key=str_replace("%","%25",$key);
                $key=str_replace("&","%26",$key);
                $key=str_replace("=","%3D",$key);
                $value=str_replace("%","%25",$value);
                $value=str_replace("&","%26",$value);
                $ar[] = $key."=".$value;
              }

              $str = implode('&',$ar);
              $ver_hmac =  hash_hmac('sha256',$str,config('custom.shopify_api_secret'),false);
              return $ver_hmac === $hmac;
        } catch(Exception $e) {
            \Log::info('Problem with verify hmac from request');
            \Log::info($e->getMessage().' '.$e->getLine());
            return false;
        }
    }

    /* 
        Write some code here that will use the Guzzel Library to fetch the shop object from shopify API
         If it success with 200 status then that means its valid and we can return true; 
    */

    private function checkifAccessTokenIsValid($storeDetails) {
        try {
            if($storeDetails !== null && isset($storeDetails->access_token)){
                $token = $storeDetails->access_token;
                $endpoint = getShopifyURLForStore('shop.json', $storeDetails);
                $headers = getShopifyHeadersForStore($storeDetails);
                $response = $this->makeAPICallToShopify('GET',$endpoint,null,$headers,null);
                \Log::info('Response the checking the validity of token');
                \Log::info($response);
                return $response['statusCode'] === 200;
            }
            return false;
        } catch(Exception $e){
            return false;
        }
    }
}
