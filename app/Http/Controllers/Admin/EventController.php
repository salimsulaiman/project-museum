<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
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

        while (Event::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
    public function index()
    {
        $categories = EventCategory::get();
        $locations = EventLocation::get();
        $events = Event::with('category', 'location')->get();
        return view('pages.admin.event.index', compact('locations', 'categories', 'events'), [
            'title' => 'Event'
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
            'title'              => 'required|string|max:255',
            'thumbnail'          => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'event_category_id'  => 'required|exists:event_categories,id',
            'event_location_id'  => 'required|exists:event_locations,id',
            'location_detail'    => 'required|string|max:255',
            'content'            => 'required|string',
            'standing'           => 'nullable|integer',
            'classroom'          => 'nullable|integer',
            'round_table'        => 'nullable|integer',
            'u_shape'            => 'nullable|integer',
            'length'             => 'required|numeric',
            'width'              => 'required|numeric',
            'facility'           => 'required|string|max:255',
            'max_participant'    => 'required|integer',
            'contact'            => 'required|string|max:255',
            'pic'                => 'required|string|max:255',
            'description'        => 'required|string',
            'starting_date'      => 'required|date',
            'ending_date'        => 'nullable|date|after_or_equal:starting_date',
            'status'             => 'nullable|boolean',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('event_images', 'public');

        $slug = $this->generateUniqueSlug($validated['title']);

        Event::create([
            'title'             => $validated['title'],
            'slug'              => $slug,
            'thumbnail'         => $thumbnailPath,
            'event_category_id' => $validated['event_category_id'],
            'event_location_id' => $validated['event_location_id'],
            'location_detail'  => $validated['location_detail'],
            'content'           => $validated['content'],
            'standing'          => $validated['standing'] ?? null,
            'classroom'         => $validated['classroom'] ?? null,
            'round_table'       => $validated['round_table'] ?? null,
            'u_shape'           => $validated['u_shape'] ?? null,
            'length'            => $validated['length'] ?? null,
            'width'             => $validated['width'] ?? null,
            'facility'          => $validated['facility'],
            'max_participant'   => $validated['max_participant'],
            'contact'               => $validated['contact'],
            'pic'               => $validated['pic'],
            'description'       => $validated['description'],
            'starting_date'     => $validated['starting_date'],
            'ending_date'       => $validated['ending_date'] ?? null,
            'status'            => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan.');
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
            'id'                => 'required|exists:events,id',
            'title'             => 'required|string|max:255',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'event_category_id' => 'required|exists:event_categories,id',
            'event_location_id' => 'required|exists:event_locations,id',
            'location_detail'               => 'required|string|max:255',
            'content'           => 'required|string',
            'standing'          => 'nullable|integer',
            'classroom'         => 'nullable|integer',
            'round_table'       => 'nullable|integer',
            'u_shape'           => 'nullable|integer',
            'length'            => 'nullable|numeric',
            'width'             => 'nullable|numeric',
            'facility'          => 'required|string|max:255',
            'max_participant'   => 'required|integer',
            'contact'               => 'required|string|max:255',
            'pic'               => 'required|string|max:255',
            'description'       => 'required|string',
            'starting_date'     => 'nullable|date',
            'ending_date'       => 'nullable|date|after_or_equal:starting_date',
            'status'            => 'nullable|boolean',
        ]);

        $event = Event::findOrFail($request->id);

        $dataUpdate = [
            'title'             => $request->title,
            'event_category_id' => $request->event_category_id,
            'event_location_id' => $request->event_location_id,
            'location_detail' => $request->location_detail,
            'content'           => $request->content,
            'standing'          => $request->standing,
            'classroom'         => $request->classroom,
            'round_table'       => $request->round_table,
            'u_shape'           => $request->u_shape,
            'length'            => $request->length,
            'width'             => $request->width,
            'facility'          => $request->facility,
            'max_participant'   => $request->max_participant,
            'contact'               => $request->contact,
            'pic'               => $request->pic,
            'description'       => $request->description,
            'starting_date'     => $request->starting_date,
            'ending_date'       => $request->ending_date,
            'status'            => $request->has('status') ? 1 : 0,
        ];

        if ($request->title !== $event->title) {
            $dataUpdate['slug'] = $this->generateUniqueSlug($request->title);
        }

        if ($request->hasFile('thumbnail')) {
            if ($event->thumbnail && Storage::exists('public/' . $event->thumbnail)) {
                Storage::delete('public/' . $event->thumbnail);
            }

            $dataUpdate['thumbnail'] = $request->file('thumbnail')->store('event_images', 'public');
        }

        $event->update($dataUpdate);

        return redirect()->back()->with('successUpdate', 'Event berhasil diperbarui.');
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

        $event = Event::findOrFail($id);

        if ($event->image && Storage::exists('public/' . $event->image)) {
            Storage::delete('public/' . $event->image);
        }

        $event->delete();

        return redirect()
            ->back()
            ->with('successDelete', 'Event berhasil dihapus.');
    }
}
