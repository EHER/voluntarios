default:
	@echo "install\t\t"
	@echo "update\t\t"
	@echo "clear\t\t"
	@echo "perms\t\t"
	@echo "config\t\t"
	@echo "deb\t\t"

install: _bower-install _composer-install perms
update: _bower-update _composer-self-update _composer-update perms
clear: _symfony-clear
perms: _cache-perms _logs-perms
config: _create-config
deb: _debian-package

_bower-install:
	bower install

_bower-update:
	bower update

_composer-self-update:
	php composer.phar self-update

_composer-update:
	php composer.phar update

_composer-install:
	php composer.phar install

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
	dpkg-buildpackage -rfakeroot

