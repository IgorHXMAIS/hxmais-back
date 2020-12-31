<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionRepresentative extends Model
{
    protected $table = 'commissions_representatives';

    protected $fillable = [
        'payment_subscription_id',
        'representative_id',
        'type_commission_representative',
        'commission_representative',
        'price',
        'situation',
        'status',
        'birth_date',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the payment subscription record associated with the commission representative.
     */
    public function payment_subscription() {
        return $this->belongsTo(PaymentSubscription::class);
    }
}
