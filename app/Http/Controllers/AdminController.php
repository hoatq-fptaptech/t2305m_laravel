<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view("admin.page.dashboard");
    }
    public function orders(){
        $orders = Order::orderBy("id","desc")->paginate(20);
        return view("admin.page.orders",compact('orders'));
    }
    public function detailOrder(Order $order){
        return view("admin.page.detail_order",compact('order'));
    }
    public function confirmOrder(Order $order){
        $order->update(["status"=>Order::STATUS_CONFIRMED]);
        return redirect()->back();
    }
}