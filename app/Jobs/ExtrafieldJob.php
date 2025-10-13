<?php

namespace App\Jobs;

use App\Libraries\BuildExtrafieldWo;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExtrafieldJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $wo_id;


    public function __construct($wo_id)
    {
        $this->wo_id = $wo_id;
    }

    public function handle()
    {
        BuildExtrafieldWo::build($this->wo_id);
    }
}
