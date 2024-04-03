<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentialBlock extends Model
{
    use HasFactory;

    protected $table = 'resindential_block';
    protected $primaryKey = 'code_block';
    protected $keyType = 'string';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'code_block',
        'id_residential',
        'name_block',
    ];

    public function residential()
    {
        return $this->belongsTo(Residential::class, 'id');
    }
}
