<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Articles::all();
        return view('articles', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles_form');
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
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|string',
            'category' => 'required|string',
        ], $custom);
        Articles::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'category_id' => $request->category,
            'users_id' => Auth::user()->id
        ]);

        return redirect()->route('view.articles')->with(['message' => 'sukses tambah article']);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articles $articles)
    {
        return view('articles_edit', $articles);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articles $articles)
    {
        $custom = [
            'required' => ':attribute jangan dikosongkan',
            'string' => 'harus text'
        ];
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|string',
            'category' => 'required|string',
        ], $custom);
        Articles::where('id', $articles->id)
            ->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->image,
                'category_id' => $request->category,
                'users_id' => Auth::user()->id,
            ]);

        return redirect()->route('view.articles')->with(['message' => 'sukses update article']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articles $articles)
    {
        Articles::destroy('id', $articles->id);
        return redirect()->route('view.articles')->with(['message' => 'sukses delete article']);
    }
}
