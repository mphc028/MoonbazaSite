<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ContentTest extends TestCase
{
    private string $dir;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();

        $this->dir = sys_get_temp_dir().'/moonbaza-test-'.uniqid();
        File::makeDirectory($this->dir.'/pages', 0755, true);
        File::makeDirectory($this->dir.'/blog', 0755, true);
        config(['moonbaza.content_path' => $this->dir]);

        $this->write('pages/home.md', "---\ntitle: Moonbaza\ntagline: Test tagline\n---\nHome body");
        $this->write('pages/game.md', "---\ntitle: The Game\n---\nGame body <script>alert('x')</script>");
        $this->write('blog/2026-09-28-hello.md', "---\ntitle: Hello World\ndate: \"2026-09-28\"\nexcerpt: \"Hello excerpt\"\npublished: true\n---\nPost body");
        $this->write('blog/2026-09-29-secret.md', "---\ntitle: Secret Draft\ndate: \"2026-09-29\"\npublished: false\n---\nDraft body");
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->dir);
        parent::tearDown();
    }

    private function write(string $path, string $contents): void
    {
        file_put_contents($this->dir.'/'.$path, $contents);
    }

    public function test_homepage_loads_with_latest_published_posts(): void
    {
        $this->get('/')->assertOk()->assertSee('Test tagline')->assertSee('Hello World')->assertDontSee('Secret Draft');
    }

    public function test_static_page_loads_and_strips_raw_html(): void
    {
        $this->get('/game')->assertOk()->assertSee('Game body')->assertDontSee('<script>', false);
    }

    public function test_unknown_page_and_home_slug_return_404(): void
    {
        $this->get('/nope')->assertNotFound();
        $this->get('/home')->assertNotFound();
    }

    public function test_blog_listing_shows_only_published_posts(): void
    {
        $this->get('/blog')->assertOk()->assertSee('Hello World')->assertDontSee('Secret Draft');
    }

    public function test_published_post_loads(): void
    {
        $this->get('/blog/hello')->assertOk()->assertSee('Post body');
    }

    public function test_unpublished_post_is_not_public(): void
    {
        $this->get('/blog/secret')->assertNotFound();
    }
}
