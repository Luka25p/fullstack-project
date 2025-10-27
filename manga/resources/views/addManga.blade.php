<x-header></x-header>
@vite('resources/css/profile.css')
@vite('resources/css/login.css')


    <main>
        <x-profileHeader></x-profileHeader>
        @if(Auth::check())

        <form action="{{ route('manga.store') }}" method="POST" enctype="multipart/form-data" class="form-card">
            @csrf
            <h2>Create Manga</h2>
            <div class="form-group">
                <label for="manga-title">Title:</label>
                <input type="text" id="manga-title" name="title" required>
            </div>
            <div class="form-group">
                <label for="manga-descr">Description:</label>
                <input type="text" id="manga-descr" name="descr" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="manga-genre">Genre:</label>
                <select id="manga-genre" name="genre">
                    <option value="FANTASTIC">Fantastic</option>
                    <option value="SIFI">Sci-Fi</option>
                    <option value="HISTORIC">Historic</option>
                </select>
            </div>
            <input type="hidden" id="manga-auth" name="auth" value="{{ Auth::user()->name }}" required>
            <button type="submit">Create Manga</button>
        </form>
        @endif
    </main>
</body>
</html>

