<?php

namespace App\Exports\Vendors\ImportFormat;

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

        return [
            'DATA' => new Sheet1($vendors),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} was skipped");
    }
}
