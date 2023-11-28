<?php

namespace App\Console\Commands;

use App\Http\Controllers\StravaController;
use App\Models\stravauserauth;
use App\Models\userfetchlog;
use App\Models\visitor;
use DateTime;
use Exception;
use Illuminate\Console\Command;

class checkSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $visitor = visitor::create([
        'ip_address' => 'started cron',
        'visitor_date' => date('Y-m-d H:m:i'),
        ]);

        $userObj = stravauserauth::orderBy('user_id', 'asc')->get(['user_id']);
        foreach($userObj as $uKey => $vVlu){

            $ugobj = new userfetchlog();
            $ugobj->user_id = $vVlu->user_id;
            $ugobj->update_date = new DateTime();
            $ugobj->save();
            $jsonerror = [];
            try{
                $stObj = new StravaController();
                $stObj->fetch_data($vVlu->user_id,'cron');
            }catch(Exception $ex){
                dump( $ex);
                $jsonerror=json_encode($ex);
                $visitor = visitor::create([
                    'ip_address' => 'error in cron',
                    'visitor_date' => date('Y-m-d H:m:i'),
                    'json_data'=>$jsonerror
                ]);
            }
        }
        $visitor = visitor::create([
            'ip_address' => 'started end',
            'visitor_date' => date('Y-m-d H:m:i'),
            'json_data'=>$jsonerror
        ]);

        // $this->info('Your command has been executed!');
        return 0;
    }
}
