<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Starting

```
## instalation on local
composer install

## start mysql server
sudo service mysql start
mysql -u <username> -p

!-- use your own database account,
!-- edit the env file if the db_username and db_pasword not the same,
!-- and then create a database like env file

## before run server do migrating and seeding
php artisan migrate
php artisan db:seed

## development start
php artisan serve
```

## Starting Using Sail

```
## development start
sail up

## start mysql server
sail mysql -u <username> -p

## tinker
sail php artisan tinker

## artisan
sail php artisan

## development stop
sail down
```
