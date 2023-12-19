<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RolesController extends Controller
{
    private $roleRepository;
    private $permissionRepository;

    /**
     * Create a new controller instance.
     *
     * @param RoleRepositoryInterface $roleRepository
     * @param PermissionRepositoryInterface $permissionRepository
     */
    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->middleware('auth:admin');

        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->roleRepository->all();

        return view('admin.roles.index',
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
        $permissions = $this->permissionRepository->getAllPermissionByAscendingOrder();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method',
            'sample_1_length'
        ]);

        $permissions = $data['permissions'];
        unset($data['permissions']);

        $role = $this->roleRepository->create($data);
        $role->permissions()->sync($permissions);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->roleRepository->getRoleWithPermissions(['id' => $id]);

        $data->load(['permissions' => function ($query) {
            $query->orderBy('id', 'asc');
        }]);
        
        return view('admin.roles.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->roleRepository->getRoleWithPermissions(['id' => $id]);
        $permissions = $this->permissionRepository->getAllPermissionByAscendingOrder();

        foreach ($permissions as $permission) {
            foreach ($data->permissions as $pivoPermissions) {
                if ($permission->id == $pivoPermissions->id) {
                    $permission->pivotPermissionId = $pivoPermissions->id;
                }
            }
        }

        return view('admin.roles.edit',
            compact('data', 'permissions')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateRoleRequest $request
     * @param  Role ID  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'sample_1_length'
        ]);

        $selectedPermissions = $data['permissions'];
        unset($data['permissions']);

        $role = $this->roleRepository->find($id);
        $this->roleRepository->update($id, $data);
        $role->permissions()->sync($selectedPermissions);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);
        $role->permissions()->detach();
        $this->roleRepository->delete($id);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role has been deleted successfully.');
    }
}
