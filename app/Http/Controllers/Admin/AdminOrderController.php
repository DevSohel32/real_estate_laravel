<?php

namespace App\Http\Controllers\Admin;

use index;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy("id","desc")->paginate(10);
        return view("admin.orders.index",compact("orders"));
    }
    public function invoice($id){
        $order = Order::findOrFail($id);
        return view("admin.orders.invoice",compact("order"));
}}
