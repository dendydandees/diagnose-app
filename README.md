<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Starting

```
## instalation on local
composer install

## start mysql server
sudo service mysql start
mysql -u <username> -p

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
