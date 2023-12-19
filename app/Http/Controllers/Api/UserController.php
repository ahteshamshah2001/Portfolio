<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function info(Request $request)
    {
        try {
            $getUserData = User::find($request->user()->id);
            return $this->respond($getUserData, [], true, __('responseMessages.dataRetrieved'));
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->respondSuccess(__('responseMessages.logout'));
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
//        try {
        DB::beginTransaction();
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:8'
        ]);

        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors());
        }
        $CheckPass = Hash::check($request->current_password, $request->user()->password);
        if ($CheckPass) {

            $newPassword = Hash::make($request->input('password'));
            User::find($request->user()->id)->update(['password' => $newPassword]);
            DB::commit();
            return $this->respondSuccess(__('responseMessages.changePasswordSuccessfully'));
        } else {
            return $this->respondMethodNotAllowed(__('responseMessages.oldPasswordNotMatch'));
        }

//        } catch (\Exception $e) {
//            DB::rollBack();
//            return $this->respondInternalError($e->getMessage());
//        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'string|min:3|max:30',
            'last_name' => 'string|min:3|max:30',
            'avatar' => 'nullable|image',
            'phone_no' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15'
        ]);
        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors());
        }
        try {
            DB::beginTransaction();
            $userData = $request->only(['first_name', 'last_name', 'phone_no']);
            if ($request->hasFile('avatar')) {
                $fileName = time() . '.' . $request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->move(public_path('uploads'), $fileName);
                $userData['profile_picture'] = "uploads/" . $fileName;
            }
            User::findOrFail($request->user()->id)->update($userData);
            $user = User::findOrFail($request->user()->id);
            DB::commit();
            return $this->respond($user, [], true, __('responseMessages.profileUpdate'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondInternalError($e->getMessage());
        }
    }
}
