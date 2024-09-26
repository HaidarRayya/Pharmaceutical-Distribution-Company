<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderMedicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartMedicines = Cart::where('user_id', '=', Auth::user()->id)->get();
        $medicines = [];
        foreach ($cartMedicines as $c) {
            $medicine = Medicine::where('id', '=', $c->medicine_id)->first();
            array_push($medicines, [
                'name' => $medicine->name,
                'image' => $medicine->image,
                'cart' => $c
            ]);
        }

        return view('Customer.cart', ['medicines' => $medicines]);
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
        $cartData = $request->validate([
            'quantity' => 'required',
            'medicine_id' => 'required'
        ]);
        $medicine = Medicine::where('id', '=', $cartData['medicine_id'])->first();
        if ($cartData['quantity'] <= 0) {
            return redirect()->back()->with('message', 'invalid data');
        }

        if ($medicine->quantity < $cartData['quantity']) {
            return redirect()->back()->with('message', 'The number of products you entered is greater than the available quantity ');
        }

        $cartItem = Cart::where('user_id', '=', Auth::user()->id)->where('medicine_id', '=', $cartData['medicine_id'])->first();
        if ($cartItem != null) {
            $cartItem->update([
                'quantity' =>  $cartItem->quantity + $cartData['quantity']
            ]);
            $medicine->update([
                'quantity' => $medicine->quantity - $cartData['quantity']
            ]);

            return redirect()->back()->with('message', 'added successfully');
        }
        $cartData['price'] = $medicine->price;
        $cartData['user_id'] = Auth::user()->id;
        $medicine->update([
            'quantity' => $medicine->quantity - $cartData['quantity']
        ]);
        Cart::create($cartData);
        return redirect()->back()->with('message', 'added successfully');
    }

    public function edit($cart_id)
    {
        $cart = Cart::where('id', '=', $cart_id)->first();
        $med = Medicine::where('id', '=', $cart->medicine_id)->first();
        $medicine = [
            'id' => $cart->id,
            'quantity' => $cart->quantity,
            'name' => $med->name,
        ];
        return view('Customer.carteditmedicine', ['medicine' => $medicine]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($user, Cart $cart, Request $request)
    {
        $cartData = $request->validate([
            'quantity' => 'required',
        ]);
        $medicine = Medicine::where('id', '=', $cart->medicine_id)->first();
        if ($cartData['quantity'] <= 0) {
            return redirect()->back()->with('message', 'invalid data');
        }

        if ($medicine->quantity < $cartData['quantity']) {
            return redirect()->back()->with('message', 'The number of products you entered is greater than the available quantity ');
        }

        $cart->update($cartData);
        $medicine->update([
            'quantity' => $medicine->quantity - $cartData['quantity']
        ]);;
        return redirect()->back()->with('message', 'modified successfully');
    }
    public function destroy(String $user_id, Cart $cart)
    {
        $medicine = Medicine::where('id', '=', $cart->medicine_id)->first();
        $medicine->update([
            'quantity' => $medicine->quantity + $cart->quantity
        ]);

        $cart->delete();
        return redirect()->back()->with('message', 'deleted successfully');
    }

    public function confirmOrder()
    {
        $totalprice = 0;
        $cartMedicines = Cart::where('user_id', '=', Auth::user()->id)->get();
        foreach ($cartMedicines as $cartMedicine) {
            $totalprice += $cartMedicine['price'] * $cartMedicine['quantity'];
        }
        $order = Order::create([
            'totalprice' =>  $totalprice,
            'date' => now(),
            'user_id' => Auth::user()->id
        ]);

        foreach ($cartMedicines as $cartMedicine) {
            OrderMedicine::create([
                'quantity' => $cartMedicine['quantity'],
                'price' => $cartMedicine['price'],
                'order_id' => $order->id,
                'medicine_id' => $cartMedicine['medicine_id']
            ]);
            $cartMedicine->delete();
        }

        return redirect()->back()->with('message', 'the order added successfully');
    }
}
