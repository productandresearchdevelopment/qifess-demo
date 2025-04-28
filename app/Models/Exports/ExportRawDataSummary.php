<?php

namespace App\Models\Exports;

use Illuminate\Database\Eloquent\Model;

class ExportRawDataSummary extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'ticket_id',
        'service',
        'activity',
        'client',
        'site_name',
        'site_address',
        'site_phone',
        'area',
        'duration',
        'booking_date',
        'booking_slot',
        'created_by',
        'created_date',
        'last_action_status',
        'last_action_date',
        'total_stb_value',
        'alamat_instalasi_value',
        'sn_ont_act_value',
        'ont_serial_numbers',
        'description',
        'is_hold',
        'fieldtech_name',
        'vendor_name',
        'datetime_inprogress',
        'datetime_preparation',
        'datetime_adm',
        'duration_installation',
        'datetime_deactivation',
        'datetime_post_activation',
        'duration_termination',
    ];

    protected $table = null;
}
