<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $footerSection = FooterSection::with('details')->first();
        return view('pages.admin.footer-section.index', compact('footerSection'), [
            'title' => 'Footer Section'
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
        'id' => 'required|exists:footer_sections,id',
        'title' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'address' => 'nullable|string|max:500',
    ]);

    $footerSection = FooterSection::findOrFail($request->id);

    $dataUpdate = [
        'title'   => $request->title,
        'address' => $request->address,
    ];

    if ($request->hasFile('logo')) {
        if ($footerSection->logo && Storage::exists('public/' . $footerSection->logo)) {
            Storage::delete('public/' . $footerSection->logo);
        }

        $dataUpdate['logo'] = $request->file('logo')->store('footer_logos', 'public');
    }

    $footerSection->update($dataUpdate);

    return redirect()->back()->with('successUpdate', 'Footer Section berhasil diperbarui.');
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
