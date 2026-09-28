<x-layouts.app :description="$page->description">
    <section class="container-page py-24 text-center">
        <img
            src="{{ asset('images/moonbaza-logo.png') }}"
            alt="{{ config('moonbaza.name') }}"
            class="mx-auto h-20 w-auto"
        >
        @if ($page->tagline)
            <p class="mx-auto mt-4 max-w-xl text-lg text-muted">{{ $page->tagline }}</p>
        @endif
        <div class="mt-8 flex justify-center gap-3">
            <a href="{{ config('moonbaza.cta.url') }}" class="btn-primary wishlist-button">{{ config('moonbaza.cta.label') }}</a>
            <a href="{{ route('blog.index') }}" class="btn-ghost">Devlog</a>
        </div>
    </section>

    @if ($page->body)
        <section class="container-page pb-16">
            <div class="markdown mx-auto max-w-3xl">{!! \App\Content::markdown($page->body) !!}</div>
        </section>
    @endif

    @if ($posts->isNotEmpty())
        <section class="container-page pb-24">
            <div class="mb-6 flex items-end justify-between">
                <h2 class="font-display text-2xl font-bold">Latest from the devlog</h2>
                <a href="{{ route('blog.index') }}" class="text-sm text-accent hover:underline">All posts</a>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        </section>
    @endif
</x-layouts.app>
