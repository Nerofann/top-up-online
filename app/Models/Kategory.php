<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategory extends Model
{
    use HasFactory;

    protected $fillable = ['kt_name', 'kt_code', 'created_at'];

    public function providers(): HasMany
    {
        return $this->hasMany(Provider::class, 'pv_kategoryid', 'id');
    }
}
