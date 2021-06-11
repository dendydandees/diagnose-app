<p align="center"><a href="https://github.com/dendydandees/diagnose-app" target="_blank"><img src="https://tailwindui.com/img/logos/workflow-mark-purple-600.svg" width="100"></a></p>

## Starting

```
## instalation on local
composer install
! -- generate the key
php artisan key:generate


## start mysql server
sudo service mysql start
mysql -u <username> -p

!-- use your own database account,
!-- edit the env file if the db_username and db_pasword not the same,
!-- and then create a database like env file

## before run server do migrating and seeding
php artisan migrate
php artisan db:seed
php artisan db:seed --class=SymptomSeeder
php artisan db:seed --class=DiseaseSeeder

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
