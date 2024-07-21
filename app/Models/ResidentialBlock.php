<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentialBlock extends Model
{
    use HasFactory;

    protected $table = 'residential_block';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'code_block',
        'id_residential',
        'name_block',
    ];

    public function residential()
    {
        return $this->belongsTo(Residential::class, 'id_residential');
    }

    public function devices()
    {
        return $this->hasMany(Device::class,'id_residential_block');
    }
}
