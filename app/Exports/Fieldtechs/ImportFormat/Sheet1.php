<?php

namespace App\Exports\Fieldtechs\ImportFormat;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Sheet1 implements FromView, WithTitle, WithColumnFormatting
{
    private $vendors;
    private $teams;

    public function __construct($vendors, $teams)
    {
        $this->vendors = $vendors;
        $this->teams = $teams;
    }


    public function view(): View
    {
        $vendors = $this->vendors;
        $teams = $this->teams;

        return view('exports.excel.fieldtech.import_format.sheet1', [
            'vendors' => $vendors,
            'teams' => $teams,
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
