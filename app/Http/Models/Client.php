<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    /*protected $hidden = [
        'representative_id'
    ];*/

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'document',
        'phone',
        'fix_phone',
        'nationality',
        'birth_date',
        'address',
        'number',
        'complement',
        'city',
        'neighbourhood',
        'state',
        'zipcode',
        'id_customer_asaas',
        'status',
        'representative_id'
    ];

    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }

    public function payments_subscriptions() {
        return $this->hasOneThrough(PaymentSubscription::class, Subscription::class);
    }
}
