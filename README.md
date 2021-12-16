## Requirements

-   php 7.4 upwards
-   MySQL Database
-   Composer

## Topics covered
-  VueJs 3 (Router, Form Validation, Templates, REST API, Basic Pagination)
-  Larvel/PHP (OOP, MVC, Email Queue)

## Installation instructions

-   clone the project to your local machine
-   Using terminal/CMD tool navigate to the root dir of the project and then run "composer install" & "npm install" & "npm run dev" or "npm run watch"
-   create a new MySQL Database
-   edit the .env file, replace DB_DATABASE , DB_USERNAME, DB_PASSWORD with you own DB Details and set QUEUE_CONNECTION to "database"
-   i used mailtrap.io to test the emails, please replace MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION with your own email
    server credentials, mailtrap is highly recommended
-   Run migrations by opening the terminal/ command prompt tool and then navigate to the root DIR of the project and then run "php artisan migrate"
-   Now you can run the project by typing "php artisan serve" on your terminal or if you're on a UNIX based OS you can set up a vhost for it.
-   im using Laravel Jobs to send emails, to set this up, run "php artisan queue:work" 
-   NB, make sure the "queue" is running before you add any entry

## Tech Stack Used

-   VueJs 3
-   Laravel 8
-   Bootstrap 5
-   MVC Design patten
