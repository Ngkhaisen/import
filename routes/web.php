<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetPropertyListingController;
use App\Http\Controllers\TenantedPropertyListingController;
use App\Http\Controllers\PersonalPropertyListingController;
use App\Http\Controllers\CompanyAssetListingController;
use App\Http\Controllers\OverseasPropertyListingController;
use App\Http\Controllers\HextarDatasheetController;


Route::get('/import-let-properties', [LetPropertyListingController::class, 'import']);
Route::get('/import-tenanted-properties', [TenantedPropertyListingController::class, 'import']);
Route::get('/import-personal-properties', [PersonalPropertyListingController::class, 'import']);
Route::get('/import-company-assets', [CompanyAssetListingController::class, 'import']);
Route::get('/import-overseas-properties', [OverseasPropertyListingController::class, 'import']);
Route::get('/import-hextar-datasheet', [HextarDatasheetController::class, 'import']);

Route::get('/', function () {
    return view('welcome');
});


