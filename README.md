# Courseo
A simple platform to sell your online courses : https://courseo.xyz/
## Steps to deploy the application
`php composer update`

`./vendor/bin/sail up`

`env DB_HOST=127.0.0.1 php artisan migrate:fresh`

`env DB_HOST=127.0.0.1 php artisan db:seed`
