<?php

namespace App\Http\Controllers\driverManager;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderMedicine;
use App\Models\User;

class DriverManagerController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', '=', '1')->get();
        $x = [];
        foreach ($orders  as $order) {
            $user = User::where('id', '=', $order->user_id)->first();
            array_push(
                $x,
                [
                    'id' => $order->id,
                    'name' => $user->storename,
                    'totalprice' => $order->totalprice,
                    'phonenumber' => $user->phonenumber
                ]
            );
        }
        return view('DriverManager.ordersmanager', ['orders' => $x]);
    }
    public function show($order_id)
    {
        $orderMedicines = OrderMedicine::where('order_id', '=', $order_id)->get();

        $x = [];
        foreach ($orderMedicines  as $orderMedicine) {
            $medicine = Medicine::where('id', '=', $orderMedicine->medicine_id)->first();
            array_push(
                $x,
                [
                    'name' =>  $medicine->name,
                    'quantity' => $orderMedicine->quantity
                ]
            );
        }
        return view('DriverManager.detailsordersmanager', ['orderMedicines' =>  $x, 'order_id' => $order_id]);
    }
    public function accept($order_id)
    {
        $order = Order::where('id', '=', $order_id)->first();
        $order->update([
            'status' => 2
        ]);
        return redirect('/driverManager')->with('message', 'The operation was completed successfully');
    }
}
