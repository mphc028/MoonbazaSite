<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Reads Markdown files with YAML front matter from the content directory.
 */
class Content
{
    public static function path(string $sub = ''): string
    {
        return rtrim(config('moonbaza.content_path'), '/').($sub ? '/'.$sub : '');
    }

    /** Convert Markdown to HTML, including trusted raw HTML from content files. */
    public static function markdown(string $text): string
    {
        $iframes = [];
        $text = preg_replace_callback('/<iframe\b[^>]*>.*?<\/iframe>/is', function ($match) use (&$iframes) {
            $key = 'MOONBAZA_IFRAME_'.count($iframes);
            $iframes[$key] = $match[0];

            return $key;
        }, $text);

        $html = Str::markdown($text, ['html_input' => 'allow', 'allow_unsafe_links' => false]);

        return str_replace(array_keys($iframes), $iframes, $html);
    }

    public static function page(string $slug): ?Fluent
    {
        if (! preg_match('/^[a-z0-9-]+$/', $slug)) {
            return null;
        }

        return self::read(self::path("pages/{$slug}.md"), ['slug' => $slug]);
    }

    /** Posts sorted by date (newest first). Published only unless $includeDrafts. */
    public static function posts(bool $includeDrafts = false): Collection
    {
        return collect(glob(self::path('blog/*.md')) ?: [])
            ->map(fn ($file) => self::post($file))
            ->filter(fn ($post) => $post && ($includeDrafts || $post->published))
            ->sortByDesc(fn ($post) => $post->date->timestamp)
            ->values();
    }

    private static function post(string $file): ?Fluent
    {
        $name = basename($file, '.md');
        $slug = preg_replace('/^\d{4}-\d{2}-\d{2}-/', '', $name);

        $post = self::read($file, ['slug' => $slug, 'file' => $name]);
        if (! $post) {
            return null;
        }

        $date = $post->date ?? substr($name, 0, 10);
        try {
            $post->date = is_int($date) ? Carbon::createFromTimestampUTC($date) : Carbon::parse($date);
        } catch (\Throwable) {
            $post->date = Carbon::createFromTimestamp(filemtime($file));
        }

        $post->title = $post->title ?: Str::headline($slug);
        $post->published = (bool) $post->published;
        $post->excerpt = $post->excerpt ?: Str::limit(trim(strip_tags(self::markdown($post->body))), 160);

        return $post;
    }

    private static function read(string $path, array $extra = []): ?Fluent
    {
        if (! is_file($path)) {
            return null;
        }

        $raw = file_get_contents($path);
        $meta = [];
        $body = $raw;

        if (preg_match('/\A---\R(.*?)\R---\R?(.*)\z/s', $raw, $m)) {
            try {
                $parsed = Yaml::parse($m[1]);
                $meta = is_array($parsed) ? $parsed : [];
            } catch (ParseException) {
                $meta = [];
            }
            $body = $m[2];
        }

        return new Fluent($extra + $meta + ['body' => trim($body)]);
    }
}
