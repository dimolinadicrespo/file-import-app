# Files Import
## Get started
### How to

- Insert project into empty folder / git clone https://github.com/dimolinadicrespo/file-import-app.git
- Create an empty database
- Copy or rename the .env.example file

```
cp .env.example .env
```

- Change the .env vars with your database config

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=your_port
DB_DATABASE=your_databas_name
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

- Check de queue config in your .env file, must be set to 'database'

```

QUEUE_CONNECTION=database

```


- Run the following commands

```
composer install
php artisan migrate --seed
npm install && npm run prod
php artisan key:generate
php artisan serve

```


- It is necessary to run the following command, as the processing and insertion of data is done through queues

```
php artisan queue:work

```

- Login with

```
username: admin@admin.es
password: 12345678

```

### Important Notes

- In this version of laravel something strange happens with json pagination.
- In the class 
```
    vendor/laravel/framework/src/Illuminate/Http/Resources/Json/PaginatedResourceResponse.php

```
- For the correct functioning of the table listing you have to replace line 29
    
```    
    return is_array($item) ? Arr::get($item, 'resource') : $item->resource;
```    
 by 
```    
    return is_array($item) ? Arr::get($item, 'resource') : $item;
```
