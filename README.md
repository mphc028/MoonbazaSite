# Moonbaza website

Laravel 13 · Blade · Tailwind 4 · Vite · Docker Compose. File-based, no database.

## Setup (only Docker + Git needed)

    ./setup.sh

Then open http://localhost:8000. Afterwards: `docker compose up -d` / `docker compose down`.

Run artisan/composer/tests via the container, e.g. `docker compose exec app php artisan test`.
Linux users whose UID isn't 1000: `export HOST_UID=$(id -u) HOST_GID=$(id -g)` first.

## Where things live

- `config/moonbaza.php` — site name, tagline, navigation, header CTA
- `resources/css/app.css` — design tokens (colors, fonts, buttons, cards)
- `resources/views/components/layouts/app.blade.php` — site layout
