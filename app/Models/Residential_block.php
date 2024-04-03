<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residential_block extends Model
{
    use HasFactory;

    protected $table = 'residential_block';
    protected $primaryKey = 'code_block';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'code_block',
        'id_residential',
        'name_block',
    ];

    public function resindential()
    {
        return $this->belongsTo(Resindential::class, 'id_residential');
    }
}
