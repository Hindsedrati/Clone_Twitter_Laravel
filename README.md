# Projet_Laravel - Twitter Clone

Twitter clone app made with Laravel, Tailwind CSS and Alpine JS, WebSocket and Laravel Echo.

## Instrallation

1. Clone this repository
2. Open project with your code editor
3. Change `.env.example` file name to `.env` and configure it
4. Install all your dependencies by running `composer install`
5. Generate app key by running `php artisan key:generate`
6. You should create a symbolic link at `public/storage` which points to this directory. You may create the link using the `php artisan storage:link` Artisan command.
7. Migrate your database `php artisan migrate`
8. Run seeds `php artisan db:seed` if you need fake data
9. Install npm dependencies `npm install`
10. Build your assets `npm run dev`
11. Serve your application `php artisan serve`
