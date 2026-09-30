#!/bin/sh
set -eu

cd /var/www/html

mkdir -p \
    bootstrap/cache \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs

chown -R www-data:www-data bootstrap/cache storage
php artisan storage:link --force

attempt=0
until php -r '
    try {
        $host = getenv("DB_HOST");
        $port = getenv("DB_PORT") ?: "3306";
        $database = getenv("DB_DATABASE");
        $username = getenv("DB_USERNAME");
        $password = getenv("DB_PASSWORD");
        new PDO("mysql:host={$host};port={$port};dbname={$database}", $username, $password, [PDO::ATTR_TIMEOUT => 2]);
    } catch (Throwable $exception) {
        exit(1);
    }
' >/dev/null 2>&1; do
    attempt=$((attempt + 1))
    if [ "$attempt" -ge 60 ]; then
        echo "MySQL did not become available in time." >&2
        exit 1
    fi
    sleep 2
done

php artisan migrate --force

exec "$@"