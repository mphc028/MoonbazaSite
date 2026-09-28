---
title: "A Markdown Field Guide"
date: "2026-09-29"
excerpt: "A quick tour of the Markdown features available in the Moonbaza devlog."
published: true
---

This is a change
This article is a small reference for writing posts on Moonbaza. Everything below is written in Markdown.

## Text and links

You can write **bold text**, *italic text*, ~~strikethrough text~~, and [links to other pages](/blog).

You can also add a horizontal rule:

---

## Images

Use an image path in the normal Markdown format. This example uses the Moonbaza logo stored in `public/images`:

![The Moonbaza logo](/images/moonbaza-logo.png)

Remote images work too, as long as the URL is publicly accessible:

![A pixel-art landscape](https://images.unsplash.com/photo-1519608487953-e999c86e7455?auto=format&fit=crop&w=1200&q=80)

## YouTube videos

HTML is enabled for trusted Markdown files, so you can embed a YouTube video directly:

<div class="video-embed">
<iframe src="https://www.youtube.com/embed/aqz-KE-bpKQ" title="Pixel-art video example" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>

Replace the video ID in the embed URL with your own YouTube video ID. For example, `https://www.youtube.com/watch?v=VIDEO_ID` becomes `https://www.youtube.com/embed/VIDEO_ID`.

## Lists and checklists

### A simple list

- Design a new enemy
- Add its movement pattern
- Tune the bullet timing

### A task list

- [x] Create the player ship
- [x] Add the first wave
- [ ] Add a boss encounter

## Quotes

> Every run tells a different story. The void is just the page where it happens.

## Code

Inline code looks like `php artisan test`.

For longer examples, use a fenced code block:

```php
final class EnemyWave
{
    public function spawn(int $count): void
    {
        // Spawn enemies around the edge of the arena.
    }
}
```

## Tables

| Enemy | Speed | Threat |
| --- | ---: | --- |
| Drone | 3 | Low |
| Comet | 6 | Medium |
| Void Knight | 2 | High |

## Writing tip

Keep paragraphs short, use headings to divide ideas, and add images when they help explain the story. Markdown keeps the source readable while the website handles the presentation.