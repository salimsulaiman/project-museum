<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StructureSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StructureSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $structureSection = StructureSection::first();
        return view('pages.admin.structure-section.index', compact('structureSection'), [
            'title' => 'Structure Section'
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
            'id'    => 'required|exists:structure_sections,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $structureSection = StructureSection::findOrFail($request->id);

        // Simpan data title
        $structureSection->title = $request->title;

        // Kalau upload image baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($structureSection->image && Storage::exists('public/' . $structureSection->image)) {
                Storage::delete('public/' . $structureSection->image);
            }

            // Simpan gambar baru
            $path = $request->file('image')->store('structure-images', 'public');
            $structureSection->image = $path;
        }

        $structureSection->save();

        return redirect()->back()->with('success', 'Struktur Organisasi berhasil diperbarui.');
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
