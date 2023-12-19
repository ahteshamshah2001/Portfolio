<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MediaFile;
use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipController extends Controller
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
        $records = Tip::paginate(10);

        return view(
            'admin.tip.index',
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
        $category = Category::where('status',1)->get();
        return view('admin.tip.create', compact('mediaFile','category'));
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
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }
        $data = $request->except([
            '_token',
            '_method',
            'image'
        ]);
        $file = $request->file('image');
        $getImage = $this->image_upload($file);
        $data['media'] = $getImage;
        Tip::create($data);
        return redirect()
            ->route('admin.tip.index')
            ->with('success', 'Tip has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Tip::find($id);
        return view(
            'admin.tip.show',
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
        $data = Tip::find($id);
        return view(
            'admin.tip.edit',
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
        Tip::where('id', $id)->update($data);
        return redirect()
            ->route('admin.tip.index')
            ->with('success', 'Tip updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tip::where('id', $id)->firstorfail()->delete();
        return redirect()
            ->route('admin.tip.index')
            ->with('success', 'Tip was removed successfully!');
    }
}
