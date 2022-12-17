<?php
namespace App\Exports\Sites\ImportFormat;

use App\Models\Clients\Client;
use App\Models\Services\Service;
use App\Models\Vendors\Vendor;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Format implements WithMultipleSheets {

    public function __construct(){

    }

    public function sheets(): array {
        $vendors = Vendor::all();
        $clients = Client::all();
        $services = Service::all();

        return [
            'DATA' => new Sheet1($vendors, $clients, $services),
            'AREA' => new Sheet2($vendors),
            'CLIENT' => new Sheet3($clients),
            'SERVICE' => new Sheet4($services),
        ];
    }

    public function onUnknownSheet($sheetName) {
        info("Sheet {$sheetName} was skipped");
    }
}
