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
    @if(Auth::id() === $chapter->user_id)
    <form action="{{ route('manga.uploadImages', ['id' => $chapter->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Select up to 15 images:</label>
        <input type="file" name="images[]" multiple accept="image/*">
        <button type="submit">Upload</button>
    </form>
    @endif

    @foreach($panels as $panel)
        <img src="{{ asset($panel->path) }}" alt="Chapter Panel" style="max-width:100%; height:auto;">
    @endforeach


</main>
</body>
</html>

