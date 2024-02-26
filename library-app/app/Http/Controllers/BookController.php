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
}
