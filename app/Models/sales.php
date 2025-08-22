<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    protected $guarded = [];

    public function sale_cars()
    {
        return $this->hasMany(sale_cars::class);
    }

    public function sale_parts()
    {
        return $this->hasMany(sale_parts::class);
    }

    public function purchase()
    {
        return $this->belongsTo(purchase::class);
    }
}
