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

Route::get('user/getUser/{mail}/{password}', [DeviceController::class, 'getUser']);



Route::get('filter/getIdByIndustry/{name?}', [DeviceController::class, 'getIdByIndustry']);

Route::get('filter/getIdByHeadcount/{interval?}', [DeviceController::class, 'getIdByHeadcount']);
Route::get('filter/getIdByHeadquarters/{name?}', [DeviceController::class, 'getIdByHeadquarters']);
Route::get('filter/getIdBySeniority/{name?}', [DeviceController::class, 'getIdBySeniority']);
Route::get('filter/getIdByFunction/{name?}', [DeviceController::class, 'getIdByFunction']);  
Route::get('company/getCompanySearchByUserId/{user_id?}', [DeviceController::class, 'getCompanySearchByUserId']);
Route::get('people/getPeopleSearchByUserId/{user_id?}', [DeviceController::class, 'getPeopleSearchByUserId']);
Route::get('company/getCompanyLeadsBySearchId/{user_id?}', [DeviceController::class, 'getCompanyLeadsBySearchId']);
Route::get('people/getPeopleLeadsBySearchId/{user_id?}', [DeviceController::class, 'getPeopleLeadsBySearchId']);
Route::get('filter/getIndustryNames', [DeviceController::class, 'getIndustryNames']);


//POST REQUESTS
Route::post('user/postUser', [DeviceController::class, 'postUser']);
Route::post('people/newPeopleLeads', [DeviceController::class, 'newPeopleLeads']);
Route::post('company/newCompanyLeads', [DeviceController::class, 'newCompanyLeads']);
Route::post('people/newPeopleSearch', [DeviceController::class, 'newPeopleSearch']);
Route::post('company/newCompanySearch', [DeviceController::class, 'newCompanySearch']);
Route::post('phantom/updateAndLaunch', [DeviceController::class, 'updateAndLaunch']);
Route::post('phantom/fetcher', [DeviceController::class, 'fetcher']);
Route::post('phantom/download', [DeviceController::class, 'download']);

//test push to origin