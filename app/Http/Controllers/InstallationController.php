<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class InstallationController extends Controller
{
    public function startInstallation(Request $request){
        /*
          1.New Installation
          2.Re-Installation
          3.Opening the app
        */  

        try {
            $validRequest = $this->vaildRequestFromShopify($request->all());
            if($validRequest){
                $shop = $request->has('shop');
                if($shop){
                    $storeDetails = $this->getStoreByName($request->shop);
                    if($storeDetails != null && $storeDetails != false){
                        /* 
                           store record exist and now determine whether the access token vaild or not
                           if not then forword them to re-installation flow
                           if yes then redirect them to login page 
                        */

                        $validAccessToken = $this->checkifAccessTokenIsValid($storeDetails);

                        if($validAccessToken){
                            // Token is valid for Shopify API Call so redirect them to login page.
                            
                        } else {
                            // Token is not valid so redirect the user to the re-installation phase
                        }
                    }
                } else throw new Exception("Shop paramter not present in app");
            } else throw new Exception("Request is not valid"); 
        } catch(Exception $e){
            \Log::info($e->getMessage().' '.$e->getLine());
            dd($e->getMessage());
        }
    }
}
