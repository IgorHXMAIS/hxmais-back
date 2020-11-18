<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Models\Order;
use App\Http\Models\Representative;

class RepresentativeController extends Controller
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
        return Representative::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'document' => $request->input('document'),
            'phone' => $request->input('phone'),
            'address' => [
                'zipcode' => $request->input('zipcode'),
                'street' => $request->input('street'),
                'number' => $request->input('number'),
                'neighbourhood' => $request->input('neighbourhood'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'complement' => $request->input('complement')
            ]
        ];

        if(!$request->input('name')) {
            return response()->json([
                'error' => true,
                'message' => 'name connot be null'
            ], 400);
        }

        if(!$request->input('email')) {
            return response()->json([
                'error' => true,
                'message' => 'email connot be null'
            ], 400);
        }

        if(!$request->input('password')) {
            return response()->json([
                'error' => true,
                'message' => 'password connot be null'
            ], 400);
        }

        if(!$request->input('document')) {
            return response()->json([
                'error' => true,
                'message' => 'document connot be null'
            ], 400);
        }

        if(!$request->input('phone')) {
            return response()->json([
                'error' => true,
                'message' => 'phone connot be null'
            ], 400);
        }

        if(!$request->input('zipcode')) {
            return response()->json([
                'error' => true,
                'message' => 'zipcode connot be null'
            ], 400);
        }

        if(!$request->input('street')) {
            return response()->json([
                'error' => true,
                'message' => 'street connot be null'
            ], 400);
        }

        if(!$request->input('number')) {
            return response()->json([
                'error' => true,
                'message' => 'number connot be null'
            ], 400);
        }

        if(!$request->input('neighbourhood')) {
            return response()->json([
                'error' => true,
                'message' => 'neighbourhood connot be null'
            ], 400);
        }

        if(!$request->input('city')) {
            return response()->json([
                'error' => true,
                'message' => 'city connot be null'
            ], 400);
        }

        if(!$request->input('state')) {
            return response()->json([
                'error' => true,
                'message' => 'state connot be null'
            ], 400);
        }

        if (!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'error' => true,
                'message' => 'email is invalid'
            ], 400);
        }

        $data['password'] = Hash::make($request->input('password'));

        if(Representative::where('email', '=', $data['email'])->first()) {
            return response()->json([
                'error' => true,
                'message' => 'this email already exists!'
            ], 400);
        }

        if(Representative::create($data)) {
            return response()->json([
                'error' => false,
                'message' => 'representative created with success'
            ], 201);
        }

        return response()->json([
            'error' => true,
            'message' => 'error'
        ], 500);
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
        $order = Representative::where($type, '=', $doc)
            ->first();

        if($order == null) {
            return response()->json([
                'error' => true,
                'message' => 'representative not found'
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
        if(!$representative = Representative::find($id)) {
            return response()->json([
                'error' => true,
                'message' => 'representative not found'
            ], 404);
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'document' => $request->input('document'),
            'phone' => $request->input('phone'),
            'address' => [
                'zipcode' => $request->input('address')['zipcode'],
                'street' => $request->input('address')['street'],
                'number' => $request->input('address')['number'],
                'neighbourhood' => $request->input('address')['neighbourhood'],
                'city' => $request->input('address')['city'],
                'state' => $request->input('address')['state'],
                'complement' => $request->input('address')['complement']
            ]
        ];

        foreach($data['address'] as $key => $item) {
            if(empty($item)) {
                unset($data['address'][$key]);
            }
        }

        foreach($data as $key => $item) {
            if(empty($item)) {
                unset($data[$key]);
            }
        }

        $representative->update($data);

        return response()->json([
            'error' => false,
            'message' => 'representative updated with success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$representative = Representative::find($id)) {
            return response()->json([
                'error' => true,
                'message' => 'representative not found'
            ], 404);
        }

        Order::where('representative_id', '=', $id)->update(['representative_id' => NULL]);
        $representative->delete();

        return response()->json([
            'error' => false,
            'message' => 'representative deleted with success'
        ], 202);
    }

    /**
     * Get sales from specified representative
     *
     * @return \Illuminate\Http\Response
     */
    public function sales($id)
    {
        if(!$representative = Representative::where('id', '=', $id)->first()) {
            return response()->json([
                'error' => true,
                'message' => 'representative not found'
            ], 404);
        }

        $orders = Order::where('representative_id', '=', $representative->id)->paginate();
        return $orders;
    }
}
