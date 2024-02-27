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



<h1>{{ $book->title }}</h1>

@if ($libraries->isEmpty())
    <h2>Not available in any library</h2>
@else
<h2>You can find this book in these libraries:</h2>
<ul>
    @foreach ($libraries as $library)
    <li><a href="{{ url('/libraries/'.$library->id) }}">{{ $library->name }}</a></li>
    @endforeach
</ul>
@endif

@if (Auth::user() && Auth::user()->role == 'admin')
<form action="{{ url()->current() }}" method="POST">
    @method('put')
    @csrf
    <input type="text" name="title" required maxlength="255" value="{{ $book->title }}"/>
    <button type="submit" value="{{ $book->id }}" name="id">Edit library</button>
</form>
@endif