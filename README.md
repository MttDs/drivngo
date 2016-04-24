Drivngo
=======

A Symfony project created on April 2, 2016, 9:18 am.

## Initialization

set your database access in app/config/parameters.yml. Create the file from app/config/parameters.yml.dist if necessary

```sh
$ composer install
$ php app/console doctrine:schema:create
$ php app/console doctrine:schema:update --dump-sql
$ php app/console doctrine:schema:update --force
$ php app/console doctrine:fixtures:load
$ php app/console server:start
$ run http://127.0.0.1:8000/
```

## Pages

### Front

* /
* /auto-ecoles
* /auto-ecoles/{id}
* POST | /auto-ecoles/{id}/payment/create

### Back

* (logged) /dashboard
* (logged) /dashboard/schools/{id}
* (manager) /dashboard/schools/new
* (manager) /dashboard/schools/{id}/edit
* (manager) /dashboard/schools/{id}/update
* (manager) /dashboard/schools/{id}/destroy
* (manager) /dashboard/schools/create
* (manager) /dashboard/schools/{id}/pricings
* (manager / secretary) /dashboard/schools/{id}/students
* POST | (manager / secretary) /dashboard/schools/{id}/students

### Bundle 

* all the FosUserBundle routes (/login, /register, ...)

## Fixtures

* Users 
* Schools
* PricingCategories
* Pricings
* Students
* Employees

## Admin design

http://startbootstrap.com/template-overviews/sb-admin/

## Bug ?

Send an issue => https://github.com/MttDs/drivngo/issues
