<x-header></x-header>
@vite('resources/css/profile.css')
@vite('resources/js/dashboard.js')

<main> 
    <x-profileHeader></x-profileHeader>
    <div class="leftsection">
        <section class="infospans" class="infospans">
            <span>read</span>
            <span>5</span>
        </section>
        <button id="followers" class="infospans">
            Followers
            <span>{{ $followersCount }}</span>
        </button>
        <button id="following" class="infospans">
            Following
            <span>{{ $profile->following()->count() }}</span>
        </button>
        <section class="infospans" class="infospans">
            <p>posts</p>
            <p>{{ $postCount }}</p>
        </section>
    </div>
    <div class="following-card">
        <section class="filter"></section>
        <section>
            <h2>following</h2>
            <ul>
            @foreach($following as $f)
                <li><a href=" {{ route('profile.show', $f->following->id) }} ">{{ $f->following->name }}</a></li>
            @endforeach
            </ul>               
        </section>
    </div>
    <div class="followers-card">
        <section class="filter2"></section>
        <section>
            <h2>followers</h2>
            <ul>
            @foreach($followers as $f)
                <li><a href=" {{ route('profile.show', $f->follower->id) }} ">{{ $f->follower->name }}</a></li>
            @endforeach
            </ul>              
        </section>
    </div>
    @auth
        <div class="notificationCard">
            <section class="filter3"></section>
            <section>
                <h2>Notification</h2>
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <a href="{{ route('profile.show', $notification->data['follower_id']) }}">
                        {{ $notification->data['follower_name'] }} followed you!
                    </a>
                @endforeach                            
            </section>
        </div>
    @endauth
    <!-- <form action="{{ route('dashboard.update', Auth::id() ) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Name:</label>
        <input type="text" name="name" value="{{ Auth::user()->name }}" required>

        <button type="submit">Update</button>
    </form> -->
    <div class="communityPosts">
        @forelse($posts as $community)
            <section>
                <p class="user"><a href="{{ route('profile.show', $community->user_id) }}">{{ $community->author }}</a></p>
                <h2>{{ $community->title }}</h2>
                <p>{{ $community->descr }}</p>
                <span>{{ $community->created_at}}</span>
            </section>
        @empty
            <p>No community posts found.</p>
        @endforelse
    </div>


</main>
</body>
</html>