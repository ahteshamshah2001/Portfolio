<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends BaseController
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = $this->responseValidation($request->all(), [
                'full_name' => 'required|string|min:3|max:30',
                'email' => 'required|email|max:40|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
                'company_name' => 'required|string|min:3|max:30',
                'country' => 'required|string|min:3|max:30',
                'description' => 'required|string|min:20|max:500',
            ]);

            /* @Validate Request */
            if ($validator->fails()) return $this->respondBadRequest($validator->errors());

            $query = Contact::create($request->all());

            DB::commit();

            return $this->respond($query, [], true, 'data retrieved successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondInternalError($e->getMessage());
        }
    }
}
