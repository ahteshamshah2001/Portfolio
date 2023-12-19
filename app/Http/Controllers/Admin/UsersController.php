<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Models\Admin;
use App\Models\User;

class UsersController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::getAllUsers();

        return view('admin.users.index',
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
        $courses = $this->courseRepository->all();
        $roles = $this->roleRepository->getRolesByUserType(['user_type' => 'user']);
        return view('admin.users.create', compact('courses', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method',
            'area_of_expertise'
        ]);

        $roles = $data['roles'];
        unset($data['roles']);

        $data['course_id'] = $request->input('areas_of_expertise');
        $data['per_day_rate'] = ($request->input('per_day_rate') != '') ? $request->input('per_day_rate') : 0;
        $data['per_hour_rate'] = ($request->input('per_hour_rate') != '') ? $request->input('per_hour_rate') : 0;

        if ($request->hasFile('photo')) {
            //move | upload file on server
            $photo         = $request->file('photo');
            $extension     = $photo->getClientOriginalExtension(); // getting file extension
            $filename      = strtolower(str_replace(' ', '-', $request->name)).'-'.time() . '.' . $extension;
            $photo->move(uploadsDir(), $filename);
            $data['photo'] = $filename;
        }

        $user = $this->userRepository->create($data);
        $user->roles()->sync($roles);

        event(new \App\Events\UserCreatedEvent($user));

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->userRepository->find($id);

        return view('admin.users.show',
            compact('data')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->userRepository->find($id);
        $courses = $this->courseRepository->all();
        $roles = $this->roleRepository->getRolesByUserType(['user_type' => 'user']);

        return view('admin.users.edit',
            compact('data', 'courses', 'roles')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateUserRequest $request
     * @param  User ID $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'previous_image',
            'areas_of_expertise'
        ]);

        $roles = $data['roles'];
        unset($data['roles']);

        $data['course_id'] = $request->input('areas_of_expertise');
        $data['per_day_rate'] = ($request->input('per_day_rate') != '') ? $request->input('per_day_rate') : 0;
        $data['per_hour_rate'] = ($request->input('per_hour_rate') != '') ? $request->input('per_hour_rate') : 0;

        //check file if exists
        if ($request->hasfile('photo')) {
            //move | upload file on server
            $file      = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $photo     = strtolower(str_replace(' ', '-', $request->name)).'-'.time() . '.' . $extension;
            $file->move(uploadsDir(), $photo);
            //remove/unlink if New uploaded successfully
            if (!empty($request->previous_image && file_exists(uploadsDir().$request->previous_image))) {
                unlink(public_path(uploadsDir().$request->previous_image));
            }
        } else {
            $photo     = $request->previous_image;
        }

        $data['photo'] = $photo;

        $this->userRepository->update($id, $data);
        $user = $this->userRepository->find($id);
        $user->roles()->sync($roles);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->userRepository->find($id);
        //remove/unlink if New uploaded successfully
        if (!empty($data->photo && file_exists(uploadsDir().$data->photo))) {
            unlink(public_path(uploadsDir().$data->photo));
        }

        $this->userRepository->delete($id);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User was deleted successfully.');
    }

    /**
     * Show the form for editing the password to specified resource.
     *
     * @return Response
     */
    public function changePassword()
    {
        return view('admin.users.changePassword');
    }

    /**
     * Update the password of specified resource in storage.
     *
     * @param UpdatePasswordRequest $request
     *
     * @return Response message
     */
    public function processChangePassword(UpdatePasswordRequest $request)
    {
        $id               = Auth::user()->id;
        $data['password'] = bcrypt($request->get('password'));

        Admin::where('id', $id)->update($data);

        return redirect()
            ->route('admin.users.change-password')
            ->with('success', 'Password has been changed successfully..');
    }
}
