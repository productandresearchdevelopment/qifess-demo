<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WorkOrders\WorkOrderOngoing;

class CleanWoOngoing extends Command
{
    protected $signature = 'clean:woongoing';
    protected $description = 'Hapus data dari WoOngoing jika sudah memiliki close_date';

    public function handle()
    {
        $workOrders = WorkOrderOngoing::whereNotNull('close_date')->get();

        $count = $workOrders->count();

        foreach ($workOrders as $wo) {
            $wo->forceDelete();
        }

        $this->info("data close_date not null telah dihapus secara permanen dari WoOngoing.");
    }
}
