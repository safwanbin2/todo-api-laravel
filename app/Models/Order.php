<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $guarded = [];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
