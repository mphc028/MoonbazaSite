#!/bin/sh
# One-time bootstrap: scaffolds Laravel 13 around the files in this folder.
set -e
export HOST_UID=$(id -u) HOST_GID=$(id -g)
docker compose build app
# Scaffold inside the mounted folder so the result is written straight to the host
rm -rf .lv
docker compose run --rm --no-deps app composer create-project laravel/laravel:^13.0 .lv --no-interaction --prefer-dist
[ -f .lv/artisan ] || { echo "Scaffold failed: .lv/artisan missing"; exit 1; }
# Merge without overwriting our own files (routes, css, layout, config...)
cp -rn .lv/. .
rm -rf .lv
[ -f .env ] || cp .env.example .env
# File-based: no database needed
sed -i -E 's/^DB_.*//; s/^SESSION_DRIVER=.*/SESSION_DRIVER=file/; s/^CACHE_STORE=.*/CACHE_STORE=file/; s/^QUEUE_CONNECTION=.*/QUEUE_CONNECTION=sync/; s/^APP_NAME=.*/APP_NAME=Moonbaza/' .env .env.example
docker compose run --rm --no-deps app php artisan key:generate
docker compose up -d
echo "Ready: http://localhost:8000"