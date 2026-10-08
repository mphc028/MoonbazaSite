<x-layouts.app :description="$page->description">
    <section class="home-hero" style="--hero-wallpaper: url('{{ asset('images/wallpaper.png') }}')">
        <div class="home-hero__content">
            <div class="home-logo-wave" role="img" aria-label="Moonbaza">
                @foreach (range(1, 8) as $segment)
                    <img src="{{ asset(sprintf('images/%02d.png', $segment)) }}" alt="" aria-hidden="true">
                @endforeach
            </div>
            @if ($page->tagline)
                <p class="home-hero__tagline">{{ $page->tagline }}</p>
            @endif
            <div class="home-hero__actions">
                <a href="{{ config('moonbaza.cta.url') }}" class="btn-primary wishlist-button">{{ config('moonbaza.cta.label') }}</a>
                <a href="{{ route('blog.index') }}" class="btn-ghost">Devlog</a>
            </div>
        </div>
    </section>

    @if ($page->body)
        <section class="container-page pt-12 pb-16">
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
