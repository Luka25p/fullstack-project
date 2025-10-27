<x-header></x-header>
@vite('resources/css/profile.css')
@vite('resources/css/manga.css')

<main>
<h2>All Chapters</h2>
<ul>
    @foreach($mangaChapter as $item)
        <li>
            Chapter {{ $item->number }} - 
            <a href="{{ route('mangaPanel', $chapter->id) }}">{{ $item->title }}</a>
        </li>
    @endforeach

</ul>


</main>
</body>
</html>

