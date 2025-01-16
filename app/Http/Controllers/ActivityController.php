<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Book;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('activity.index', ['activities' => $activities]);
    }

    public function create()
    {
        return view('activity.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        Activity::create($request->all());
        return redirect()->route('activity.index')->with('success', 'Activity created successfully.');
    }

    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return view('activity.show', ['activity' => $activity]);
    }

    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        $books = Book::all();
        return view('activity.edit', ['activity' => $activity, 'books' => $books]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'books' => 'required|array|min:1'
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($request->except('books'));
        $activity->books()->sync($request->books);

        return redirect()->route('activity.index')->with('success', 'Activity updated successfully.');
    }


    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return redirect()->route('activity.index')->with('success', 'Activity deleted successfully.');
    }

    public function showBookActivities($id)
    {
        $book = Book::findOrFail($id);
        $activities = Activity::whereHas('books', function ($query) use ($id) {
            $query->where('book_id', $id);
        })->get();

        return view('book.activities', ['book' => $book, 'activities' => $activities]);
    }
}
