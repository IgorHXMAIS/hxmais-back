<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Models\Order;
use App\Http\Models\Church;
use App\Http\Models\Representative;

class SalesController extends Controller
{

    public function __construct() {
        $this->middleware('jwt.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::with('representative')->paginate();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $type
     * @param  string  $doc
     * @return \Illuminate\Http\Response
     */
    public function show($type, $doc)
    {
        $order = Order::
            with('representative')
            ->where($type, '=', $doc)
            ->first();

        if($order == null) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Order::where('id', '=', $id)->delete()) {
            return response()->json([
                'error' => true,
                'message' => 'order not found'
            ], 404);
        }

        return response()->json([
            'error' => false,
            'message' => 'order deleted with success'
        ], 202);
    }
}
