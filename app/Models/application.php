<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application extends Model
{
    protected $fillable = [
        'last_4_ssn',
        'mobile_number',
        'user_id',
        'provider_id',
        'status',
    ];
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;
}
