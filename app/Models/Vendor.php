<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'v_name',
        'v_description',
        'v_api_url',
        'v_private_key',
        'v_api_key',
        'v_slug',
        'created_at'
    ];
}
