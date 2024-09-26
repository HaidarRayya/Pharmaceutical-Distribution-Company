<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Medicine;
use App\Models\OrderMedicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function index(Request $request, Company $company)
    {
        $search = $request->input('search');
        $medicines = [];
        if ($search) {
            $medicines =  Medicine::where('company_id', '=', $company->id)->where('name', 'like', "%$search%")->where('deleted_at', '=', null)->latest()->paginate(6);
        } else {
            $medicines =  Medicine::where('company_id', '=', $company->id)->where('deleted_at', '=', null)->paginate(6);
        }
        return view('Admin.adminshowmedicines', ['medicines' => $medicines, 'company' => $company]);
    }
    public function create(Company $company)
    {

        return view('Admin.adminaddmedicine', ['company' => $company]);
    }


    public function store(Company $company, Request $request)
    {
        $medicineData = $request->validate([
            'name' => 'required|min:2',
            'type' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        if ($medicineData['quantity'] < 0) {
            return redirect()->back()->with('message', 'invalid data');
        }
        if ($request->hasFile('image'))
            $medicineData['image'] = $request->file('image')->store('medicineImages', 'public');
        $medicineData['company_id'] = $company->id;
        Medicine::create($medicineData);
        return redirect()->back()->with('message', 'added successfully');
    }

    public function edit(Company $company, Medicine $medicine)
    {
        return view('Admin.admineditmedicine', ['company' => $company, 'medicine' => $medicine]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Company $company, Medicine $medicine, Request $request)
    {
        $medicineData = $request->validate([
            'name' => 'required|min:2',
            'price' => 'required',
            'quantity' => 'required'
        ]);
        if ($medicineData['quantity'] < 0) {
            return redirect()->back()->with('message', 'quantity invalid data ');
        }
        if ($request->hasFile('image')  && $request->file('image') != substr($medicine->image, 6)) {
            Storage::disk('public')->delete($medicine->image);
            $medicineData['image'] = $request->file('image')->store('medicineImages', 'public');
        }
        $medicine->update($medicineData);
        return redirect()->back()->with('message', 'modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, Medicine $medicine)
    {
        $OrderMedicines = OrderMedicine::where('medicine_id', '=', $medicine->id)->first();
        if ($OrderMedicines == null) {
            $medicine->forceDelete();
        } else {
            $medicine->delete();
        }
        return redirect()->back()->with('message', 'deleted successfully');
    }
}
