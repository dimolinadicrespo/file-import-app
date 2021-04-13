# Files Import
## Get started
### How to

- Insert project into empty folder / git clone https://github.com/dimolinadicrespo/file-import-app.git
- Create an empty database
- Rename the .env.example to .env
- Change the .env with your database config

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=8889
DB_DATABASE=files
DB_USERNAME=root
DB_PASSWORD=root

```

Run the following commands

```
composer install
php artisan migrate --seed
npm install && npm run prod
php artisan serve

```

It is necessary to run the following command, as the processing and insertion of data is done through queues

```
php artisan queue:work

```
