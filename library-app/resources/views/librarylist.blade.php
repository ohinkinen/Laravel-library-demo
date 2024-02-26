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

<h2>Libraries:</h2>
<ul>
    @foreach ($libraries as $library)
    <li>
        <a href="{{ url('/libraries/'.$library->id) }}">{{ $library->name }}</a>
        @if (Auth::user()->role == 'admin')
        <form action="{{ route('deleteLibrary') }}" method="post">
            @method('delete')
            @csrf
            <button type="submit" value="{{ $library->id }}" name="id">Delete</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>
@if (Auth::user()->role == 'user')
<h1>Hello user!</h1>
@elseif (Auth::user()->role == 'admin')
<h1>Hello admin!</h1>
@endif

<form action="{{ route('addLibrary') }}" method="POST">
    @csrf
    <input type="text" required maxlength="255" name="name" />
<button type="submit">Add library</button>
</form>

<p>This is for everyone!</p>