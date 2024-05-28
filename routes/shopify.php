<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallationController;

/*
|--------------------------------------------------------------------------
| Shopify Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('shopify')->group(function(){
    Route::get('auth',[InstallationController::class,'startInstallation']);
});

