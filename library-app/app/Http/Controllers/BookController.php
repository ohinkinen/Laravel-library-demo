<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function getBooks() {
        $books = Book::all();

        return view('booklist', ['books' => $books]);
    }

    public function getBook($book_id) {
        $book = Book::where('id', $book_id)->first();
        $libraries = $book->libraries()->get();

        return view('book', ['book' => $book, 'libraries' => $libraries]);
    }

    public function addBook(Request $request) {
        $validated = $request->validate([
            'title' => 'required|unique:books|max:255',
        ]);

        $book = Book::create([
            'title' => $validated['title']
        ]);

        return redirect()->route('books');
    }

    public function editBook(Request $request) {
        $validated = $request->validate([
            'id' => 'required',
            'title' => 'required|max:255',
        ]);

        $book = Book::find($validated['id']);

        $book->title = $validated['title'];

        $book->save();

        return redirect("/books/$book->id");
    }

    public function deleteBook(Request $request) {
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        $book = Book::where('id', $validated['id'])->first();

        $book->libraries()->detach();

        $book->delete();

        return redirect()->route('books');
    }
}
