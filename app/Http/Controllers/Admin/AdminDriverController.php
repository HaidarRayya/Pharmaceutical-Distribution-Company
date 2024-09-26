<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminDriverController extends Controller
{


    public function index()
    {
        $drivers = User::where('role', '=', 'driver')->paginate(6);
        return view('Admin.employees.adminshowemployee', ['drivers' => $drivers]);
    }


    public function create()
    {
        return view('Admin.employees.adminaddnewemployee');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:8',
            'role' => 'required',
            'phonenumber' => 'required',
        ]);
        $data['status'] = 'accept';
        $data['password'] = Hash::make($data['password']);
        if ($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('driversImages', 'public');
        User::create($data);

        return redirect()->back()->with('message', 'added successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id, $driver_id)
    {
        $driver = User::where('id', '=', $driver_id)->first();
        return view('Admin.employees.admineditemployee', ['driver' => $driver]);
    }


    public function update(Request $request, $id, $driver_id)
    {

        $data = $request->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'phonenumber' => 'required',
        ]);
        $driver = User::where('id', '=', $driver_id)->first();
        if ($request->hasFile('image')  && $request->file('image') != substr($driver->image, 14)) {
            Storage::disk('public')->delete($driver->image);
            $data['image'] = $request->file('image')->store('driversImages', 'public');
        }
        $driver->update($data);
        return redirect()->back()->with('message', 'modified successfully');
    }

    public function destroy($id,  $driver_id)
    {
        $driver = User::where('id', '=', $driver_id)->first();

        $driver->delete();
        return redirect()->back()->with('message', 'deleted successfully');
    }
}
