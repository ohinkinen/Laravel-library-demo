<h1>{{ $library->name }}</h1>

<h2>Book list:</h2>
<ul>
@foreach ($books as $book)
<li><a href="{{ url('/books/'.$book->id) }}">{{ $book->title }}</a></li>
@endforeach
</ul>
