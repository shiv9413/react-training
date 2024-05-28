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
    Route::get('auth/redirect',[InstallationController::class, 'handleRedirect'])->name('app_install_redirect');
});

