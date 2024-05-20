<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "vendor_id",
        "provider_id",
        "type",
        "name",
        "description",
        "price_vendor",
        "price_real",
        "price_discount",
        "code",
        "extra",
        "instructions",
        "status",
        "published"
    ];
}
