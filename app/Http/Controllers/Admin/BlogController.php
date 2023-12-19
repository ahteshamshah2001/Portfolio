<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\MediaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        parent::__construct();
        $this->middleware('auth:admin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Blog::all();

        return view(
            'admin.blog.index',
            compact(
                'records',
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mediaFile = MediaFile::all();

        return view('admin.blog.create', compact('mediaFile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:blogs',
            'slug' => 'required',
            'added_by' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }
        $data = $request->except([
            '_token',
            '_method'
        ]);
        $file = $request->file('image');
        $getImage = $this->image_upload($file);
        $data['image'] = $getImage;
        $data['admin_id'] = $request->user()->id;
        Blog::create($data);
        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Page has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Blog::find($id);
        return view(
            'admin.blog.show',
            compact('data')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Blog::find($id);
        return view(
            'admin.blog.edit',
            compact(
                'data'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'added_by' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }

        $data = $request->except([
            '_token',
            '_method',
            'page_id'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $this->image_upload($file);
        }
        Blog::where('id', $id)->update($data);
        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::where('id', $id)->firstorfail()->delete();
        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog was removed successfully!');
    }
}
