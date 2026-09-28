<x-layouts.app :title="$page->title" :description="$page->description">
    <div class="container-page">
        <article class="mx-auto max-w-3xl py-16">
            <h1 class="font-display text-3xl font-bold sm:text-5xl">{{ $page->title }}</h1>
            <div class="markdown mt-8">{!! \App\Content::markdown($page->body) !!}</div>
        </article>
    </div>
</x-layouts.app>
