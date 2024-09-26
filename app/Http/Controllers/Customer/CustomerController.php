<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Medicine;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $companies = [];
        if ($search) {
            $companies = Company::where('name', 'like', "%$search%")->latest()->paginate(6);
        } else {
            $companies = Company::latest()->paginate(6);
        }
        return view('Customer.index', ['companies' => $companies]);
    }
    public function show(Request $request, Company $company)
    {
        $search = $request->input('search');
        $medicines = [];
        if (Auth::user()) {
            if (Auth::user()->role === 'pharmacist') {
                if ($search) {
                    $medicines = Medicine::where('quantity', '>',  0)->where('company_id', '=', $company->id)->where('deleted_at', '=', null)->where('name', 'like', "%$search%")->paginate(6);
                } else {
                    $medicines = Medicine::where('quantity', '>',  0)->where('company_id', '=', $company->id)->where('deleted_at', '=', null)->paginate(6);
                }
                return view('Customer.medicines', ['medicines' => $medicines]);
            } else if (Auth::user()->role === 'beautystore') {
                if ($search) {
                    $medicines = Medicine::where('quantity', '>',  0)->where('type', '=', 'cosmetic')->where('company_id', '=', $company->id)->where('name', 'like', "%$search%")->where('deleted_at', '=', null)->paginate(6);
                } else {
                    $medicines = Medicine::where('quantity', '>',  0)->where('type', '=', 'cosmetic')->where('company_id', '=', $company->id)->where('deleted_at', '=', null)->paginate(6);
                }
                return view('Customer.medicines', ['medicines' => $medicines]);
            }
        } else {
            if ($search) {
                $medicines = Medicine::where('quantity', '>',  0)->where('company_id', '=', $company->id)->where('name', 'like', "%$search%")->where('deleted_at', '=', null)->paginate(6);
            } else {
                $medicines = Medicine::where('quantity', '>',  0)->where('company_id', '=', $company->id)->where('deleted_at', '=', null)->paginate(6);
            }
            return view('Customer.medicines', ['medicines' => $medicines]);
        }
    }
    public function updateProfilePage()
    {
        $user = User::where('id', '=', Auth::user()->id)->first();
        return view('Customer.updateinfo', ['user' => $user]);
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

        $user->update($data);

        return redirect()->back()->with('message', 'modified successfully');
    }
}