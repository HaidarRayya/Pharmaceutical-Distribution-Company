<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public  static function index($search)
    {
        $companys = [];
        if ($search) {
            $companys =  Company::where('name', 'like', "%$search%")->paginate(5);
        } else {
            $companys =  Company::paginate(5);
        }

        return $companys;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.adminaddcompany');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $companyData = $request->validate([
            'name' => 'required|min:2',
            'email' => ['required', 'email', Rule::unique('companies', 'email')],
            'phoneNumber' => 'required',
            'location' => 'required',
        ]);
        if ($request->hasFile('logo'))
            $companyData['logo'] = $request->file('logo')->store('logos', 'public');

        Company::create($companyData);
        return redirect()->back()->with('message', 'added successfully');
    }
    public function edit(Company $company)
    {
        return view('Admin.admineditcompany', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Company $company, Request $request)
    {
        $companyData = $request->validate([
            'name' => 'required|min:2',
            'email' => ['required', 'email', Rule::unique('companies', 'email')->ignore($company->id)],
            'phoneNumber' => 'required',
            'location' => 'required',
        ]);
        if ($request->hasFile('logo')  && $request->file('logo') != substr($company->logo, 6)) {
            Storage::disk('public')->delete($company->logo);
            $companyData['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $company->update($companyData);
        return redirect()->back()->with('message', 'modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if (collect($company->medicines)->toArray()) {
            return redirect()->back()->with('company', $company->id)->with('confirm Message', 'do you want to delete this company and all its products ?');
        }
        $company->delete();
        return redirect()->back()->with('message', 'deleted successfully');
    }

    public function confirmDestroy(Company $company)
    {
        $medicines = $company->medicines;

        foreach ($medicines as  $medicine) {
            $medicine->delete();
        }
        $company->delete();
        return redirect()->back()->with('message', 'deleted successfully');
    }
}