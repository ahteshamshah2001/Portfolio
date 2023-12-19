<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotPasswordController extends BaseController
{
    public function reset_password_request(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return $this->respondBadRequest($validator->errors());
            }
            $customer = User::Where(['email' => $request['email']])->first();

            if (isset($customer)) {
                $token = Str::random(20);
                DB::table('password_resets')->where('email',$request['email'])->delete();
                //PasswordReset::where('email',$request['email'])->delete();
                DB::table('password_resets')->insert([
                    'email' => $customer['email'],
                    'token' => $token,
                    'created_at' => now(),
                ]);
                $reset_url = url('/') . '/customer/auth/reset-password?token=' . $token;
                $reset_url = 'http://car-show-hero.developer-ourbase-camp.com/new-password?token='.$token;
                Mail::to($customer['email'])->send(new \App\Mail\PasswordResetMail($reset_url));
                return $this->respond([],[],200,"Email sent successfully.");
//                return response()->json(['message' => 'Email sent successfully.'], 200);
            }
//            return response()->json(['errors' => [
//                ['code' => 'not-found', 'message' => 'Email not found!']
//            ]], 404);
            return $this->respond([],[],404,"Email not found!");

        }catch (\Exception $e){
            return $this->respond([],[],500,$e->getMessage());
        }
    }

    public function reset_password_submit(Request $request)
    {
        try {
            $data = DB::table('password_resets')->where(['token' => $request['reset_token']])->first();
            if (isset($data)) {
                if ($request['password'] == $request['confirm_password']) {
                    DB::table('users')->where(['email' => $data->email])->update([
                        'password' => (Hash::make($request->confirm_password))
                    ]);
                    DB::table('password_resets')->where(['token' => $request['reset_token']])->delete();
                    $data = User::where('email',$request->email)->first();
                    return $this->respond($data,[],200,"Password changed successfully.");
                }
                return $this->respond([],[['code' => 'mismatch', 'message' => 'Password did,t match!']],401,"Password did,t match!");
            }
            return $this->respond([],[['code' => 'invalid', 'message' => 'Invalid token.']],400,"Invalid token.");
        }catch (\Exception $e){
            return $this->respond([],[],500,$e->getMessage());
        }

    }
}
