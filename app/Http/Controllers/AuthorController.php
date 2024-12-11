<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $author = Author::all();

        return view('author.index', [
            'authors' => $author
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'description' => 'required',
            'nationality' => 'required|max:255',
            'author_photo_url' => 'nullable|url'
        ]);

        Author::create($validated);
        return redirect()->route('author.index')->with('success', 'Author created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function showAdmin(string $id)
    {
        $author = Author::findOrFail($id);
        return view('author.show', compact('author'));
    }

public function showUser(string $id)
{
    $author = Author::findOrFail($id);
    return view('authors.details', compact('author'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $author = Author::findOrFail($id);
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'description' => 'required',
            'nationality' => 'required|max:255',
            'author_photo_url' => 'nullable|url'
        ]);

        $author = Author::findOrFail($id);
        $author->update($validated);
        return redirect()->route('author.index')->with('success', 'Author updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return redirect()->route('author.index')->with('success', 'Author deleted successfully');
    }
}
