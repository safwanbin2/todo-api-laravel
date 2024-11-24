<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoModel extends Model
{
    protected $table = 'todo';
    protected $fillable = ['title', 'isCompleted'];
}
