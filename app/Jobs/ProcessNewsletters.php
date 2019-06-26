<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        foreach (Schedule::All() as $schedule) {

            $now = Carbon::now();
            $scheduleTime = Carbon::parse($schedule->execution_time);
            $diff = $scheduleTime->diffInMinutes($now);

            if ($diff < 2) {
                // GET ALL CLIENTS
                echo "diff < 2 minutes \n";
                $schedule->delete();
                // foreach (Client::where('subgroup_id', $schedule->subgroup_id)->get() as $client) {
                //     echo $client->email . "\n";
                //     echo "hey \n";
                // }
            }
        }
    }
}
