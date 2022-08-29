.PHONY: install up down test copy-files composer-install bash migrate seed

include .env

DC := docker-compose exec php bash -c

setup: copy-files build composer-install up migrate seed publish

install: up migrate seed

up:
	docker-compose up -d --force-recreate

down:
	docker-compose down --remove-orphans

build:
	docker-compose build

test:
	docker-compose run php vendor/bin/phpunit

copy-files:
	if [ ! -f .env ]; then cp .env.example .env; fi

composer-install:
	docker-compose run php composer install

bash:
	docker-compose run php bash

migrateclean:
	${DC} "php artisan key:generate && php artisan optimize && php artisan cache:clear && php artisan route:clear && php artisan config:clear && php artisan view:clear"

migrate:
	${DC} "php artisan migrate"

seed:
	${DC} "php artisan db:seed"

cc:
	${DC} "php artisan optimize && php artisan config:clear && php artisan cache:clear"

publish:
	${DC} "php artisan vendor:publish --provider='KeycloakGuard\KeycloakGuardServiceProvider'"

run:
	${DC} "$(php)"

people:
	${DC} "php artisan vodafone:people"

planet:
	${DC} "php artisan vodafone:planet"

test:
	${DC} "php vendor/bin/phpunit"




