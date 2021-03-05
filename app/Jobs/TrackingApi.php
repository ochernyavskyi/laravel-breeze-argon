<?php

namespace App\Jobs;

use App\Models\Tracking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class TrackingApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $server;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $server)
    {
        $this->request = $request;
        $this->server = $server;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Tracking::updateOrCreate(
            ['user_id' => Auth::id(),
                'user_agent' => $this->server['HTTP_USER_AGENT'],
                'ip' => $this->server["REMOTE_ADDR"],
                'product' => $this->request['product'],
                'country' => $this->request['country']])->increment('counter');
    }
}
