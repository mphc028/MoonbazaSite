<x-layouts.app :title="$post->title" :description="$post->excerpt" :image="$post->cover">
    <div class="container-page">
        <article class="mx-auto max-w-3xl py-16">
            <a href="{{ route('blog.index') }}" class="text-sm text-muted hover:text-ink">← Devlog</a>
            <h1 class="mt-4 font-display text-3xl font-bold sm:text-5xl">{{ $post->title }}</h1>
            <time datetime="{{ $post->date->toDateString() }}" class="mt-3 block text-sm text-muted">{{ $post->date->translatedFormat('j F Y') }}</time>

            @if ($post->cover)
                <img src="{{ $post->cover }}" alt="" class="mt-8 w-full rounded-card">
            @endif

            <div class="markdown mt-8">{!! \App\Content::markdown($post->body) !!}</div>
        </article>
    </div>
</x-layouts.app>
