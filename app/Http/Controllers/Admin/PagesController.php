<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\UpdatePageRequest;
use App\Models\Page;
use App\Http\Requests\Admin\StorePageRequest;
use App\Models\MediaFile;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
        $records = Page::all();
        $restrictedPages = $this->getRestrictedPagesIds();

        return view(
            'admin.pages.index',
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

        return view('admin.pages.create', compact('mediaFile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method'
        ]);

        Page::create($data);

        return redirect()
            ->route('admin.pages.index')
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
        $data = Page::getPage(['pages.id' => $id]);

        return view(
            'admin.pages.show',
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
        $mediaFile       = MediaFile::all();
        $data            = Page::find($id);
        $restrictedPages = $this->getRestrictedPagesIds();

        return view(
            'admin.pages.edit',
            compact(
                'data',
                'mediaFile',
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
    public function update(UpdatePageRequest $request, $id)
    {
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

        Page::where('id', $id)->update($data);

        return redirect()
            ->route('admin.pages.index')
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
       Page::where('id', $id)->firstorfail()->delete();
        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page was removed successfully!');
    }
}
