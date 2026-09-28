@props(['post'])
<article class="post-card overflow-hidden border border-line bg-surface">
    @if ($post->cover)
        <img src="{{ $post->cover }}" alt="" loading="lazy" class="aspect-video w-full object-cover">
    @endif
    <div class="p-6">
        <time datetime="{{ $post->date->toDateString() }}" class="text-xs text-muted">{{ $post->date->translatedFormat('j F Y') }}</time>
        <h2 class="mt-1 text-xl font-semibold">
            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-accent">{{ $post->title }}</a>
        </h2>
        <p class="mt-2 text-sm text-muted">{{ $post->excerpt }}</p>
    </div>
</article>
