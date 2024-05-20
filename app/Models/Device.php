<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'device';
    protected $primaryKey = 'guid';
    protected $keyType = 'string';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'guid',
        'code_block_residential',
        'house_number',
        'status',
        'access',
    ];

    public function residentialBlock()
    {
        return $this->belongsTo(ResidentialBlock::class, 'code_block_residential', 'code_block');
    }
    public function histroyButtons()
    {
        return $this->hasMany(HistoryButton::class, 'guid', 'guid');
    }
}
