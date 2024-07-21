<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceActivity extends Model
{
    use HasFactory;
    protected $table = 'device_activity';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'id_device',
        'created_at',
        'button_condition',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
     ];

    public function device()
    {
        return $this->belongsTo(Device::class, 'id_device', 'id');
    }
}
