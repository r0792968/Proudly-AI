<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\filter_industries;
use App\Models\filter_headcount;
use App\Models\filter_headquarter_location;
use App\Models\company_search;

class DeviceController extends Controller
{
    // GET REQUESTS
    public function getIdByIndustry($name = null)
    {
        if ($name) {
            $data = filter_industries::where('industry_name', $name)->select('ID')->first();
        } 
        else {
            $data = filter_industries::all('ID');
        }
    
        return response()->json($data);
    }

    public function getIdByHeadcount($interval = null)
    {
        if ($interval) {
            $data = filter_headcount::where('headcount_interval', $interval)->select('ID')->first();
        } 
        else {
            $data = filter_headcount::all('ID');
        }
    
        return response()->json($data);
    }
    public function getIdByHeadquarters($name = null)
    {
        if ($name) {
            $data = filter_headquarter_location::where('industry_name', $name)->select('ID')->first();
        } 
        else {
            $data = filter_headquarter_location::all('ID');
        }
    
        return response()->json($data);
    }

    // POST REQUESTS
  

    public function addData(Request $request)
    {
        $id = $request->input('id');
        $headcount = $request->input('headcount');
        $industry = $request->input('industry');
    
        $data = new company_search;
        $data->id = $id;
        $data->headcount = $headcount;
        $data->industry = $industry;

        $data->save();
    
        return response()->json(['message' => 'Data added successfully']);
    }
}
