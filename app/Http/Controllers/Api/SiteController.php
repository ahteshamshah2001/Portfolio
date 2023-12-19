<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\NewsTicker;
use App\Models\Page;
use App\Models\PodCast;
use Illuminate\Http\Request;

class SiteController extends BaseController
{
    public function showTicker()
    {
        try {
            $data = NewsTicker::get();
            return $this->respond($data, [], true, __('responseMessages.dataRetrieved'));
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    public function showCategory()
    {
        try {
            $data = Category::where('status', '1')
                ->paginate(10);
            return $this->respond($data, [], true, __('responseMessages.dataRetrieved'));
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    public function showPodcast()
    {
        try {
            $data = PodCast::where('status', '1')
                ->with(['category'])
                ->paginate(10);
            return $this->respond($data, [], true, __('responseMessages.dataRetrieved'));
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    public function showBlog()
    {
        try {
            $data = Blog::where('status', '1')->paginate(10);
            return $this->respond($data, [], true, __('responseMessages.dataRetrieved'));
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    public function showPages()
    {
        try {
            $data = Page::paginate(10);
            return $this->respond($data, [], true, __('responseMessages.dataRetrieved'));
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }
}
