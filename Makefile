default:
	@echo "install\t\tFaz a instalação dos vendors pelo Composer"
	@echo "reinstall\tForça a reinstalação dos vendors (apagando /vendors)"
	@echo "update\t\tFaz a atualização dos vendors pelo Composer"
	@echo "clear\t\tLimpa o cache"
	@echo "perms\t\tAjusta as permisões dos arquivos"
	@echo "config\t\tCria configurações"

install: get-composer vendors-install perms

update: get-composer composer-update vendors-update perms

get-composer:
	wget -nc http://getcomposer.org/composer.phar

composer-update:
	php composer.phar self-update

vendors-install:
	php composer.phar install

vendors-update:
	php composer.phar update

clear:
	app/console cache:clear --env=dev
	app/console cache:clear --env=prod --no-debug

perms:
	mkdir -p app/logs
	mkdir -p app/cache
	chmod -R 777 app/logs
	chmod -R 777 app/cache

config:
	cp -n app/config/parameters.yml.dist app/config/parameters.yml


