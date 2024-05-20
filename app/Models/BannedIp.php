<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedIp extends Model
{
    use HasFactory;

    protected $primaryKey = 'address';

    public $incrementing = false;

    protected $fillable = [
        'address',
    ];

    public $timestamps = [
        'created_at',
        'updated_at',
    ];
}
