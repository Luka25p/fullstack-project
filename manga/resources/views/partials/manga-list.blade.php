@foreach($manga as $item)
    <a href="{{ route('manga.details', $item->id) }}" class="details">
        <div class="card">
            <img src="{{ $item->image }}" alt="">
            <section>
                <h1>{{ $item->title }}</h1>
                <div>
                    <span> chapters: {{ $item->chapter }}</span>
                    <span>{{ $item->auth }}</span>                           
                </div>
            </section>
        </div>
    </a>
@endforeach
