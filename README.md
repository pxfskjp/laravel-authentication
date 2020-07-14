# Laravel Passport & Vue - authentication #

This is the working sample of the integration of the Laravel Passport and the usage of the JWT for your API.
Hope you will find some useful info for your needs!

### Versions: ###
* Laravel v.7.0
* Laravel Passport v.9.3
* Vue v.2.6.11
* Vuex v.3.5.1

### Manual Installation: ###

After the git clone, run this commands & editions one after one to start the application:
##### * composer install
##### * npm install
##### * php artisan key:generate
##### * set up your database user & password in the .env file
##### * create the mysql database and set the name to .env file
##### * php artisan migrate
##### * php artisan passport:install
##### * copy the new generated passport-client secret from console or from your database and paste in in your .env key PASSPORT_CLIENT_SECRET
##### * php artisan optimize
##### * php artisan serve --host=0.0.0.0
##### * npm run watch

Enjoy!

### Prepare the correct config before testing: ###

Need to make some small preparation to run the correct .env file and run:
##### * php artisan config:cache --env=testing 
or
##### * php artisan config:clear

### Run all unit tests from test folder:
##### * vendor/bin/phpunit --verbose -c phpunit.xml

