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
	@echo "server\t\t"

clear: _remove-cache-files
config: _create-config
database: _create-database _run-migrations
reset: _drop-database database
deb: _debian-package
dummy-config: _create-dummy-config
install: _composer-install perms
migrations: _run-migrations
perms: _cache-perms _logs-perms
test: _run-phpunit _run-phpspec _run-npm_test
translation: _extract-translation-for-locale
update: _composer-self-update _composer-update perms
server: database _run-server

_composer-self-update:
	php bin/composer self-update

_composer-update:
	php bin/composer update

_composer-install:
	php bin/composer install

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

_logs-perms:
	mkdir -p app/logs
	chmod -R 777 app/logs

_cache-perms:
	mkdir -p app/cache
	chmod -R 777 app/cache

_create-config:
	cp -v app/config/parameters.yml.dist app/config/parameters.yml
	cp -v app/config/parameters.sh.dist app/config/parameters.sh
	cp -v app/config/parameters.fish.dist app/config/parameters.fish

_create-dummy-config:
	cp -v app/config/parameters.yml.dummy app/config/parameters.yml

_debian-package:
	fpm -s dir -t deb -n queroservoluntario --prefix /var/www/queroservoluntario .

_extract-translation-for-locale:
	php app/console translation:extract en --output-dir=app/Resources/translations/  --enable-extractor=jms_i18n_routing -d src

_drop-database:
	php app/console doctrine:database:drop --force

_create-database:
	php app/console doctrine:database:create --if-not-exists

_run-migrations:
	php app/console doctrine:migrations:migrate --no-interaction

_run-server:
	php app/console server:run --env=prod 0:8000

_debug:
	@echo SYMFONY__DATABASE__DRIVER=${SYMFONY__DATABASE__DRIVER}
	@echo SYMFONY__DATABASE__HOST=${SYMFONY__DATABASE__HOST}
	@echo SYMFONY__DATABASE__USER=${SYMFONY__DATABASE__USER}
	@echo SYMFONY__DATABASE__PORT=${SYMFONY__DATABASE__PORT}
	@echo SYMFONY__DATABASE__NAME=${SYMFONY__DATABASE__NAME}
	@echo SYMFONY__DATABASE__PASSWORD=${SYMFONY__DATABASE__PASSWORD}
	@echo SYMFONY__MAILER__TRANSPORT=${SYMFONY__MAILER__TRANSPORT}
	@echo SYMFONY__MAILER__HOST=${SYMFONY__MAILER__HOST}
	@echo SYMFONY__MAILER__PORT=${SYMFONY__MAILER__PORT}
	@echo SYMFONY__MAILER__USER=${SYMFONY__MAILER__USER}
	@echo SYMFONY__MAILER__PASSWORD=${SYMFONY__MAILER__PASSWORD}
	@echo SYMFONY__MAILER__AUTH__MODE=${SYMFONY__MAILER__AUTH__MODE}
	@echo SYMFONY__MAILER__ENCRYPTION=${SYMFONY__MAILER__ENCRYPTION}
	@echo SYMFONY__FRAMEWORK__LOCALE=${SYMFONY__FRAMEWORK__LOCALE}
	@echo SYMFONY__FRAMEWORK__SECRET=${SYMFONY__FRAMEWORK__SECRET}
	@echo SYMFONY__APONTADOR__API__BASEURL=${SYMFONY__APONTADOR__API__BASEURL}
	@echo SYMFONY__APONTADOR__API__ACCESSTOKEN=${SYMFONY__APONTADOR__API__ACCESSTOKEN}
	@echo SYMFONY__CONTACT__EMAIL=${SYMFONY__CONTACT__EMAIL}
