<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('pages.admin.category.index', compact('categories'), [
            'title' => 'Category'
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
            'url' => 'required',
        ]);

        $imagePath = $request->file('image')->store('category_images', 'public');

        Category::create([
            'title' => $validated['title'],
            'image' => $imagePath,
            'url' => $validated['url'],
        ]);

        return redirect()->back()->with('successAdd', 'Kategori berhasil ditambahkan.');
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
            'id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'url' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $category = Category::findOrFail($request->id);

        $dataUpdate = [
            'title' => $request->title,
            'url' => $request->url,
        ];

        if ($request->hasFile('image')) {
      
            if ($category->image && Storage::exists('public/' . $category->image)) {
                Storage::delete('public/' . $category->image);
            }

            $dataUpdate['image'] = $request->file('image')->store('category_images', 'public');
        }

        $category->update($dataUpdate);

        return redirect()->back()->with('successUpdate', 'Kategori berhasil diperbarui.');
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

        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->back()->with('successDelete', 'Kategori berhasil dihapus.');
    }
}
