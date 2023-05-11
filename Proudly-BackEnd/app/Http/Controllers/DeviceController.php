<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\company_leads;
use Illuminate\Http\Request;
use App\Models\filter_industries;
use App\Models\filter_headcount;
use App\Models\filter_headquarter_location;
use App\Models\filter_seniority;
use App\Models\filter_function; 
use App\Models\people_search;
use App\Models\people_leads;
use App\Models\company_search;
use App\Models\users;

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

    public function getIdBySeniority($name = null)
    {
        if ($name) {
            $data = filter_seniority::where('seniority_name', $name)->select('ID')->first();
        } 
        else {
            $data = filter_seniority::all('ID');
        }
    
        return response()->json($data);
    }
    public function getIdByFunction($name = null)
    {
        if ($name) {
            $data = filter_function::where('function_name', $name)->select('ID')->first();
        } 
        else {
            $data = filter_function::all('ID');
        }
    
        return response()->json($data);
    }   
    
    public function getCompanySearchByUserId($user_id = null)
    {
        if ($user_id) {
            $data = company_search::all()->where('user_id', $user_id);
        } 
        else {
            $data = "user not found";
        }
    
        return response()->json($data);
    }
    public function getCompanyLeadsBySearchId($search_id = null)
    {
        if ($search_id) {
            $data = company_leads::all()->where('search_id', $search_id);
        } 
        else {
            $data = "search not found";
        }
    
        return response()->json($data);
    }
    public function getPeopleSearchByUserId($user_id = null){
        if ($user_id) {
            $data = people_search::all()->where('user_id', $user_id);
        } 
        else {
            $data = "user not found";
        }
    
        return response()->json($data);
    }

    public function getPeopleLeadsBySearchId($search_id = null){
        if ($search_id) {
            $data = people_leads::all()->where('search_id', $search_id);
        } 
        else {
            $data = "search not found";
        }
    
        return response()->json($data);
    }

    // POST REQUESTS
  

    public function newCompanyLead(Request $request){
        
        $search_id = $request->input('search_id');
        $name = $request->input('name');
        $company_url = $request->input('company_url');
        $description = $request->input('description');
        $company_id = $request->input('company_id');
        
        $headcount = $request->input('headcount');

        $data = new company_leads;
        $data->search_id = $search_id;
        $data->name = $name;
        $data->company_url = $company_url;
        $data->description = $description;
        $data->company_id = $company_id;
        
        $data->headcount = $headcount;
        $data->save();
    
        return response()->json(['message' => 'Data added successfully']);
    }

    // public function newPeopleLead(Request $request){
            
    //         $search_id = $request->input('search_id');
    //         $full_name = $request->input('full_name');
    //         $people_linkedin_url = $request->input('people_linkedin_url');
    //         $people_job_title = $request->input('people_job_title');
    //         $people_job_function = $request->input('people_job_function');
    //         $people_job_seniority = $request->input('people_job_seniority');
    //         $people_job_location = $request->input('people_job_location');
    //         $people_company_name = $request->input('people_company_name');
    //         $people_company_linkedin_url = $request->input('people_company_linkedin_url');
    //         $people_company_website = $request->input('people_company_website');
    //         $people_company_industry = $request->input('people_company_industry');
    //         $people_company_headquarter_location = $request->input('people_company_headquarter_location');
    //         $people_company_headcount = $request->input('people_company_headcount');
    
    //         $data = new people_leads;
    //         $data->search_id = $search_id;
    //         $data->full_name = $full_name;
    //         $data->people_linkedin_url = $people_linkedin_url;
    //         $data->people_job_title = $people_job_title;
    //         $data->people_job_function = $people_job_function;
    //         $data->people_job_seniority = $people_job_seniority;
    //         $data->people_job_location = $people_job_location;
    //         $data->people_company_name = $people_company_name;
    //         $data->people_company_linkedin_url = $people_company_linkedin_url;
    //         $data->people_company_website = $people_company_website;
    //         $data->people_company_industry = $people_company_industry;
    //         $data->people_company_headquarter_location = $people_company_headquarter_location;
    //         $data->people_company_headcount = $people_company_headcount;
    //         $data->save();
    
    //     return response()->json(['message' => 'Data added successfully']);
    // }
   public function newUser(Request $request){
        
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
    
        $data = new users;
        
        $data->name = $name;
        $data->email = $email;
        $data->password = $password;

        $data->save();
    
        return response()->json(['message' => 'Data added successfully']);
    }
    public function newCompanySearch(Request $request){
        
        $user_id = $request->input('user_id');
        $headcount = $request->input('headcount');
        $industry = $request->input('industry');
        $geography = $request->input('geography');
    
        $data = new company_search;
        
        $data->user_id = $user_id;
        $data->headcount = $headcount;
        $data->industry = $industry;
        $data->geography = $geography;

        $data->save();
    
        return response()->json(['message' => 'Data added successfully']);
    }
    public function newPeopleSearch(Request $request){
        $user_id = $request->input('user_id');
       
        $job_function = $request->input('function');
        $job_seniority = $request->input('seniority');
        $current_company = $request->input('current_company');

        $data = new people_search;
        $data->user_id = $user_id;
        $data->function = $job_function;
        $data->seniority = $job_seniority;
        $data->current_company = $current_company;
        $data->save();
    
        return response()->json(['message' => 'Data added successfully']);

    }

}
