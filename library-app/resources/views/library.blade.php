<head>
    <script>
        function addBook() {
            const newBook = document.getElementById('newBook');
            const fieldset = document.getElementById('books');
            const newCheckbox = document.createElement('input');
            const newLabel = document.createElement('label');

            newCheckbox.setAttribute('type', 'checkbox');
            newCheckbox.setAttribute('id', `${newBook.value}`);
            newCheckbox.setAttribute('name', 'books[]');
            newCheckbox.setAttribute('value', `${newBook.value}`);
            newCheckbox.checked = true;

            newLabel.setAttribute('for', `${newBook.value}`);
            newLabel.innerText = `${newBook.value}`;

            fieldset.insertBefore(newCheckbox, newBook);
            fieldset.insertBefore(newLabel, newBook);

            newBook.value = '';
        }
    </script>
</head>

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


<h1>{{ $library->name }}</h1>

@if ($libraryBooks->isEmpty())
<h2>No books available</h2>
@else
<h2>Book list:</h2>
<ul>
@foreach ($libraryBooks as $book)
<li><a href="{{ url('/books/'.$book->id) }}">{{ $book->title }}</a></li>
@endforeach
</ul>
@endif

@if (Auth::user() && Auth::user()->role == 'admin')
<form action="{{ url()->current() }}" method="POST">
    @method('put')
    @csrf
    <fieldset id="books" style="width: 100px; max-height: 300px; overflow-y: scroll;">
        @foreach ($books as $book)
        <div>
            @if (in_array($book->title, $bookNames))
            <input type="checkbox" id="{{ $book->title }}" name="books[]" value="{{ $book->title }}" checked />
            @else
            <input type="checkbox" id="{{ $book->title }}" name="books[]" value="{{ $book->title }}" />
            @endif
            <label for="{{ $book->title }}">{{ $book->title }}</label>
        </div>
        <br />
        @endforeach
        <input type="text" id="newBook" maxlength="255" />
        <button type="button" onclick="addBook()">Add book</button>
    </fieldset>
    
    <input type="text" name="name" required maxlength="255" value="{{ $library->name }}"/>
    <button type="submit" value="{{ $library->id }}" name="id">Edit library</button>
</form>
@endif
