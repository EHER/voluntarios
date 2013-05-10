default:
	@echo "install\t\tFaz a instalação dos vendors pelo Composer"
	@echo "reinstall\tForça a reinstalação dos vendors (apagando /vendors)"
	@echo "update\t\tFaz a atualização dos vendors pelo Composer"
	@echo "clear\t\tLimpa o cache"
	@echo "perms\t\tAjusta as permisões dos arquivos"
	@echo "config\t\tCria configurações"

install: vendors-install perms

update: composer-update vendors-update perms

composer-update:
	php composer.phar self-update

vendors-install:
	php composer.phar install --no-scripts

vendors-update:
	php composer.phar update

clear:
	php app/console cache:clear --env=dev
	php app/console cache:clear --env=prod --no-debug

perms:
	mkdir -p app/logs
	mkdir -p app/cache
	chmod -R 777 app/logs
	chmod -R 777 app/cache

config:
	cp -n app/config/parameters.yml.dist app/config/parameters.yml

deb:
	dpkg-buildpackage -rfakeroot
