@vite('resources/css/search.css')
   
   <form action="{{ route('manga.index') }}" method="GET" class="search-form">
        <ul>
            <li><a href="{{ route('genre.fantastic') }}">fantastic</a></li>
            <li><a href="{{ route('genre.historic') }}">historic</a></li>
            <li><a href="">sifi</a></li>
        </ul>
        <section>
            <input type="search" name="search" value="{{ $search }}" id="search">
            <input type="submit" value="serach">            
        </section>
        <ul>
            <li><a href=""><i class="fa-solid fa-cart-shopping"></i> </a></li>
        </ul>
    </form>