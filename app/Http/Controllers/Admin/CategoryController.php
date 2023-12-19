<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UpdatePageRequest;
use App\Models\Category;
use App\Models\MediaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('auth:admin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Category::all();
        $restrictedPages = $this->getRestrictedPagesIds();
        return view(
            'admin.category.index',
            compact(
                'records',
                'restrictedPages'
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

        return view('admin.category.create', compact('mediaFile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories',
            'slug' => 'required'
        ]);

        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }
        $data = $request->except([
            '_token',
            '_method'
        ]);

        Category::create($data);

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Page has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Category::find($id);

        return view(
            'admin.category.show',
            compact('data')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $mediaFile       = MediaFile::all();
        $data            = Category::find($id);
        $restrictedPages = $this->getRestrictedPagesIds();
        return view(
            'admin.category.edit',
            compact(
                'data',
                'restrictedPages'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories',
            'slug' => 'required'
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

        // Slug of seeder based pages, need not to update,
        // as they are created from seeder.
        if (in_array($id, $this->getRestrictedPagesIds())) {
            unset($data['slug']);
        }

        Category::where('id', $id)->update($data);

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Page updated sucessfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', $id)->firstorfail()->delete();
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Page was removed successfully!');
    }
}
