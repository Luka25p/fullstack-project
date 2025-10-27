@vite('resources/css/details.css')
@vite('resources/js/details.js')

<x-header></x-header>
<?php $search = "";?>
<main>
<script>
    // Toast function
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
        toast.textContent = message;
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

    window.onload = function() {
        @if(session('success'))
            showToast("{{ session('success') }}", "success");
        @endif

        @if(session('delete'))
            showToast("{{ session('delete') }}", "error");
        @endif
    };
</script>



    <x-search :search='$search'></x-search>
    <div class="card">
        <img src="{{ asset($manga->image) }}" alt="{{ $manga->title }}">
        <section>
            <div class="card-detail-info">
                <form action="{{ route('favorites.toggle') }}" method="POST">
                    @csrf
                    <input type="hidden" name="manga_id" value="{{ $manga->id }}">
                    <button type="submit" id="favorites">
                        <i class="fa-solid fa-bookmark"></i>
                    </button>
                </form>
                <a href="{{ route('manga.details', $manga->user_id) }}">{{$manga->auth}}</a>
                <h2>{{$manga->title}}</h2>
                <p class="card-detail-genre">{{$manga->genre}}</p>
                <p>{{$manga->descr}}</p>
            </div>
            <div class="card-detail-read">
                <a href="{{ route('manga.chapters', $manga->id) }}" class="details">read</a>
            </div>
            <div class="card-detail-details">
                <span>chapter: {{$chapterNumber}}</span>
                @foreach($dates as $item)
                <span>{{$item->day}}.{{$item->month}}.{{$item->year}}</span>  
                @endforeach                   
            </div>
        </section>
    </div>
</main>
</body>
</html>