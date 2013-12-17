default:
	@echo "install\t\t"
	@echo "update\t\t"
	@echo "test\t\t"
	@echo "clear\t\t"
	@echo "perms\t\t"
	@echo "config\t\t"
	@echo "deb\t\t"

install: _composer-install perms
update: _composer-self-update _composer-update perms
test: _run_phpspec
clear: _symfony-clear
perms: _cache-perms _logs-perms
config: _create-config
deb: _debian-package

_composer-self-update:
	php composer.phar self-update

_composer-update:
	php composer.phar update

_composer-install:
	php composer.phar install

_run_phpspec:
	vendor/bin/phpspec run --format=pretty

_symfony-clear:
	php app/console cache:clear --env=dev
	php app/console cache:clear --env=prod --no-debug

_logs-perms:
	mkdir -p app/logs
	chmod -R 777 app/logs

_cache-perms:
	mkdir -p app/cache
	chmod -R 777 app/cache

_create-config:
	cp -v app/config/parameters.yml.dist app/config/parameters.yml

_debian-package:
	fpm -s dir -t deb -n queroservoluntario .

