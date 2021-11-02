# Webdo

Webdo API based website/eshop manage system

### Install

##### 1. clone repo
 ```sh
git 
```
##### 2. composer install
```sh
composer install
```
##### 3. run migrations
```sh
php artisan migrate
```
##### 4. make symlink
alternative for `php artisan storage:link`
```sh
cd public
ln -s ../storage/app/public storage
```

### Options
| name | description | value |
| ------ | ------ | ------ |
| app_name | Name shown in dashboard | string |
| module_articles | Show articles in navbar | true/false |
| module_pages | Show pages in navbar | true/false |
| module_events | Show events in navbar | true/false |
| module_eshop | Show eshop section | true/false |
| %TERM% | Set name of term group (need to use term in group column) | string |
