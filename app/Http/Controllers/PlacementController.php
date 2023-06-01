<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Placement;
use App\Models\Counter;

class PlacementController extends Controller
{
    public function get_all_orders(){
        $orders = Placement::all();
        return response()->json([
            'orders' => $orders
        ],200);
    }

    public function create_order(Request $request){
        // $counter = Counter::where('key','order')->first();
        // $random = Counter::where('key','order')->first();

        // $order = Placement::orderBy('id','DESC')->first();
        // if($order){
        //     $order = $order->id+1;
        //     $counters = $counter->value + $order;
        // }else{
        //     $counters = $counter->value;
        // }

        $formData = [
            'product_id' => null,
            'product_name' => null,
            'quantity' => null,
            'customer_name' => null,
            'customer_email' => null,
            'customer_address' => null,
            'total_price' => null,
            'status' => 'order received',
        ];
        return response()->json($formData);
    }

    public function add_order(Request $request){
        
        $orderData['product_id'] = $request->input("product_id");
        $orderData['product_name'] = $request->input("product_name");
        $orderData['quantity'] = $request->input("quantity");
        $orderData['customer_name'] = $request->input("customer_name");
        $orderData['customer_email'] = $request->input("customer_email");
        $orderData['customer_address'] = $request->input("customer_address");
        $orderData['total_price'] = $request->input("total_price");
        $orderData['status'] = $request->input("status");

        $order = Placement::create($orderData);
        
        
    }
}
