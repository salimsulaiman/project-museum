<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\CollectionCategory;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CollectionCategory::get();
        $collections = Collection::with('category')->latest()->paginate(12);
        return view('pages.collection.index', compact('categories', 'collections'));
    }

   public function search(Request $request)
    {
      $query = $request->input('q');
    $categoryId = $request->input('category');

   $collections = Collection::query()
    ->when($query, function ($q) use ($query) {
        $q->where('name', 'like', "%{$query}%");
    })
    ->when($categoryId, function ($q) use ($categoryId) {
        $q->where('collection_category_id', $categoryId);
    })
    ->latest()
    ->paginate(9);

$collections->appends([
    'q' => $query,
    'category' => $categoryId,
]);

    $categories = CollectionCategory::all();

    return view('pages.collection.search', compact('collections', 'categories', 'query', 'categoryId'));
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
        $collection = Collection::with('images')->where('slug', $slug)->firstOrFail();
        return view('pages.collection.detail', compact('collection'));
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
