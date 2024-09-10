<?php

namespace App\Exports\Fieldtechs\ImportFormat;

use App\Exports\Sites\ImportFormat\Sheet2;
use App\Models\Fieldteches\Fieldtech;
use App\Models\Vendors\Vendor;
use App\SystemModels\Auth\User;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Format implements WithMultipleSheets
{

    public function __construct() {}

    public function sheets(): array
    {
        $vendors = Vendor::all();
        $teams = Fieldtech::all();

        return [
            'DATA' => new Sheet1($vendors, $teams),
            'AREA' => new Sheet2($vendors),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} was skipped");
    }
}
