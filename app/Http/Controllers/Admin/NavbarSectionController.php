<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavbarSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NavbarSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navbarSection = NavbarSection::with('links')->first();
        return view('pages.admin.navbar-section.index', compact('navbarSection'), [
            'title' => 'Navbar Section'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:navbar_sections,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $section = NavbarSection::findOrFail($request->id);

        $dataUpdate = [];

        if ($request->hasFile('image')) {
            if ($section->logo && Storage::exists('public/' . $section->logo)) {
                Storage::delete('public/' . $section->logo);
            }

            $dataUpdate['logo'] = $request->file('image')->store('navbar', 'public');
        }

        $section->update($dataUpdate);

        return redirect()->back()->with('successUpdate', 'Navbar section berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
