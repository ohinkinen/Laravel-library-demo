<h1>{{ $book->title }}</h1>

<h2>You can find this book in these libraries:</h2>
<ul>
    @foreach ($libraries as $library)
    <li><a href="{{ url('/libraries/'.$library->id) }}">{{ $library->name }}</a></li>
    @endforeach
</ul>