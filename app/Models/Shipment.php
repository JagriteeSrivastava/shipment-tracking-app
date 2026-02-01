<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'tracking_number', 'sender_name', 'sender_address',
        'receiver_name', 'receiver_address', 'status', 'shipment_date'
    ];

    public function statusLogs()
    {
        return $this->hasMany(StatusLog::class);
    }
}
