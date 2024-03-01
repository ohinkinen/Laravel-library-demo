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
    </ul>
</nav>


@if (Auth::user() && Auth::user()->role == 'user')
<h1>Hello user!</h1>
@elseif (Auth::user() && Auth::user()->role == 'admin')
<h1>Hello admin!</h1>
@else
<h1>Hello guest!</h1>
@endif

<h2>Libraries:</h2>
<ul>
    @foreach ($libraries as $library)
    <li>
        <a href="{{ url('/libraries/'.$library->id) }}">{{ $library->name }}</a>
        @if (Auth::user() && Auth::user()->role == 'admin')
        <form action="{{ route('deleteLibrary') }}" method="post">
            @method('delete')
            @csrf
            <button type="submit" value="{{ $library->id }}" name="id">Delete</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>

@if (Auth::user() && Auth::user()->role == 'admin')
<form action="{{ route('addLibrary') }}" method="POST">
    @csrf
    <fieldset id="books" style="width: 100px; max-height: 300px; overflow-y: scroll;">
        @foreach ($books as $book)
        <div>
            <input type="checkbox" id="{{ $book->title }}" name="books[]" value="{{ $book->title }}" />
            <label for="{{ $book->title }}">{{ $book->title }}</label>
        </div>
        <br />
        @endforeach
        <input type="text" id="newBook" maxlength="255" />
        <button type="button" onclick="addBook()">Add book</button>
    </fieldset>
    
    <input type="text" name="name" required maxlength="255"/>
    <button type="submit">Add library</button>
</form>
@endif

<p>This is for everyone!</p>