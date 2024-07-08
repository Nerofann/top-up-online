<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderServer extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'server',
        'status',
        'create_at'
    ];
}
