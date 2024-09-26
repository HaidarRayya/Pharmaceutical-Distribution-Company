<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class DriverController extends Controller
{

    public function index()
    {
        $orders = Order::where('status', '=', '2')
            ->orWhere('status', '=', '3')
            ->orderByDesc('status')->get();
        $x = [];
        foreach ($orders  as $order) {
            $user = User::where('id', '=', $order->user_id)->first();
            array_push(
                $x,
                [
                    'id' => $order->id,
                    'name' => $user->storename,
                    'totalprice' => $order->totalprice,
                    'phonenumber' => $user->phonenumber,
                    'status' => $order->status
                ]
            );
        }
        return view('driver.ordertodriver', ['orders' => $x]);
    }


    public function start($order_id)
    {
        $order = Order::where('id', '=', $order_id)->first();
        $order->update([
            'status' => 3
        ]);
        return redirect()->back()->with('message', 'The operation was completed successfully');
    }


    public function done($order_id)
    {
        $order = Order::where('id', '=', $order_id)->first();
        $order->update([
            'status' => 4
        ]);
        return redirect()->back()->with('message', 'The operation was completed successfully');
    }

    public function updateProfilePage()
    {
        $user = User::where('id', '=', Auth::user()->id)->first();
        return view('driver.driverupdateinfo', ['user' => $user]);
    }
    public function updateProfile(Request $request)
    {
        $user = User::where('id', '=', Auth::user()->id)->first();

        $data = $request->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'phonenumber' => 'required',
        ]);
        if ($request->has('password') &&   $request->password != null) {
            $request->validate([
                'password' => ['required', 'min:8', 'max:21', Password::min(8)->letters()->numbers()],
            ]);
            $data['password'] = Hash::make($data['password']);
        }
        if ($request->hasFile('image')  && $request->file('image') != substr($user->image, 14)) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = $request->file('image')->store('driversImages', 'public');
        }
        $user->update($data);

        return redirect()->back()->with('message', 'modified successfully');
    }
}
