<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $search = $request->input('search');

        $companies = CompanyController::index($search);
        return view('Admin.admintable', ['companies' => $companies]);
    }


    public function showAcceptRejectPage()
    {
        $users = User::where('status', '=', 'waiting')->paginate(6);

        return view('Admin.acceptreject', ['users' => $users]);
    }
    public function accept(User $user)
    {

        $user->update(['status' => 'accept']);
        $data = [
            'subject' => " accepting the registration request on the site",
            "body" =>  "hello " . " " . $user->firstname . " "  . $user->lastname . " " .  " the request to register on the site has been accepted"
        ];

        EmailController::accept($data, $user->email);
        return redirect()->back()->with('message', 'the request has been accepted successfully ');
    }
    public function reject(User $user)
    {
        $data = [
            'subject' => " rejecting the request to register on the site",
            "body" =>  "hello" . " " . $user->firstname . " "  . $user->lastname . " " .  " the request to  register on the site has been rejected "
        ];

        EmailController::reject($data, $user->email);
        $user->delete();
        return redirect()->back()->with('message', 'the request has been deleted successfully ');
    }
}
