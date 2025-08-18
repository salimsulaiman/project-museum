<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSection;
use App\Models\FooterSectionDetail;
use Illuminate\Http\Request;

class FooterSectionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $section = FooterSectionDetail::first();

        if (!$section) {
            return redirect()->back()->with('error', 'Footer section belum dibuat.');
        }

        return view('navbar-links.create', compact('section'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'navigation' => 'required|string|max:255',
            'href' => 'required|string|max:255',
        ]);

        $section = FooterSection::first();

        FooterSectionDetail::create([
            'footer_section_id' => $section->id,
            'navigation' => $request->navigation,
            'href' => $request->href,
        ]);

        return redirect()->back()->with('successAdd', 'Footer link berhasil ditambahkan.');
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
            'id' => 'required|exists:footer_section_details,id',
            'navigation' => 'required|string|max:255',
            'href' => 'required|string|max:255',
        ]);

        $link = FooterSectionDetail::findOrFail($request->id);
        $link->update([
            'navigation' => $request->navigation,
            'href' => $request->href,
        ]);

        return redirect()->back()->with('successUpdate', 'Link footer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request)
    {
        $id = $request->id;

        $link = FooterSectionDetail::findOrFail($id);

        $link->delete();

        return redirect()->back()->with('successDelete', 'Link footer berhasil dihapus.');
    }
}
