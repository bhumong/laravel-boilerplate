# Installation and Setup for dev
## Requirements
Docker : OS supported Docker with linux container.

## Setup

 1. Start Docker
 2. clone repository
 3. Setup .env from .env.example
 4. Run this command on directory
	
> docker run  --rm  \
> -u "$(id -u):$(id -g)"  \
> -v "$(pwd):/var/www/html"  \
> -w /var/www/html  \
> laravelsail/php81-composer:latest \
> composer install  --ignore-platform-reqs
5. run `./vendor/bin/sail composer install`
6. run `./vendor/bin/sail npm install`
7. run `./vendor/bin/sail artisan migrate:fresh`

## Running app in docker

 - run `./vendor/bin sail up -d`
 - run `./vendor/bin sail npm run dev`
