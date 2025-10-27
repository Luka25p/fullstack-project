<x-header></x-header>
@vite('resources/css/profile.css')
@vite('resources/css/manga.css')

<main>
    
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Auth::id() === $manga->user_id)
        <form action="{{ route('manga.uploadChapter', ['id' => $manga->id]) }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Chapter Title">
            <button type="submit">Upload</button>
        </form>
    @endif

    <h2>All Chapters</h2>
    <ul>
        @foreach($chapters as $chapter)
            <li>
                Chapter {{ $chapter->number }} -
                <a href="{{ route('manga.mangaPanel', $chapter->id) }}">{{ $chapter->title }}</a>
            </li>
        @endforeach
    </ul>

</main>
</body>
</html>
