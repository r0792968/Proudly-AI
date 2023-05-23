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

Route::get('user/', [DeviceController::class, 'getUser']);



Route::get('getIdByIndustry', [DeviceController::class, 'getIdByIndustry']);

Route::get('getIdByHeadcount', [DeviceController::class, 'getIdByHeadcount']);
Route::get('getIdByHeadquarters', [DeviceController::class, 'getIdByHeadquarters']);
Route::get('getIdBySeniority', [DeviceController::class, 'getIdBySeniority']);
Route::get('getIdByFunction', [DeviceController::class, 'getIdByFunction']);
Route::get('getCompanySearchByUserId', [DeviceController::class, 'getCompanySearchByUserId']);
Route::get('getPeopleSearchByUserId', [DeviceController::class, 'getPeopleSearchByUserId']);
Route::get('getCompanyLeadsBySearchId', [DeviceController::class, 'getCompanyLeadsBySearchId']);
Route::get('getPeopleLeadsBySearchId', [DeviceController::class, 'getPeopleLeadsBySearchId']);
Route::get('getIndustryNames', [DeviceController::class, 'getIndustryNames']);
Route::get('getHeadcount', [DeviceController::class, 'getHeadcount']);
Route::get('getHeadquarters', [DeviceController::class, 'getHeadquarters']);



//POST REQUESTS
Route::post('user', [DeviceController::class, 'postUser']);
Route::post('newPeopleLeads', [DeviceController::class, 'newPeopleLeads']);
Route::post('newCompanyLeads', [DeviceController::class, 'newCompanyLeads']);
Route::post('newPeopleSearch', [DeviceController::class, 'newPeopleSearch']);
Route::post('newCompanySearch', [DeviceController::class, 'newCompanySearch']);
Route::post('phantom/updateAndLaunch', [DeviceController::class, 'updateAndLaunch']);
Route::post('phantom/fetcher', [DeviceController::class, 'fetcher']);


//test push to origin