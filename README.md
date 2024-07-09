# Short Url - RPHE

## Table of Contents

- [Overview](#overview)
- [Built With](#built-with)
- [Installation](#installation)
- [Running the project](#running-the-project)

## Overview

This project is a simple web application that allows users to create short URLs and see visits statistics.

### Built With

- Laravel
- Livewire + Volt
- Tailwind
- Alpine.js
- Pest

## Installation

`git clone https://github.com/raphaelheying/shorturl.git` => clone this repository

`cd shorturl` => change directory to the cloned repository

`cp .env.example .env` => copy the .env.example file to .env

`composer install` => install the php dependencies

`npm install` => install the js dependencies

`php artisan migrate` => run the migrations

`php artisan db:seed` => if you want to seed the database with some data, this will create some links and visits for user `raphael.h@hotmail.com` : `password`

### Running the project

`php artisan serve` => start the local php server

`npm run dev` => start the local js server

Access the project at http://localhost:8000
