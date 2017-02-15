<?php

namespace App\Console\Commands;

use App\Providers\Screendoor;
use Illuminate\Console\Command;

class find_dupes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lotto:dupes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'find duplicates in the database';

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
        $responses = $sd->get_all_responses();
        $this->find_dupes($responses);
    }
    public function find_dupes($responses){
      //create a kvp of IDs, names of children, and parents names
      $names = array();
      foreach($responses as $response){
        $names[] = ["id" => $response->id, "name" =>
                    preg_replace("#[[:punct:]]#","",
                    $response->responses->{25701})];
        $names = collect($names);
        $groupedNames = $names->groupBy('name');
        foreach($groupedNames as $key => $val){
            if(count($val) > 1){
                $this->info("$key: " . count($val));
            }
        }
      }
    }
}
