@vite('resources/css/community.css')
@vite('resources/css/profile.css')
<style>
    p{
        color: white;
    }
</style>
<x-header></x-header>

<main>
    <p>{{$profile->name}}</p>
    <p>{{$profile->status}}</p>
    <p>Followers: {{ $followersCount }}</p>
    <p>Following: {{ $profile->following()->count() }}</p>
    <p>posts: {{ $postCount }}</p>
    <div>
        <h2>followers</h2>
        <ul>
        @foreach($followers as $f)
            <li>{{ $f->follower->name }}</li>
        @endforeach
        </ul>        
    </div>
    <div>
        <h2>following</h2>
        <ul>
        @foreach($following as $f)
            <li>{{ $f->following->name }}</li>
        @endforeach
        </ul>        
    </div>

    @auth
        @if(auth()->id() !== $profile->id)
            <form action="{{ route('follow.toggle') }}" method="POST">
                @csrf
                <input type="hidden" name="following_id" value="{{ $profile->id }}">
                <button type="submit" class="follow-btn">
                    {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                </button>
            </form>
        @endif
    @else
        <a href="{{ route('login') }}" class="follow-btn">Login to Follow</a>
    @endauth



</main>
</body>
</html>