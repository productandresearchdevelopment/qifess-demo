<?php

namespace App\Models\Exports;

use Illuminate\Database\Eloquent\Model;

class ExportSummaryRow extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'vendor',
        'vendor_name',
        'activity',
        'total_ticket',
        'closed_ticket',
        'closed_percent',
        'duration_minutes'
    ];
    protected $table = null;
}
