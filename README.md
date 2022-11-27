

php artisan ui bootstrap --auth
npm install
npm run build
composer require laravel/cashier
php artisan vendor:publish --tag="cashier-migrations"
php artisan migrate:refresh
php artisan db:seed


php artisan optimize

php artisan serve