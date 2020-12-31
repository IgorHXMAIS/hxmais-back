<?php

namespace App\Http\Controllers\representative;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Models\Client;
use App\Http\Models\Subscription;
use App\Http\Models\PaymentSubscription;
use App\Http\Models\CommissionRepresentative;

class ClientsController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.representative');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $me = Auth::guard('representative')->user();

        return Client::
                    where('representative_id', '=', $me->id)
                    ->get();
    }

    /**
     * Display a listing of the subscriptions of the client.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientSubscriptions($id)
    {
        $me = Auth::guard('representative')->user();

        if($id == null || empty($id)) {
            return response()->json([
                'error' => true,
                'message' => 'id not valid'
            ], 404);
        }

        $client = Client::where("id", $id)->where("representative_id", $me->id)->first();

        if($client == null || empty($client)) {
            return response()->json([
                'error' => true,
                'message' => 'client not found'
            ], 404);
        }

        $commissions_representatives = CommissionRepresentative::select('payment_subscription_id')->where('representative_id', $me->id)->get();

        if(count($commissions_representatives) <= 0) {
            return response()->json([
                'error' => true,
                'message' => 'subscriptions not found'
            ], 404);
        }

        $subscriptions = array();        
        
        $subscriptions2 = $client->subscriptions()->get();
        foreach($subscriptions2 as $sb) {
            $sb->client = $client;
            $subscriptions[] = $sb;
        }

        return $subscriptions;
    }

    /**
     * Display a listing of the payments subscriptions of the client.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentSubscriptions($id)
    {
        if($id == null || empty($id)) {
            return response()->json([
                'error' => true,
                'message' => 'id not valid'
            ], 404);
        }

        $subscription = Subscription::find($id);

        if($subscription == null || empty($subscription)) {
            return response()->json([
                'error' => true,
                'message' => 'subscription not found'
            ], 404);
        }

        $payments_subscriptions = array();
        $payments = $subscription->payments;
        foreach($payments as $payment) {
            foreach ($payment->subscription()->get() as $subscription) {
                $client = $subscription->client()->first();
                $payment->client = $client;
                $payments_subscriptions[] = $payment;
            }
        }

        return $payments_subscriptions;
    }

    /**
     * Display a listing of the all subscriptions of the representative.
     *
     * @return \Illuminate\Http\Response
     */
    public function allClientsSubscriptions()
    {
        $me = Auth::guard('representative')->user();

        $commissions_representatives = CommissionRepresentative::select('payment_subscription_id')->where('representative_id', $me->id)->groupBy('representative_id')->get();

        $subscriptions = array();
        foreach($commissions_representatives as $commission) {
            $payments = $commission->payment_subscription()->get();
            foreach($payments as $payment) {
                foreach($payment->subscription()->get() as $subscription) {
                    if(!in_array($subscription, $subscriptions)) {
                        $client = $subscription->client()->first();
                        $subscription->client = $client;
                        $subscriptions[] = $subscription;
                    }
                }
            }
        }

        return $subscriptions;
    }

    /**
     * Display a listing of the all payments subscriptions of the representative.
     *
     * @return \Illuminate\Http\Response
     */
    public function allClientsPaymentsSubscriptions()
    {
        $me = Auth::guard('representative')->user();

        $commissions_representatives = CommissionRepresentative::select('payment_subscription_id', 'representative_id')->where('representative_id', $me->id)->get();

        $payments_subscriptions = array();
        foreach($commissions_representatives as $commission) {
            $payments = $commission->payment_subscription()->get();
            foreach($payments as $payment) {
                foreach ($payment->subscription()->get() as $subscription) {
                    $client = $subscription->client()->first();
                    $payment->client = $client;
                    $payments_subscriptions[] = $payment;
                }
            }
        }

        return $payments_subscriptions;
    }

    /**
     * Display a total subscriptions of the representative.
     *
     * @return \Illuminate\Http\Response
     */
    public function totalSubscriptions()
    {
        $me = Auth::guard('representative')->user();

        $subscriptions = CommissionRepresentative::select('payment_subscription_id', 'representative_id')->where('representative_id', $me->id)->groupBy('representative_id')->get();

        return response()->json([
            'total' => count($subscriptions)
        ], 200);
    }

    /**
     * Display a total subscriptions of the representative.
     *
     * @return \Illuminate\Http\Response
     */
    public function totalPaymentsSubscriptions()
    {
        $me = Auth::guard('representative')->user();

        $payments_subscriptions = CommissionRepresentative::select('payment_subscription_id', 'representative_id')->where('representative_id', $me->id)->groupBy('payment_subscription_id')->get();

        return response()->json([
            'total' => count($payments_subscriptions)
        ], 200);
    }

    /**
     * Display a total clients of the representative.
     *
     * @return \Illuminate\Http\Response
     */
    public function totalClients()
    {
        $me = Auth::guard('representative')->user();

        $clients = Client::where('representative_id', '=', $me->id)->get();

        return response()->json([
            'total' => count($clients)
        ], 200);
    }
}
