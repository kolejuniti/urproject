<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
    'title',
    'description',
    'type',
    'file_path',
    'external_link',
    'tags',
    'platform',
    ];

    protected $casts = [
        'platform' => 'array',
    ];


}
