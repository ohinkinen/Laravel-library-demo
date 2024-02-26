<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Library;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function getLibraries() {
        $libraries = Library::all();

        return view('librarylist', ['libraries' => $libraries]);
    }

    public function getLibrary($library_id) {
        $library = Library::where('id', $library_id)->first();
        $books = $library->books()->get();

        return view('library', ['library' => $library, 'books' => $books]);
    }

    public function addLibrary(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:libraries|max:255',
        ]);

        Library::create($validated);

        return redirect()->route('libraries');
    }

    public function editLibrary(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:libraries|max:255',
            'books' => 'array',
            'books.*' => 'string|max:255',
        ]);

        foreach ($validated['books'] as $book) {
            $foundBook = Book::firstOrCreate([
                'title' => $book
            ]);

            
        };
    }

    public function deleteLibrary(Request $request) {
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        $library = Library::where('id', $validated['id'])->first();

        $library->books()->detach();

        $library->delete();

        return redirect()->route('libraries');
    }
}
