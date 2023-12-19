<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BaseController;
use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = $this->responseValidation($request->all(), [
                'first_name' => 'required|string|min:3|max:30',
                'last_name' => 'required|string|min:3|max:30',
                'email' => 'required|email|unique:users,email|max:80|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
                'password' => 'required|min:8|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'min:8',
                'phone_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            ]);

            if ($validator->fails()) {
                return $this->respondBadRequest($validator->errors());
            }
            $array = [
                'password' => Hash::make($request->input('password')),
                'first_name' => str_replace("-", " ", htmlspecialchars($request->input('first_name'))),
                'last_name' => str_replace("-", " ", htmlspecialchars($request->input('last_name'))),
                'email' => htmlspecialchars(strtolower($request->input('email'))),
                'phone_no' => $request->input('phone_no'),
                'status' => 1
            ];
            $createdUser = User::create($array);
            if ($createdUser) {
                event(new Registered($createdUser));
                $userDetail = ['user' => $createdUser, 'token' => $this->createUserToken($createdUser, 'Register')];
                DB::commit();
                return $this->respond($userDetail, [], true, __('responseMessages.insertData'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = $this->responseValidation($request->all(), [
                'email' => 'required|email|max:40',
                'password' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                return $this->respondBadRequest($validator->errors());
            }
            $user = User::where('email', $request->input('email'))
                ->first();
            if ($user) {
                if (Hash::check($request->input('password'), $user->password)) {
                    if(!$user->hasVerifiedEmail()){
                        return $this->respondUnauthorized([], false, __('responseMessages.verifyEmail'));
                    }
                    if ($user->status != 0) {
                        $token = $this->createUserToken($user, 'login');
                        $response = ['token' => $token, 'user' => $user];
                        LoginLog::create([
                            'user_id' => $user->id,
                            'ip_address' => $request->ip(),
                            'user_agent' => $request->header('User-Agent')
                        ]);
                        $user->update(['device_id'=>$request->device_id]);
                        DB::commit();
                        return $this->respond($response, [], true, __('responseMessages.successfullyLogin'));
                    } else {
                        return $this->respondUnauthorized([], false, __('responseMessages.accountDeactivated'));
                    }

                } else {
                    return $this->respondUnauthorized([], false, __('responseMessages.incorrectEmailPassword'));
                }
            } else {
                return $this->respondUnauthorized([], false, __('responseMessages.incorrectEmailPassword'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondInternalError($e->getMessage());
        }
    }
}
