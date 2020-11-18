<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $hidden = [
        'representative_id'
    ];

    protected $fillable = [
        'representative_id',
        'church',
        'name',
        'email',
        'document',
        'birth_date',
        'phone',
        'fix_phone',
        'nationality',
        'address',
        'type'
    ];

    protected $casts = [
        'address' => 'array',
    ];

    public function representative() {
        return $this->belongsTo(Representative::class);
    }
}
