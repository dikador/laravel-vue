# Start app

### Installing dependencies

```bash
# Install composer
composer install

# Install npm
npm install
```

### In the next step, open the .env.example file. Change the name of this file to .env and change the database settings.

### Then migrate tables to the database

```bash
php artisan migrate

# Create admin
php artisan db:seed --class=UserSeeder

# Create link store
php artisan storage:link
```

### Launch app

```bash
# Start server
php artisan serve

# follow vue changes
npm run watch
```

### P.S The vue code is in the directory resources/js
