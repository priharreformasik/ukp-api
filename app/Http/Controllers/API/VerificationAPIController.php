<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\User;
use App\Notifications\EmailVerification;
use Carbon\Carbon;

class VerificationAPIController extends Controller
{

    /**
     * Show the email verification notice.
     *
     */
    public function show()
    {
        $user = Auth::user();
        $users = User::where('id', Auth::user()->id)->first();
        if ($user->email_verified_at) {//cek apakah udah di verif belum
          return response()->json([
            'status'  => 'success',
            'message' => 'Email has been verified',
            'result' => $users
          ]);
        } else {
          return response()->json([
            'status'  => 'failed',
            'message' => 'Not verified',
            'result' => $users
          ]);
        }
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
      $user = Auth::user();
      $users = User::where('id', Auth::user()->id)->first();
      if ($user->email_verified_at) {
        return response()->json([
          'status'  => 'success',
          'message' => 'Email has been verified',
          'result' => $users
        ]);
      } else {
        if ($request->verification_code == $user->remember_token) {
          $user->email_verified_at = Carbon::now();
          $user->remember_token = null;
          // $user->status = 'Active';
          $user->save();
          return response()->json([
            'status'  => 'success',
            'message' => 'Email has been successfully verified',
            'result' => $users
          ]);
        }
        else {
          return response()->json([
            'status'  => 'failed',
            'message' => 'Verification code is wrong!',
            'result' => $users
          ]);
        }
      }
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend()
    {
        $user = Auth::user();
        // $users = User::where('id', Auth::user()->id)->first();
        if ($user->email_verified_at) {
          return response()->json([
            'status'  => 'failed',
            'message' => 'Email has been verified',
            'result' => $user
          ]);
        } else {
          $otp = mt_rand(111111, 999999);
          $user->remember_token = $otp;//agar yg dikirim tersimpan kedalam user ke remember token
          $user->save();

          // $pesan = $request->pesan;

          $user->notify(new EmailVerification($otp));//untuk kirim email

          return response()->json([
            'status'  => 'sent',
            'message' => 'Email has been sent',
            'result' => $user
          ]);
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
}
