# laravel notification app ###

## Get Staring

-
```shell
composer install 
```
-
```shell
npm install
```
- create a Database and add it in .env file then run
 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
- add your stmp config
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```
- Add Pusher Notification config
```
BROADCAST_DRIVE=pusher
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1
```
- go to the app.blade.php file and add your PUSHER_APP_KEY
- run command
```shell
php artisan migrate
```
- run command
```shell
php artisan serve
```

### default admin
```
email: admin@admin.com
password: admin
```
