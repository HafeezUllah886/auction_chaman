<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase_details extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function purchase()
    {
        return $this->belongsTo(purchase::class, 'purchase_id', 'id');
    }
    

}
