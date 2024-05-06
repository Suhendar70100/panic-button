<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residential extends Model
{
    use HasFactory;

    protected $table = 'residential'; // perbaikan nama tabel
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'name',
        'address',
    ];

    public function residentialBlocks()
    {
        return $this->hasMany(ResidentialBlock::class, 'id_residential'); // perbaikan nama metode hubungan
    }

}
