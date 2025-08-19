<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\PublicationCategory;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PublicationCategory::get();
        $publications = Publication::with('category')->paginate(8);
        $latestPublication = Publication::with('category')
            ->latest()
            ->first();
        return view('pages.publication.index', compact('categories', 'publications', 'latestPublication'));
    }

    public function search(Request $request)
    {
        $query = Publication::with('category');

        if ($request->filled('category')) {
            $query->where('publication_category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $publications = $query->latest()->paginate(6)->appends($request->query());
        $categories = PublicationCategory::all();

        return view('pages.publication.search', compact('publications', 'categories'));
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
    public function show($slug)
    {
        $publication = Publication::where('slug', $slug)->firstOrFail();
        $otherPublications = Publication::where('slug', '!=', $slug)
            ->latest()
            ->limit(4)
            ->get();

        return view('pages.publication.detail', compact('publication', 'otherPublications'));
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
    public function update(Request $request, $id)
    {
        //
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
