@vite('resources/css/community.css')
<x-header></x-header>

<main>
    <script>
        if (!document.getElementById("toast-container")) {
            const container = document.createElement("div");
            container.id = "toast-container";
            container.style.position = "fixed";
            container.style.top = "20px";
            container.style.right = "20px";
            container.style.zIndex = "9999";
            document.body.appendChild(container);
        }

        function showToast(message, type = "success") {
            const toast = document.createElement("div");
            toast.innerHTML = `
                <div style="display:flex; align-items:center; gap:8px;">
                    <span style="font-weight:bold;">${type === 'success' ? '✔' : '❌'}</span>
                    <span>${message}</span>
                </div>
            `;
            toast.style.padding = "12px 18px";
            toast.style.marginTop = "10px";
            toast.style.borderRadius = "8px";
            toast.style.fontSize = "14px";
            toast.style.fontWeight = "500";
            toast.style.color = type === "success" ? "#065f46" : "#991b1b";
            toast.style.background = type === "success" ? "#d1fae5" : "#fee2e2";
            toast.style.border = type === "success" ? "1px solid #10b981" : "1px solid #ef4444";
            toast.style.opacity = "1";
            toast.style.transition = "opacity 0.5s ease";

            document.getElementById("toast-container").appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = "0";
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }

        // Show Laravel validation errors or session messages
        window.onload = function() {
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    showToast("{{ $error }}", "error");
                @endforeach
            @endif

            @if(session('success'))
                showToast("{{ session('success') }}", "success");
            @endif
        };
    </script>
    @if(Auth::check())
        <form action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>Create Community Post</h2>

            <div class="form-group">
                <input type="text" id="title" name="title" value="" required placeholder="title">
                <textarea type="text" id="descr" name="descr" value="" required placeholder="description"></textarea>
            </div>

            <input type="hidden" name="author" value="{{ Auth::user()->name }}">

            <button type="submit">Create Post</button>
        </form>
    @endif

    <div class="communityPosts">
        @forelse($communities as $community)
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