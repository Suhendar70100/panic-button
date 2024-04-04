<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryButton extends Model
{
    use HasFactory;

    protected $table = 'history_button';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'guid',
        'state',
        'time',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class, 'guid', 'guid');
    }
}
