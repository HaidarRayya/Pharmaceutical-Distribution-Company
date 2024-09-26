<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderMedicine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('status', '=', 0)->get();
        $x = [];
        foreach ($orders  as $order) {
            $user = User::where('id', '=', $order->user_id)->first();
            array_push(
                $x,
                [
                    'id' => $order->id,
                    'name' => $user->storename,
                    'address' => $user->address,
                    'totalprice' => $order->totalprice
                ]
            );
        }
        return view('Admin.orders.orders', ['orders' => $x]);
    }
    public function acceptedOrders()
    {
        $orders = Order::where('status', '!=', 0)->get();
        $x = [];
        foreach ($orders  as $order) {
            $user = User::where('id', '=', $order->user_id)->first();
            $status = '';
            if ($order->status == 1) {
                $status = 'waiting for preparing ';
            } else if ($order->status == 2) {
                $status = 'waiting for delivery';
            } else if ($order->status == 3) {
                $status = 'under delivery';
            } else if ($order->status == 4) {
                $status = 'delivered ';
            }
            array_push(
                $x,
                [
                    'id' => $order->id,
                    'name' => $user->storename,
                    'address' => $user->address,
                    'totalprice' => $order->totalprice,
                    'status' =>   $status
                ]
            );
        }
        return view('Admin.orders.acceptedorders', ['orders' => $x]);
    }
    public function accept(Order $order, $driver_id)
    {
        $user = User::where('id', '=', $order->user_id)->first();
        $data = [
            'subject' => "the order has been accepted",
            "body" =>  "hello " . " " . $user->firstname . " "  . $user->lastname . " " . "the order has been accepted"
        ];

        $order->update([
            'status' => 1,
            'driver_id' => $driver_id
        ]);
        EmailController::acceptOrder($data, $user->email);


        return redirect(route('admin.orders.index', ['admin' => Auth::user()]))->with('message', 'the order has been accepted successfully ');
    }
    public function reject(Order $order)
    {
        $user = User::where('id', '=', $order->user_id)->first();


        $data = [
            'subject' => "the order has been rejected",
            "body" => "hello " . " " . $user->firstname . " "  . $user->lastname . " " .  " the order has been rejected"
        ];


        $orderMedicines = OrderMedicine::where('order_id', '=', $order->id)->get();

        foreach ($orderMedicines as $orderMedicine) {
            $medicine = Medicine::where('id', '=', $orderMedicine->medicine_id)->first();
            $medicine->update([
                'quantity' => $medicine->quantity + $orderMedicine->quantity
            ]);
            $orderMedicine->delete();
        }
        $order->delete();
        EmailController::rejectOrder($data, $user->email);

        return redirect()->back()->with('message', 'the order has been rejected successfully');
    }
    /** 
     * Show the form for creating a new resource.
     */
    public function chooseDriverPage($id, $order_id)
    {
        $drivers = User::where('role', '=', 'driver')->paginate(6);
        return view('Admin.orders.adminchooseemployee', [
            'drivers' => $drivers,
            'order_id' => $order_id
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($user, Order $order)
    {
        $orderMedicines = OrderMedicine::where('order_id', '=', $order->id)->get();
        $medicines = [];
        foreach ($orderMedicines as $orderMedicine) {
            $medicine = Medicine::find($orderMedicine->medicine_id)->first();
            array_push($medicines, [
                'name' => $medicine->name,
                'image' => $medicine->image,
                'price' => $orderMedicine['price'],
                'quantity' => $orderMedicine['quantity'],
            ]);
        }
        return view('Admin.orders.orderdetails', ['medicines' => $medicines, 'order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Order $order)
    {
        //  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // format('h:i:s A')
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user, Order $order) {}
}
