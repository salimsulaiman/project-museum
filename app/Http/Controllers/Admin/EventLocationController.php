<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (EventLocation::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
    public function index()
    {
        $locations = EventLocation::get();
        return view('pages.admin.event-location.index', compact('locations'), [
            'title' => 'Event Location'
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
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('event_location_images', 'public');

        $slug = $this->generateUniqueSlug($validated['name']);

        EventLocation::create([
            'name' => $validated['name'],
            'image' => $imagePath,
            'slug' => $slug,
        ]);

        return redirect()->back()->with('successAdd', 'Lokasi berhasil ditambahkan.');
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
            'id' => 'required|exists:event_locations,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $location = EventLocation::findOrFail($request->id);


        // Siapkan data update
        $dataUpdate = [
            'name' => $request->name,
        ];

        if ($request->name !== $location->name) {
            $dataUpdate['slug'] = $this->generateUniqueSlug($request->name);
        }

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($location->image && Storage::exists('public/' . $location->image)) {
                Storage::delete('public/' . $location->image);
            }

            // Upload gambar baru
            $dataUpdate['image'] = $request->file('image')->store('event_location_images', 'public');
        }

        // Update ke database
        $location->update($dataUpdate);

        return redirect()->back()->with('successUpdate', 'Lokasi berhasil diperbarui.');
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

        // Ambil kategori
        $location = EventLocation::findOrFail($id);

        // Hapus gambar jika ada di storage
        if ($location->image && Storage::exists('public/' . $location->image)) {
            Storage::delete('public/' . $location->image);
        }

        // Hapus kategori
        $location->delete();

        return redirect()
            ->back()
            ->with('successDelete', 'Lokasi berhasil dihapus.');
    }
}
