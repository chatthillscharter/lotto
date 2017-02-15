<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
class Screendoor extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public $api_key;
    public $project_id;
    private $client;
    private $screendoor_url = 'https://screendoor.dobt.co/api';
    public function __construct($project_id){
      $this->api_key = env('SCREENDOOR_KEY');
      $this->project_id = $project_id;
      $this->client = new Client();
    }
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function get_responses($page=1,$status="Open"){
      //GET /projects/:project_id/responses
      $responses = $this->getUrl('/projects/' . 
                            $this->project_id . 
                          '/responses?status='. $status .'&page='.$page .'&');
      if(count($responses) == 0)
        return false;
      return $responses;
    }
    public function make_url($string){
      return $this->screendoor_url . $string . 
      "v=0&api_key=" . $this->api_key;
    }
    public function getUrl($string){
      $url = $this->make_url($string);
      $response = $this->client->get($url);
      return json_decode($response->getBody());
    }
    public function postUrl($vars){
        //
      
    }
    public function update_response($response, $fields){
      $url = $this->make_url("/projects/" . $this->project_id . 
                            "/responses/" . $response ."?");
      $fields = ["response_fields" => $fields];
      $response = $this->client->request('PUT', $url,
                ['json' => $fields]);
      return $response;
    }

    public function get_all_responses(){
      $i = 1;
      $all_responses = array();
      while($i>0){
        if($responses = $this->get_responses($i)){
            $all_responses = array_merge($all_responses,$responses);
            $i++;
        } else {
            return collect($all_responses);
        }
      }
    }
}
