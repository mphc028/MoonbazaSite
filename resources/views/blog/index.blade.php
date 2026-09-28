<x-layouts.app title="Devlog" description="News and development updates from Moonbaza.">
    <div class="container-page py-16">
        <h1 class="font-display text-3xl font-bold sm:text-5xl">Devlog</h1>

        @if ($posts->isEmpty())
            <p class="mt-8 text-muted">No posts yet.</p>
        @else
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
