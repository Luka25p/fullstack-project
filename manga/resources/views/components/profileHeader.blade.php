
<div class="profile-info">
    <div class="profile-info-container">
        @if(Auth::check())
            <section>
                <img src="" alt="">
                <div>
                    <a href="{{ url('dashboard') }}">{{ Auth::user()->name }}</a>
                    <p>{{ Auth::user()->status}}</p>
                </div>
            </section>
            <section>
                <a href="{{ url('addManga') }}"> + </a>
            </section>
            <section>
                <a href="{{ url('favorites') }}"> 
                    <i class="fa-solid fa-bookmark"></i>
                </a>  
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit">Log out</button>
                </form>

                <button id="notification">
                    <i class="fa-solid fa-bell"></i>
                    @auth
                        <span>
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endauth
                </button>
                <i class="fa-solid fa-gear"></i>
            </section>
        @else
            <h1>Welcome, Guest</h1>
            <p>Your email: Not logged in</p>
        @endif  
    </div>
</div> 