<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dummyApi;
use App\Http\Controllers\DeviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// GET REQUESTS

Route::get('getUser/{mail}/{password}', [DeviceController::class, 'getUser']);



Route::get('getIdByIndustry/{name?}', [DeviceController::class, 'getIdByIndustry']);

Route::get('getIdByHeadcount/{interval?}', [DeviceController::class, 'getIdByHeadcount']);
Route::get('getIdByHeadquarters/{name?}', [DeviceController::class, 'getIdByHeadquarters']);
Route::get('getIdBySeniority/{name?}', [DeviceController::class, 'getIdBySeniority']);
Route::get('getIdByFunction/{name?}', [DeviceController::class, 'getIdByFunction']);  
Route::get('getCompanySearchByUserId/{user_id?}', [DeviceController::class, 'getCompanySearchByUserId']);
Route::get('getPeopleSearchByUserId/{user_id?}', [DeviceController::class, 'getPeopleSearchByUserId']);
Route::get('getCompanyLeadsBySearchId/{user_id?}', [DeviceController::class, 'getCompanyLeadsBySearchId']);
Route::get('getPeopleLeadsBySearchId/{user_id?}', [DeviceController::class, 'getPeopleLeadsBySearchId']);


//POST REQUESTS
Route::post('postUser', [DeviceController::class, 'postUser']);

//test push to origin