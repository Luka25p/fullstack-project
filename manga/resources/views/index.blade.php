<x-header></x-header>
@vite('resources/css/manga.css')
<?php $search=""?>
<main>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <x-search :search="$search" />

    <div class="wrapper" id="Content">
        {{-- საწყისი ცარდები --}}
        @include('partials.manga-list', ['manga' => $manga])
    </div>

    {{ $manga->links() }}

</main>

<script>
    $('#search').on('keyup', function() {
        let value = $(this).val();

        $.ajax({
            type: 'get',
            url: '{{ route("manga.index") }}',
            data: {'search': value},
            success: function(data) {
                $('#Content').html(data); // შეცვლის ცარდებს შედეგებით
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
