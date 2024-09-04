<?php

namespace App\Exports\Clients\ImportFormat;

use App\Models\Clients\Client;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Format implements WithMultipleSheets
{

    public function __construct() {}

    public function sheets(): array
    {
        $clients = Client::all();

        return [
            'DATA' => new Sheet1($clients),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} was skipped");
    }
}
