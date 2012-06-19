default:
	@echo "install\t\tFaz a instalação dos vendors pelo Composer"
	@echo "reinstall\tForça a reinstalação dos vendors (apagando /vendors)"
	@echo "update\t\tFaz a atualização dos vendors pelo Composer"
	@echo "perms\t\tAjusta as permisões dos arquivos"

install: vendors-install perms build-bootstrap

reinstall: remove-vendors vendors-install

update: vendors-update perms build-bootstrap

vendors-install:
	@echo "Instalando vendors"
	bin/vendors install
	@echo "Feito!"

remove-vendors:
	@echo "Removendo vendors"
	@rm -rf vendor composer.lock
	@echo "Feito!"

vendors-update:
	@echo "Atualizando vendors"
	bin/vendors update
	@echo "Feito!"

perms:
	@echo "Ajustando permissões"
	mkdir -p app/logs
	mkdir -p app/cache
	chmod -R 777 app/logs
	chmod -R 777 app/cache
	@echo "Feito!"

build-bootstrap:
	@echo "Fazendo build do bootstrap"
	cp -n app/config/parameters.ini.dist app/config/parameters.ini
	bin/build_bootstrap
	@echo "Feito!"

