<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\MediaFile;
use App\Models\Page;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        parent::__construct();
    }

    /**
     * Admin Dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $adminsCount      = Admin::count();
        $usersCount       = User::count();
        $rolesCount       = 0;
        $permissionsCount = 0;
        $industriesCount  = 0;
        $languagesCount   = 0;
        $skillsCount      = 0;
        $coursesCount     = 0;
        $mediaFilesCount  = MediaFile::count();
        $pagesCount       = Page::count();

        return view('admin.dashboard.index', compact(
            'adminsCount',
            'pagesCount',
            'usersCount',
            'rolesCount',
            'permissionsCount',
            'coursesCount',
            'skillsCount',
            'languagesCount',
            'industriesCount',
            'mediaFilesCount'
        ));
    }
}
