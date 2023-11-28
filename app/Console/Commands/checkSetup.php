<?php

namespace App\Console\Commands;

use App\Models\visitor;
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
        'ip_address' => '122.22.22.112',
        'visitor_date' => date('Y-m-d H:m:i'),
    ]);
        $this->info('Your command has been executed!');
        return 0;
    }
}
