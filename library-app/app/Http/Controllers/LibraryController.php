<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Library;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function getLibraries() {
        $libraries = Library::all();
        $books = Book::all();

        return view('librarylist', ['libraries' => $libraries, 'books' => $books]);
    }

    public function getLibrary($library_id) {
        $library = Library::where('id', $library_id)->first();
        $libraryBooks = $library->books()->get();
        $bookNames = [];
        foreach ($libraryBooks as $book) {
            array_push($bookNames, $book->title);
        }
        $books = Book::all();


        return view('library', ['library' => $library, 'libraryBooks' => $libraryBooks, 'bookNames' => $bookNames, 'books' => $books]);
    }

    public function addLibrary(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:libraries|max:255',
            'books' => 'array',
            'books.*' => 'string|max:255',
        ]);

        $library = Library::create([
            'name' => $validated['name']
        ]);

        $bookIds = [];

        if (array_key_exists('books', $validated)) {
            foreach ($validated['books'] as $book) {
                $foundBook = Book::firstOrCreate([
                    'title' => $book
                ]);
    
                array_push($bookIds, $foundBook->id);
            }
        }

        $library->books()->attach($bookIds);

        return redirect()->route('libraries');
    }

    public function editLibrary(Request $request) {
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required|max:255',
            'books' => 'array',
            'books.*' => 'string|max:255',
        ]);

        $library = Library::find($validated['id']);

        $library->name = $validated['name'];

        $library->save();

        $bookIds = [];

        if (array_key_exists('books', $validated)) {
            foreach ($request->books as $book) {
                $foundBook = Book::firstOrCreate([
                    'title' => $book
                ]);
    
                array_push($bookIds, $foundBook->id);
            }
        }

        $library->books()->sync($bookIds);

        return redirect("/libraries/$library->id");
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
