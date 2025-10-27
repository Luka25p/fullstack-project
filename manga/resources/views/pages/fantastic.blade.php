<x-header></x-header>
@vite('resources/css/manga.css')
<?php $search = ""?>


<main>
    <x-search :search='$search'></x-search>
    <div class="wrapper">   
        @foreach($fantastic as $item)
            <a href="{{ route('details', $item->id) }}" class="details">
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
    </div>
 
</main>
</body>
</html>

