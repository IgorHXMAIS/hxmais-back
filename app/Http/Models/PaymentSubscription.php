<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSubscription extends Model
{

    protected $table = 'payments_subscriptions';

    protected $fillable = [
        'payment_id_asaas',
        'situation',
        'due_date',
        'payment_date',
        'client_payment_date',
        'invoice_url',
        'invoice_number',
        'authorization_code',
        'status',
        'created_at',
        'updated_at',
        'guid'
    ];

    /**
     * Get the subscription record associated with the payment subscription.
     */
    public function subscription() {
        return $this->belongsTo(Subscription::class);
    }
}
