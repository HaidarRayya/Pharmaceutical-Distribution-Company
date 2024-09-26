<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public static function accept($mailData, $to)
    {
        try {
            $GLOBALS['x'] = $to;
            Mail::send('email', [
                'data' => $mailData
            ], function ($message) {
                $message->to($GLOBALS['x']);
                $message->subject("accept the registration request");
            });
        } catch (Exception $ex) {
        }
    }
    public static function reject($mailData, $to)
    {
        try {
            $GLOBALS['x'] = $to;
            Mail::send('email', [
                'data' => $mailData
            ], function ($message) {
                $message->to($GLOBALS['x']);
                $message->subject("reject the registration request");
            });
        } catch (Exception) {
        }
    }
    public static function acceptOrder($mailData, $to)
    {
        try {
            $GLOBALS['x'] = $to;
            Mail::send('email', [
                'data' => $mailData
            ], function ($message) {
                $message->to($GLOBALS['x']);
                $message->subject("accept the order ");
            });
        } catch (Exception $ex) {
        }
    }
    public static function rejectOrder($mailData, $to)
    {
        try {
            $GLOBALS['x'] = $to;
            Mail::send('email', [
                'data' => $mailData
            ], function ($message) {
                $message->to($GLOBALS['x']);
                $message->subject("reject the order");
            });
        } catch (Exception) {
        }
    }
    public static function changePassword($mailData, $to)
    {
        try {
            $GLOBALS['x'] = $to;
            Mail::send('email', [
                'data' => $mailData
            ], function ($message) {
                $message->to($GLOBALS['x']);
                $message->subject("Verfication Code");
            });
        } catch (Exception) {
        }
    }
}
