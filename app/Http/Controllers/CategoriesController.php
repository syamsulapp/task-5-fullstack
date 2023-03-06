<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Categories::all();
        return view('categories', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $custom = [
            'required' => ':attribute jangan dikosongkan',
            'string' => 'harus text'
        ];
        $request->validate([
            'name' => 'required|string',
        ], $custom);
        Categories::create([
            'name' => $request->name,
            'users_id' => Auth::user()->id
        ]);

        return redirect()->route('view.categories')->with(['message' => 'sukses tambah categories']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        return view('categories_edit', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories)
    {
        $custom = [
            'required' => ':attribute jangan dikosongkan',
            'string' => 'harus text'
        ];
        $request->validate([
            'name' => 'required|string',
        ], $custom);
        Categories::where('id', $categories->id)
            ->update([
                'name' => $request->name,
                'users_id' => Auth::user()->id,
            ]);

        return redirect()->route('view.categories')->with(['message' => 'sukses update categories']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        Categories::destroy('id', $categories->id);
        return redirect()->route('view.categories')->with(['message' => 'sukses delete categories']);
    }
}
