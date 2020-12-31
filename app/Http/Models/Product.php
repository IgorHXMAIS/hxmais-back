<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'type',
        'name',
        'description',
        'cycle',
        'price',
        'status',
        'price',
        'created_at',
        'updated_at'
    ];
}
