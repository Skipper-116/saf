#!/bin/bash

# Run migrations
php artisan migrate

# Seed the database
php artisan db:seed

# install npm
npm install

# Start Laravel project
php artisan serve &

# Start npm run dev
npm run dev