<x-header></x-header>
@vite('resources/css/profile.css')
@vite('resources/css/manga.css')


<main>
    <x-profileHeader></x-profileHeader>
    <h2>My Favorites</h1>

    <div class="wrapper">   
        @foreach($favorites as $item)
            <a href="{{ route('manga.details', $item->manga->id) }}" class="details">
                <div class="card">
                    <img src="{{ $item->manga->image }}" alt="">
                    <section>
                        <h1>{{ $item->manga->title }}</h1>
                        <div>
                            <span> chapters: {{ $item->manga->chapter }}</span>
                            <span>{{ $item->manga->auth }}</span>                           
                        </div>
                    </section>
                </div>    
            </a>
        @endforeach      
    </div>
    


</main>
</body>
</html>

