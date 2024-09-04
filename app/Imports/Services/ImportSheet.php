<?php

namespace App\Imports\Services;

use App\Models\Clients\Client;
use App\Models\Masters\Master;
use App\Models\Services\Service;
use App\Models\Sites\Site;
use App\Models\Vendors\Vendor;
use App\Models\WorkOrders\Action;
use App\Models\WorkOrders\WorkOrder;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportSheet implements ToCollection, WithChunkReading
{
    public $logs = [];
    private $user = null;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function collection(Collection $rows)
    {
        $startLine = 4;
        $totalRow = 0;
        $totalSuccess = 0;
        $totalError = 0;
        $log = [];

        for ($i = $startLine; $i < count($rows); $i++) {
            $error = null;

            $data = (object) [
                'name' => $rows[$i][0],
                'alias' => $rows[$i][1],
                'description' => $rows[$i][2],
            ];

            if (!$data->name) {
                $error = "Name Not Found";
            } elseif (!$data->alias) {
                $error = "Alias Not Found";
            } elseif (!$data->description) {
                $error = "Description Not Found";
            } else {
                DB::beginTransaction();
                try {
                    Service::create((array) $data);

                    DB::commit();
                    $totalSuccess++;
                } catch (QueryException $e) {
                    DB::rollback();
                    $error = $e->getMessage();
                }
            }

            if ($error) {
                $log[] = [
                    'row' => ($i + 1),
                    'success' => false,
                    'message' => $error
                ];
                $totalError++;
            }

            $totalRow++;
        }

        $this->logs = [
            'totalRow' => $totalRow,
            'totalSuccess' => $totalSuccess,
            'totalError' => $totalError,
            'errorLog' => $log
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
