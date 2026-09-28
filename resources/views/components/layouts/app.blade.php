@props(['title' => null, 'description' => null, 'image' => null])
@php
    $fullTitle = ($title ? $title.' · ' : '').config('moonbaza.name');
    $desc = $description ?: config('moonbaza.tagline');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $desc }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ config('moonbaza.name') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($image)
        <meta property="og:image" content="{{ url($image) }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
    <header class="border-b border-line">
        <div class="container-page flex h-16 items-center justify-between gap-6">
            <a href="/" aria-label="{{ config('moonbaza.name') }}">
                <img
                    src="{{ asset('images/moonbaza-logo.png') }}"
                    alt="{{ config('moonbaza.name') }}"
                    class="mt-1 h-8 w-auto"
                >
            </a>

            <nav class="hidden md:flex items-center gap-6 text-sm text-muted" aria-label="Main">
                @foreach (config('moonbaza.nav') as $item)
                    <a href="{{ $item['url'] }}" class="hover:text-ink {{ request()->is(ltrim($item['url'], '/') ?: '/') ? 'text-ink' : '' }}">{{ $item['label'] }}</a>
                @endforeach
            </nav>

            <a href="{{ config('moonbaza.cta.url') }}" class="text-accent hover:text-ink hidden md:inline-flex">{{ config('moonbaza.cta.label') }}</a>

            <details class="md:hidden relative">
                <summary class="btn-ghost cursor-pointer list-none">Menu</summary>
                <div class="absolute right-0 mt-2 w-56 card flex flex-col gap-3 text-sm">
                    @foreach (config('moonbaza.nav') as $item)
                        <a href="{{ $item['url'] }}" class="text-muted hover:text-ink">{{ $item['label'] }}</a>
                    @endforeach
                    <a href="{{ config('moonbaza.cta.url') }}" class="text-accent hover:text-ink">{{ config('moonbaza.cta.label') }}</a>
                </div>
            </details>
        </div>
    </header>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <footer class="border-t border-line py-8 text-sm text-muted">
        <div class="container-page">
            {{ date('Y') }} {{ config('moonbaza.name') }}
        </div>
    </footer>
</body>
</html>
