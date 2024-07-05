<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory; 
    protected $fillable = ['pv_kategoryid', 'pv_code', 'pv_name', 'pv_image', 'pv_banner', 'pv_slug', 'prov_desc', 'created_at'];

    public function kategory()
    {
        return $this->belongsTo(Kategory::class, 'pv_kategoryid', 'id');
    }
}
