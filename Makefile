default: help

build: clear _docker-build-image
clear: _remove-cache-files _remove-log-files
config: _create-config
database: _run-migrations
deb: _debian-package
deploy: _docker-update-containers
dummy-config: _create-dummy-config
help: _display-avaiable-commands
install: _composer-install perms
logs: _tail-logs
migrations: _run-migrations
perms: _app-perms _logs-perms _cache-perms _database-perms
reset: _drop-database database
server: _debug database _run-server
test: _run-phpunit _run-phpspec _run-npm_test
translation: _extract-translation-for-locale
update: _composer-self-update _composer-update perms

_docker-build-image: clear
	docker-compose build

_docker-update-containers:
	docker-compose stop nginx
	docker-compose stop nginxdebug
	docker-compose stop php code
	docker-compose rm --force php code nginx nginxdebug
	docker-compose up -d php code
	docker-compose up -d nginxdebug
	docker-compose up -d nginx
	docker-compose up -d

_display-avaiable-commands:
	@echo "Usage:"
	@echo "     make [command]"
	@echo ""
	@echo "Available commands:"
	@grep -v '^_' Makefile | grep '^[^#[:space:]].*:' | grep -v '^default' | sed 's/:\(.*\)//' | xargs -n 1 echo ' -'
	@echo ""

_composer-self-update:
	php bin/composer self-update

_composer-update:
	php bin/composer update

_composer-install:
	php bin/composer install -o

_run-phpunit:
	bin/phpunit --testdox

_run-phpspec:
	bin/phpspec run --format=pretty

_run-npm_test:
	npm test

_symfony-clear:
	php app/console cache:clear --env=dev
	php app/console cache:clear --env=prod --no-debug

_remove-cache-files:
	rm -rf app/cache/*

_remove-log-files:
	rm -rf app/logs/*

_app-perms:
	mkdir -p app
	chmod -R 777 app

_logs-perms:
	mkdir -p app/logs
	chmod -R 777 app/logs

_cache-perms:
	mkdir -p app/cache
	chmod -R 777 app/cache

_database-perms:
	mkdir -p database
	touch database/sqlite.db
	chmod -R 777 database

_create-config:
	cp -v app/config/parameters.yml.dist app/config/parameters.yml

_create-dummy-config:
	cp -v app/config/parameters.yml.dummy app/config/parameters.yml

_debian-package:
	fpm -s dir -t deb -n queroservoluntario --prefix /var/www/queroservoluntario .

_extract-translation-for-locale:
	php app/console translation:extract en --output-dir=app/Resources/translations/  --enable-extractor=jms_i18n_routing -d src

_drop-database:
	php app/console doctrine:database:drop --force

_run-migrations:
	php app/console doctrine:migrations:migrate --no-interaction

_run-server:
	php app/console server:run --env=prod 0:8000

_tail-logs:
	tail -f app/logs/*
