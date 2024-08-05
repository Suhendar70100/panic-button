<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'device';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'code_device',
        'id_residential_block',
        'owner_device',
        'house_number',
        'phone',
        'access',
    ];

    public function residentialBlock()
    {
        return $this->belongsTo(ResidentialBlock::class, 'id_residential_block');
    }

    public function activities()
    {
        return $this->hasMany(DeviceActivity::class, 'id_device', 'id');
    }
}
