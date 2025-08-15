<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::get();
        return view('pages.admin.banner.index', compact('banners'), [
            'title' => 'Banner'
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        // Upload gambar
        $imagePath = $request->file('image')->store('banner_images', 'public');

        // Simpan data banner
        Banner::create([
            'title' => $validated['title'],
            'image' => $imagePath,
            'description' => $validated['description'],
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->back()->with('successAdd', 'Banner berhasil ditambahkan.');
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
            'id' => 'required|exists:banners,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $banner = Banner::findOrFail($request->id);

        // Siapkan data update
        $dataUpdate = [
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($banner->image && Storage::exists('public/' . $banner->image)) {
                Storage::delete('public/' . $banner->image);
            }

            // Upload gambar baru
            $dataUpdate['image'] = $request->file('image')->store('banner_images', 'public');
        }

        // Update ke database
        $banner->update($dataUpdate);

        return redirect()->back()->with('successUpdate', 'Banner berhasil diperbarui.');
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

        $banner = Banner::findOrFail($id);

        $banner->delete();

        return redirect()->back()->with('successDelete', 'Banner berhasil dihapus.');
    }
}
