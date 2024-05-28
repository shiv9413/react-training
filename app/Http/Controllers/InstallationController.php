<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Traits\FunctionTrait;

class InstallationController extends Controller
{
    use FunctionTrait;
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
                        print_r('new installation begin here');exit;
                    }
                    
                } else throw new Exception("Shop paramter not present in the request");
            } else throw new Exception("Request is not valid"); 
        } catch(Exception $e) {
            \Log::info($e->getMessage().' '.$e->getLine());
            dd($e->getMessage().' '.$e->getLine());
        }
    }

    private function vaildRequestFromShopify($request) {
        return true;
    }

    private function checkifAccessTokenIsValid($storeDetails) {

    }
}
