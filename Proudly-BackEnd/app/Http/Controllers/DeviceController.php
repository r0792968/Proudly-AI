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
use Exception;
use GuzzleHttp\Client;



class DeviceController extends Controller
{
    // GET REQUESTS
    public function getUser($mail,$password){
        $password = hash("sha256",$password);
        $data = users::where('mail', $mail)->where('password', $password)->first();
        if($data){
            return response()->json($data);
        }
        else{
            return response()->json("user not found");
        }
    }


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
  

    public function newCompanyLeads(Request $request){
        
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

    public function newPeopleLeads(Request $request){
            
            $full_name = $request->input('full_name');
            $company_name = $request->input('company_name');
            $company_id = $request->input('company_id');
            $regular_company_url = $request->input('regular_company_url');
            
            
            $title = $request->input('title');
            $mail = $request->input('mail');
            $person_url = $request->input('person_url');
            $connection_degree = $request->input('connection_degree');
            $company_location = $request->input('company_location');
            $person_location = $request->input('person_location');
            $search_id = $request->input('search_id');
            
    
            $data = new people_leads;
            $data->search_id = $search_id;
            $data->company_name = $company_name;
            $data->company_id = $company_id;
            $data->regular_company_url = $regular_company_url;
            $data->full_name = $full_name;
            $data->person_url = $person_url;
            $data->title = $title;
            $data->mail = $mail;
            $data->connection_degree = $connection_degree;
            $data->company_location = $company_location;
            $data->person_location = $person_location;
          
            $data->save();
    
        return response()->json(['message' => 'Data added successfully']);
    }
   public function postUser(Request $request){
        
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');
    
        $data = new users;
        
        $data->username = $username;
        $data->mail = $mail;
        $data->password = hash("sha256",$password);
        $data->is_admin = 0;


        $data->save();
    
        return response()->json(['message' => 'Data added successfully']);
    }
    public function newCompanySearch(Request $request){
        
        $user_id = $request->input('user_id');
        $anual_revenue = $request->input('anual_revenue');
        $headcount = $request->input('headcount');
        $industry = $request->input('industry');
        $geography = $request->input('geography');
    
        $data = new company_search;
        
        $data->user_id = $user_id;
        $data->anual_revenue = $anual_revenue;
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

    //phantom Buster requests

    function updateAndLaunch(Request $request) {
       
        $address = $request->input('address');
        $id = '864520330260797';
        $name = 'Proudly';
        $key = '056OL29RRtKkfikDIAslL7lytVsODwK3Z5xLsoTDy7Q';
       
        // Update function
        $updateUrl = 'https://api.phantombuster.com/api/v2/agents/save';
        $updateData = array(
            'id' => $id,
            'name' => $name,
            'proxyAddress' => $address
        );
        $updateHeaders = array(
            'Content-Type: application/json',
            'X-Phantombuster-Key: ' . $key
        );
        $updateOptions = array(
            'http' => array(
                'header' => $updateHeaders,
                'method' => 'POST',
                'content' => json_encode($updateData)
            )
        );
        $updateContext = stream_context_create($updateOptions);
        $updateResponse = file_get_contents($updateUrl, false, $updateContext);
    
        if ($updateResponse === false) {
            // Handle error
            echo "Error occurred during update API call";
            return;
        }
    
        // // Launch function
        // $launchUrl = 'https://api.phantombuster.com/api/v2/agents/launch';
        // $launchData = array(
        //     'id' => $id
        // );
        // $launchHeaders = array(
        //     'Content-Type: application/json',
        //     'X-Phantombuster-Key: ' . $key
        // );
        // $launchOptions = array(
        //     'http' => array(
        //         'header' => $launchHeaders,
        //         'method' => 'POST',
        //         'content' => json_encode($launchData)
        //     )
        // );
        // $launchContext = stream_context_create($launchOptions);
        // $launchResponse = file_get_contents($launchUrl, false, $launchContext);
    
        // if ($launchResponse === false) {
        //     // Handle error
        //     echo "Error occurred during launch API call";
        //     return;
        // }
    
        // // Handle response
        // $updateResponse = json_decode($updateResponse, true);
        // $launchResponse = json_decode($launchResponse, true);
    
        // echo "Update API response: " . print_r($updateResponse, true) . "\n";
        // echo "Launch API response: " . print_r($launchResponse, true) . "\n";

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'API call executed successfully'
        // ]);
    }
    
    
    // Fetcher function
    function fetcher() {
        
       
    
      
        // require_once('vendor/autoload.php');

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.phantombuster.com/api/v2/agents/fetch?id=864520330260797', [
        'headers' => [
            'X-Phantombuster-Key' => '056OL29RRtKkfikDIAslL7lytVsODwK3Z5xLsoTDy7Q',
            'accept' => 'application/json',
        ],
        ]);

        $responseBody = json_decode($response->getBody(), true);

        // Store the s3Folder and orgs3Folder values in variables
        $s3Folder = $responseBody['s3Folder'];
        $orgs3Folder = $responseBody['orgS3Folder'];
        
        // You can do further processing or return the values as needed
        
        $url = "https://phantombuster.s3.amazonaws.com/{$orgs3Folder}/{$s3Folder}/result.json";
  
        $data = file_get_contents($url);

        if ($data === false) {
            // Error handling if the request fails
            echo "Failed to fetch data from the URL.";
          } else {
            $jsonData = json_decode($data);
        
            if ($jsonData === null) {
              // Error handling if JSON decoding fails
              echo "Failed to decode JSON data.";
            } else {
              // Process the decoded JSON data
              var_dump($jsonData);
            }
          }
    }  

    public function download(){
        
    }

    
    // Example usage
    // $key = '056OL29RRtKkfikDIAslL7lytVsODwK3Z5xLsoTDy7Q';
    // $id = '864520330260797';
    // $name = 'Proudly';
    // $address = 'https://www.linkedin.com/sales/search/company?query=(filters%3AList((type%3AANNUAL_REVENUE%2CrangeValue%3A(min%3A1%2Cmax%3A100)%2CselectedSubFilter%3AUSD)%2C(type%3ACOMPANY_HEADCOUNT%2Cvalues%3AList((id%3AD%2Ctext%3A51-200%2CselectionType%3AINCLUDED)))))&sessionId=LFGMh86aSfic4RnHsrulRQ%3D%3D&viewAllFilters=true';
    
    // updateAndLaunch($address, $id, $name, $key);
    

}
