<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderMedicine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', '=', Auth::user()->id)->get();
        return view('Customer.orders', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            $medicine = Medicine::find($orderMedicine->medicine_id);
            array_push($medicines, [
                'name' => $medicine->name,
                'image' => $medicine->image,
                'price' => $orderMedicine['price'],
                'quantity' => $orderMedicine['quantity'],
            ]);
        }
        return view('Customer.orderdetails', ['medicines' => $medicines]);
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
    public function destroy($user, Order $order)
    {
        $date = Carbon::create($order->date);
        $orderMedicines = OrderMedicine::where('order_id', '=', $order->id)->get();

        if (now()->diffInHours($date) > 24) {
            return redirect()->back()->with('message', 'You cannot delete the order. The specified time has exceeded');
        }
        foreach ($orderMedicines as $orderMedicine) {
            // $orderMedicine==
            $medicine = Medicine::where('id', '=', $orderMedicine->medicine_id)->first();
            $medicine->update([
                'quantity' => $medicine->quantity + $orderMedicine->quantity
            ]);
            $orderMedicine->delete();
        }
        $order->delete();
        return redirect()->back()->with('message', 'deleted successfully');
    }
}