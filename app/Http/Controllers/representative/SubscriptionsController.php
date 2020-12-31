<?php

namespace App\Http\Controllers\representative;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Models\Subscription;
use App\Http\Models\PaymentSubscription;
use App\Http\Models\CommissionRepresentative;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the subscriptions of the client.
     *
     * @return \Illuminate\Http\Response
     */
    public function analyticsDashboard()
    {
        $me = Auth::guard('representative')->user();

        //query para cobranças
        $first_day_month = date("Y-m-01");
        $last_day_month = date("Y-m-t");

        $ids_payments_subscriptions = CommissionRepresentative::select('payment_subscription_id')->where('representative_id', $me->id)->get();

        //Subscriptions of current month
        $subscriptions_month = array();
        foreach($ids_payments_subscriptions as $commission) {
            $payments = $commission->payment_subscription()->get();
            foreach($payments as $payment) {
                foreach ($payment->subscription()->whereBetween('date_created', [$first_day_month,$last_day_month])->get() as $subscription) {
                    $client = $subscription->client()->first();
                    $subscription->client = $client;
                    if(!in_array($subscription, $subscriptions_month)) {
                        $subscriptions_month[] = $subscription;
                    }
                }
            }
        }

        //Payments subscriptions of current month
        $payments_subscriptions_month = PaymentSubscription::whereIn('id', $ids_payments_subscriptions)
            ->where(function($query) use ($first_day_month, $last_day_month) {
                $query->whereBetween('due_date', [$first_day_month,$last_day_month]);
            })
        ->orderBy('due_date')
        ->get();

        //Expected value for this month
        $expected_value = 0;
        
        foreach ($payments_subscriptions_month as $payment) {
            if($me->type_commision == "value") {
                $expected_value = $expected_value + $me->value;
            } else {
                $percentage = $me->percentage / 100;
                $value_commission = $payment->price * $percentage;
                $expected_value = $expected_value + $value_commission;
            }
            
        }
        
        
        return response()->json([
            'analytics' => array(
                'total_subscriptions_current_month' => count($subscriptions_month),
                'total_payments_subscriptions_current_month' => count($payments_subscriptions_month),
                'total_price_current_month' => ceil($expected_value)
            )
        ], 200);

    }
}
