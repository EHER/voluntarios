default:
	@echo "install\t\t"
	@echo "update\t\t"
	@echo "test\t\t"
	@echo "translation\t\t"
	@echo "clear\t\t"
	@echo "perms\t\t"
	@echo "config\t\t"
	@echo "deb\t\t"
	@echo "migrations\t\t"
	@echo "fixtures\t\t"
	@echo "setup_db\t\t"

install: _composer-install perms
update: _composer-self-update _composer-update perms
test: _run-phpunit _run-phpspec _run-npm_test
translation: _extract-translation-for-locale
clear: _remove-cache-files
perms: _cache-perms _logs-perms
config: _create-config
dummy-config: _create-dummy-config
deb: _debian-package
migrations: _run-migrations
fixtures: _load-fixtures
setup_db: _drop-database _create-database migrations fixtures

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
