<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StorePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionsController extends Controller
{
    private $permissionRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->middleware('auth:admin');

        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->permissionRepository->all();

        return view('admin.permissions.index',
            compact('records')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StorePermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method'
        ]);

        $this->permissionRepository->create($data);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $data = $this->permissionRepository->find($id);
//
//        return view('admin.permissions.show',
//            compact('data')
//        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $data = $this->permissionRepository->find($id);
//
//        return view('admin.permissions.edit',
//            compact('data')
//        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdatePermissionRequest  $request
     * @param  Permission ID  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, $id)
    {
//        $data = $request->except([
//            '_token',
//            '_method'
//        ]);
//
//        $this->permissionRepository->update($id, $data);
//
//        return redirect()
//            ->route('admin.permissions.index')
//            ->with('success', 'Permission has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $this->permissionRepository->delete($id);
//
//        return redirect()
//            ->route('admin.permissions.index')
//            ->with('success', 'Permission has been deleted successfully.');
    }
}
