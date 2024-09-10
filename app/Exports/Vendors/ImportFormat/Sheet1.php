<?php

namespace App\Exports\Vendors\ImportFormat;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Sheet1 implements FromView, WithTitle, WithColumnFormatting
{
    private $vendors;

    public function __construct($vendors)
    {
        $this->vendors = $vendors;
    }


    public function view(): View
    {
        $vendors = $this->vendors;

        return view('exports.excel.vendor.import_format.sheet1', [
            'vendors' => $vendors,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }

    public function title(): string
    {
        return 'DATA';
    }
}
