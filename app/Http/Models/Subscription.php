<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'id_subscription_asaas',
        'date_created',
        'next_due_date',
        'status_subscription',
        'price',
        'cycle',
        'holder_name_card',
        'first_digits_number_card',
        'last_digits_number_card',
        'month_expiry_card',
        'year_expiry_card',
        'documment_card',
        'status',
        'ip',
        'created_at',
        'guid'
    ];

    public function payments() {
        return $this->hasMany(PaymentSubscription::class);
    }

    /**
     * Get the client record associated with the subscription.
     */
    public function client() {
        return $this->belongsTo(Client::class);
    }
}
