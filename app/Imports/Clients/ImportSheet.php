<?php

namespace App\Imports\Clients;

use App\Models\Clients\Client;
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
        $startLine = 3;
        $totalRow = 0;
        $totalSuccess = 0;
        $totalError = 0;
        $log = [];

        for ($i = $startLine; $i < count($rows); $i++) {

            if ($customerId = $rows[$i][0]) {
                $error = null;
                $uid = $this->user->id;

                $data = (object) [
                    'customer_id' => $customerId,
                    'name' => $rows[$i][1],
                    'alias' => $rows[$i][2],
                    'address' => $rows[$i][3],
                    'email' => $rows[$i][4],
                    'phone' => $rows[$i][5],
                    'description' => $rows[$i][6],
                    'created_by' => $uid,
                    'updated_by' => $uid,
                ];

                if (Client::where('customer_id', $customerId)->exists()) {
                    $error = "Duplicate Customer ID ($customerId)";
                } else if (!$data->name) {
                    $error = "Client Name Not Found";
                } else {
                    DB::beginTransaction();
                    try {
                        $client = Client::create((array) $data);

                        if ($client) {
                            DB::commit();
                            $totalSuccess++;
                        } else {
                            DB::rollback();
                            $error = "Failed to create client.";
                        }
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
