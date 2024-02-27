<nav>
    <ul>
        <li>
            <a href='{{ route("libraries") }}'>Libraries</a>
        </li>
        <li>
            <a href='{{ route("books") }}'>Books</a>
        </li>
        <li>
            <a href='bookcrud'>Book CRUD</a>
        </li>
    </ul>
</nav>


<h1>Books:</h1>

<ul>
    @foreach ($books as $book)
    <li>
        <a href="{{ url('/books/'.$book->id) }}">{{ $book->title }}</a>
        @if (Auth::user() && Auth::user()->role == 'admin')
        <form action="{{ route('deleteBook') }}" method="POST">
            @method('delete')
            @csrf
            <button type="submit" value="{{ $book->id }}" name="id">Delete</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>

@if (Auth::user() && Auth::user()->role == 'admin')
<form action="{{ route('addBook') }}" method="POST">
    @csrf
    <input type="text" name="title" required maxlength="255"/>
    <button type="submit">Add book</button>
</form>
@endif