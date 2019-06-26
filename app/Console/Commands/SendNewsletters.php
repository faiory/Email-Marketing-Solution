<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Client;
use App\Schedule;
use App\Newsletter;

use App\Mail\NewsletterContent;;
// use App\Mail\WelcomeClient;
use Carbon\Carbon;


class SendNewsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendNewsletters';

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
     * @return mixed
     */
    public function handle()
    {
        // ITERATE ALL UNEXECUTED SCHEDULED NEWSLETTERS
        foreach (Schedule::where('executed', 'No')->get() as $schedule) {
            
            // COMPARE DIFFERENCE IN TIME
            $now = Carbon::now();
            $scheduleTime = Carbon::parse($schedule->execution_time);
            $diff = $scheduleTime->diffInMinutes($now);
            if ($diff < 2) {
                
                // GET ALL CLIENTS WITH MATCHING SUBGROUP AS SCHEDULE
                foreach (Client::where('subgroup_id', $schedule->subgroup_id)->get() as $client) {
                    if ($client->status->name == "Subscribed") {
                        
                        // SEND NEWSLETTER
                        \Mail::to($client)->send(new NewsletterContent($client, Newsletter::find($schedule->newsletter_id)));
                    }
                }

                // MODIFY TO EXECUTED AND SAVE
                $schedule->executed = "Yes";
                $schedule->save();
            }
        }
    }
}
