<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'seller';
    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
