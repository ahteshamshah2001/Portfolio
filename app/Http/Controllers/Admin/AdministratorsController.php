<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\StoreAdministratorRequest;
use App\Http\Requests\Admin\UpdateAdministratorRequest;
use App\Models\Admin;

class AdministratorsController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
        parent::__construct();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $records = Admin::all();
        return view('admin.administrators.index', compact('records'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = [];
        return view('admin.administrators.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdministratorRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAdministratorRequest $request)
    {
        $data = $request->except(
            [
                '_token',
                '_method'
            ]
        );

        $user = Admin::create($data);

        /*
         * Trigger AdminCreatedEvent
         */
        event(new \App\Events\AdminCreatedEvent($user));

        return redirect()
            ->route('admin.administrators.index')
            ->with('success', 'Administrator added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data = Admin::findOrFail($id);

        return view('admin.administrators.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = Admin::findOrFail($id);

        $roles = [];
        return view('admin.administrators.edit', compact('data', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAdministratorRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAdministratorRequest $request, $id)
    {
        $exceptFields = [
            '_token',
            '_method',
            'email'
        ];

        // 1 = super admin user id, and is_active status cannot be set for it
        if ($id == 1) {
            $exceptFields[] = 'is_active';
        }

        $data = $request->except($exceptFields);
        /*
         * Unset the roles variable so do not insert in the main admin table data
         */
        Admin::where('id', $id)->update($id, $data);

        return redirect()
            ->route('admin.administrators.index')
            ->with('success', 'Administrator updated successfully.');
    }

    /**
     * Removes the resource from database.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        // 1 = super admin user id, and it cannot be removed
        if ($id == 1) {
            return redirect()
                ->route('admin.administrators.index')
                ->with('error', 'This admin user cannot be deleted!');
        }

        $user = Admin::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('admin.administrators.index')
            ->with('success', 'Administrator was removed successfully!');
    }
}
