<?php

namespace App\Console\Commands;

use App\Lottery;
use App\Providers\Screendoor;
use App\Seats;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class do_lottery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lotto:do';
    protected $lottery_results = array();
    protected $families = array();
    protected $processed_ids = array();
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the CHCS Lottery Process';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sd = new Screendoor(3448);
        $open_responses = $sd->get_all_responses();
        $grades = $this->create_grades($open_responses);
        $this->make_families($open_responses);

        foreach($grades as $key=>$val){
          $this->info($key . " Applicants: " 
                           . count($val));
        }
        foreach($grades as $key => $val)
        {
            $this->info("Processing $key");
            $this->process_grade($key, $val);
        }
        $this->show_results();
        $this->tell_screendoor($sd);
    }
    public function make_families($responses){
      //we're going to make a family to ids lookup table
      foreach($responses as $response){
        $families[$response->responder->email]
                 [$response->id] = $response;
      }
      $this->families = $families;
    }
    public function create_grades($responses)
    {
      foreach($responses as $response){
        $grades[$response->responses->{25703}][] = $response;
      }
      $grades[0] = $grades["K"];
      unset($grades["K"]);
      ksort($grades);
      return $grades;
    }
    public function process_grade($grade, $applicants){
      $this->info("Shuffling Applicants for $grade");
      $this->info("--------------------");
      shuffle($applicants);
      $i = 0;
      $threshold = Seats::where('grade',$grade)->first();
      
      foreach($applicants as $applicant){

        $this->info("Adding  " . $applicant->id . " To " . 
                $applicant->responses->{25703} . " Grade");
        $this->add_to_list($applicant," Directly Drawn.");
        //if the student has been drawn and is within 5 seats of the threshold, 
        //add their family members too
        if($i < $threshold->seats+5){
          $this->add_family_members($applicant);
        } 
      }
      $this->info("--------------------");
      return $grade;
    }
    public function add_family_members($applicant){

      if($applicant->responses->{25707} == "Yes"){
        $this->info("Family has indicated there are siblings");
        $siblings = $this->find_siblings($applicant);
        foreach($siblings as $sibling){
            $this->info("Adding Sibling " . $sibling->id . " To " . 
                $sibling->responses->{25703} . " Grade");
            $this->add_to_list($sibling, " Sibling of " . $applicant->id . 
                "(" . $applicant->responses->{25703} . ")");
        }
      }
      $this->info("No Siblings for this applicant");
    }
    public function find_siblings($applicant){
      return $this->families[$applicant->responder->email];
    }
    public function add_to_list($child, $notes = ""){
      if(in_array($child->id, $this->processed_ids)){
        $this->info("Child " . $child->id . " has already been placed. Not adding");
        return false;
      }
      $grade = $child->responses->{25703};
      $name  = $child->responses->{25701};
      $id    = $child->id;
      $this->lottery_results[$grade][] = ["id" => $id, "name" => $name, "notes" => $notes];
      $this->processed_ids[] = $id;
      return true;
    }
    public function show_results(){
      $this->info("Final Results");
      $this->info("-------------");
      foreach($this->lottery_results as $grade=>$applicants){
        $this->info("Enrollment for $grade");
        $this->info("---------------------");
        $i = 1;
        foreach($applicants as $student){
            $this->info($i . " " . $student["id"] . " " . $student['notes']);
            $student["pick_order"] = $i;
            $student["grade"] = $grade;
            $this->add_result_to_database($student);
            $i++;
        }
      }
    }
    public function add_result_to_database($result){
      $lottery = new Lottery();
      $lottery->grade = $result['grade'];
      $lottery->lotto_id = $result['id'];
      $lottery->pick_order = $result["pick_order"];
      $lottery->name = $result['name'];
      $lottery->notes = $result['notes'];
      $lottery->save();
    }
    public function tell_screendoor($sd){
      $bar = $this->output->createProgressBar(count($this->lottery_results));
      foreach($this->lottery_results as $grade=>$applicants){
        $i = 1;
        $applicant_bar = $this->output
                              ->createProgressBar(count($applicants));

        foreach($applicants as $applicant){
            $resp = $sd->update_response($applicant["id"],["27865" => (string)$i]);
            Log::info($resp->getBody());
            $i++;
            $applicant_bar->advance();
        }
        $applicant_bar->finish();
        $bar->advance();
      }
    }
}
