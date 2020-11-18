<?php

namespace App\Http\Controllers\representative;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Models\Order;
use App\Http\Models\Representative;

class SalesController extends Controller
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

        return Order::
                    where('representative_id', '=', $me->id)
                    ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['representative_id'] = Auth::guard('representative')->id();

        if(empty($data['name'])) {
            return response()->json([
                'error' => true,
                'message' => 'name cannot be null!'
            ], 401);
        }

        if(empty($data['email'])) {
            return response()->json([
                'error' => true,
                'message' => 'email cannot be null!'
            ], 401);
        }

        if(empty($data['cpf'])) {
            return response()->json([
                'error' => true,
                'message' => 'cpf cannot be null!'
            ], 401);
        }

        if(empty($data['mobile'])) {
            return response()->json([
                'error' => true,
                'message' => 'mobile cannot be null!'
            ], 401);
        }

        if(empty($data['church'])) {
            return response()->json([
                'error' => true,
                'message' => 'church cannot be null!'
            ], 401);
        }

        if(empty($data['address'])) {
            return response()->json([
                'error' => true,
                'message' => 'address cannot be null!'
            ], 401);
        }

        if(empty($data['number'])) {
            return response()->json([
                'error' => true,
                'message' => 'number cannot be null!'
            ], 401);
        }

        if(empty($data['cep'])) {
            return response()->json([
                'error' => true,
                'message' => 'cep cannot be null!'
            ], 401);
        }

        if(empty($data['state'])) {
            return response()->json([
                'error' => true,
                'message' => 'state cannot be null!'
            ], 401);
        }

        if(empty($data['birthday'])) {
            return response()->json([
                'error' => true,
                'message' => 'birthday cannot be null!'
            ], 401);
        }

        if(Order::where('email', '=', $data['email'])->first()) {
            return response()->json([
                'error' => true,
                'message' => 'this email already exists!'
            ], 401);
        }

        if(Order::where('document', '=', $data['cpf'])->first()) {
            return response()->json([
                'error' => true,
                'message' => 'this document already exists!'
            ], 401);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://hxmais.com.br/purchase.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $result = curl_exec($ch);
        curl_close($ch);

        echo $result;exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $type
     * @param  string  $value
     * @return \Illuminate\Http\Response
     */
    public function show($type, $value)
    {
        $me = Auth::guard('representative')->user();
        $order = Order::where($type, '=', $value)->first();

        if($order == null || $me->id !== $order->representative_id) {
            return response()->json([
                'error' => true,
                'message' => 'user not found'
            ], 404);
        }

        return $order;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
