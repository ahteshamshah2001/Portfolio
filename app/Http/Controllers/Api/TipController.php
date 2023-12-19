<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Tip;
use Illuminate\Http\Request;

class TipController extends BaseController
{
    public function index()
    {
        try {
            $data = Tip::where('status', '1')
                ->with('category')
                ->paginate(10);
            return $this->respond($data, [], true, __('responseMessages.dataRetrieved'));
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }
}
