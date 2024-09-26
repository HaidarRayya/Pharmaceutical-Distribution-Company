<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Models\User;
use App\Models\VerficationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{

    public function inputEmailPage()
    {
        return view('Auth.forgetPassword.forgetpassemail');
    }
    public function inputEmail(Request $request)
    {

        $data = $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', '=', $data['email'])->first();
        if (!$user) {
            return redirect()->back()->with('message', 'the email you  enetered is incorrect');
        }

        $code = random_int(10000, 99999);
        VerficationCode::create([
            'user_id' => $user->id,
            'code' =>  $code,
        ]);
        $msg = [
            'subject' => "password reset code ",
            "body" =>   "password reset code is " . $code
        ];
        EmailController::changePassword($msg, $user->email);
        return redirect('/inputVerficationCodePage')->with('email', $data['email']);
    }
    public function inputVerficationCodePage()
    {
        return view('Auth.forgetPassword.forgetpasscode');
    }
    public function inputVerficationCode(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'code' => 'required',
        ]);

        $user = User::where('email',  $request->email)->first();
        $confirmOrder = VerficationCode::where('user_id', '=',  $user->id)->orderByDesc('created_at')->first();

        $code = $confirmOrder->code;
        if ($code !=  $request->code) {
            return redirect()->back()->with('message',  "the code you entered is incorrect ,please check it and try again ")->with('email', $data['email']);
        };

        return redirect('/inputPasswordPage')->with('email', $data['email']);
    }

    public function inputPasswordPage()
    {
        return view('Auth.forgetPassword.changepassowrd');
    }
    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'confirmPassword' => 'required',
        ]);
        if ($data['password'] != $data['confirmPassword']) {
            return redirect()->back()->with('message', 'password mismatch')->with('email', $data['email']);
        }
        $user = User::where('email', '=', $data['email'])->first();

        $user->update([
            'password' => Hash::make($request->password)
        ]);
        VerficationCode::where('user_id', '=', $user->id)->delete();

        return redirect('/signin')->with('message', 'the password has been updated successfully');
    }
}
