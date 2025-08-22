<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlowQuery extends Model
{
    use HasFactory;

    protected $fillable = ['sql', 'bindings', 'execution_time', 'connection'];
}

