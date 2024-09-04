<?php

namespace App\Exports\Clients\ImportFormat;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Sheet1 implements FromView, WithTitle, WithColumnFormatting
{
    private $clients;

    public function __construct($clients)
    {
        $this->clients = $clients;
    }

    public function view(): View
    {
        $clients = $this->clients;

        return view('exports.excel.client.import_format.sheet1', [
            'clients' => $clients,
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
