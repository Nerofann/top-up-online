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
        "icon",
        "published"
    ];

    public function product_vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function product_published()
    {
        return $this->belongsTo(User::class, 'published', 'uuid');
    }
}
