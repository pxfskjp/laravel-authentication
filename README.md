# Laravel Vue authentication #

### Versions: ###
* Laravel v.7.0
* Laravel Passport v.9.3
* Vue v.2.6.11
* Vuex v.3.5.1

### Manual Installation: ###
* composer install
* npm install
* php artisan key:generate
* set up your database user & password in the .env file (copy the structure from the .env.example file)
* create the mysql database and set the name to .env file
* php artisan migrate
* php artisan passport:install
* copy the new generated passport-client secret from console or from your database and paste it in your .env key PASSPORT_CLIENT_SECRET
* php artisan optimize
* php artisan serve --host=0.0.0.0
* npm run watch

