# Laravel Passport & Vue - authentication #

This is the working sample of the integration of the Laravel Passport and the usage of the JWT for your API.
Hope you will find some useful info for your needs!

### Versions: ###
* Laravel v.5.7
* Laravel Passport v.7.0
* Vue v.2.5.22
* Vuex v.3.0.1

### Installation: ###

After the git clone, run this commands one after one to start the application:
##### * composer install
##### * npm install
##### * php artisan key:generate
##### * set up your database user & password in the .env file
##### * create the mysql database by and set the name to .env file
##### * php artisan migrate
##### * php artisan passport:install
##### * copy the new generated passport-client secret from console or from your database and paste in in your .env key PASSPORT_CLIENT_SECRET
##### * php artisan optimize
##### * php artisan serve --host=0.0.0.0

Enjoy!

### Prepare the correct config before testing: ###

Need to make some small preparation to run the correct .env file and run:
##### * php artisan config:cache --env=testing 
or
##### * php artisan config:clear

### Run all unit tests from test folder:
##### * vendor/bin/phpunit --verbose -c phpunit.xml

