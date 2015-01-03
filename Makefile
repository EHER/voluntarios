default:
	@echo "install\t\t"
	@echo "update\t\t"
	@echo "test\t\t"
	@echo "translation\t\t"
	@echo "clear\t\t"
	@echo "perms\t\t"
	@echo "config\t\t"
	@echo "dummy-config\t\t"
	@echo "deb\t\t"
	@echo "database\t\t"
	@echo "migrations\t\t"

clear: _remove-cache-files
config: _create-config
database: _create-database _load-fixtures
deb: _debian-package
dummy-config: _create-dummy-config
fixtures: _load-fixtures
install: _composer-install perms
migrations: _run-migrations
perms: _cache-perms _logs-perms
test: _run-phpunit _run-phpspec _run-npm_test
translation: _extract-translation-for-locale
update: _composer-self-update _composer-update perms

_composer-self-update:
	php composer.phar self-update

_composer-update:
	php composer.phar update

_composer-install:
	php composer.phar install

_run-phpunit:
	phpunit -c app --testdox

_run-phpspec:
	phpspec run --format=pretty

_run-npm_test:
	npm test

_symfony-clear:
	php app/console cache:clear --env=dev
	php app/console cache:clear --env=prod --no-debug

_remove-cache-files:
	rm -rf app/cache/*

_logs-perms:
	mkdir -p app/logs
	chmod -R 777 app/logs

_cache-perms:
	mkdir -p app/cache
	chmod -R 777 app/cache

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

_create-database:
	php app/console doctrine:database:create

_run-migrations:
	php app/console doctrine:migrations:migrate --no-interaction

_load-fixtures:
	php app/console h4cc:load:sets
