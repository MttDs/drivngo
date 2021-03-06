Drivngo
=======

A Symfony project created on April 2, 2016, 9:18 am.

## Initialization

set your database access in app/config/parameters.yml. Create the file from app/config/parameters.yml.dist if necessary

```sh
- create the Drivngo database (with phpmyadmin for example)
$ composer install 
$ php app/console doctrine:schema:update --dump-sql
$ php app/console doctrine:schema:update --force
$ php app/console doctrine:fixtures:load
```

## Accounts

- login: admin, password: soleil
- login: moniteur, password: soleil
- login: manager, password: soleil
- login: secretaire, password: soleil
- login: user, password: soleil

## Pages

### Front

* /
* /auto-ecoles
* /auto-ecoles/{id}
* /nos-partenaires
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
* (manager) /dashboard/schools/{id}/employees
* (manager) /dashboard/schools/{id}/employees/new
* (manager) /dashboard/schools/{id}/employees/{id}/edit
* POST | (manager) /dashboard/schools/{id}/employees/{id}/update
* POST | (manager) /dashboard/schools/{id}/employees/create
* DELETE | (manager) /dashboard/schools/{id}/employees/{id}/destroy
* POST | (manager / secretary) /dashboard/schools/{id}/students
* (user / instructor) /dashboard/schools/{id}/reports
* (user / instructor) /dashboard/schools/{id}/reports/{user_id}/new
* (user / instructor) /dashboard/schools/{id}/reports/show
* (super admin) /dashboard/schools/{id}/ads
* (student + elearning & active = true) /dashboard/elearning
* (secretary, manager) /dashboard/schools/{id}/vehicles
* (secretary, manager) /dashboard/schools/{id}/vehicles/new
* (secretary, manager) /dashboard/schools/{id}/vehicles/{id}/edit
* POST | (secretary, manager) /dashboard/schools/{id}/vehicles/{id}/update

### Bundle 

* all the FosUserBundle routes (/login, /register, ...)

## Fixtures

* Users 
* Schools
* PricingCategories
* Pricings
* Students
* Employees
* AdType
* Reports
* Vehicle

## Admin design

http://startbootstrap.com/template-overviews/sb-admin/

## Bug ?

Send an issue => https://github.com/MttDs/drivngo/issues
