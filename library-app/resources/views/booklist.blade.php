<nav>
    <ul>
        <li>
            <a href='libraries'>Libraries</a>
        </li>
        <li>
            <a href='books'>Books</a>
        </li>
        <li>
            <a href='bookcrud'>Book CRUD</a>
        </li>
    </ul>
</nav>

<h1>Books:</h1>

<ul>
    @foreach ($books as $book)
    <li><a href="{{ url('/books/'.$book->id) }}">{{ $book->title }}</a></li>
    @endforeach
</ul>