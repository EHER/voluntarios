default:
	@echo "install\t\tFaz a instalação dos vendors pelo Composer"
	@echo "reinstall\t\tForça a reinstalação dos vendors (apagando /vendors)"
	@echo "update\t\tFaz a atualização dos vendors pelo Composer"
	@echo "perms\t\tAjusta as permisões dos arquivos"

install: vendors-install build-bootstrap perms

reinstall: vendors-reinstall build-bootstrap perms

update: vendors-update build-bootstrap perms

vendors-install:
	@echo "Instalando vendors..."
	bin/vendors install
	@echo "Feito!"

vendors-reinstall:
	@echo "Forçando a instalação dos vendors..."
	@rm -rf vendor composer.lock
	bin/vendors install
	@echo "Feito!"

vendors-update:
	@echo "Atualizando vendors..."
	bin/vendors update
	@echo "Feito!"

build-bootstrap:
	@echo "Fazendo build do bootstrap..."
	bin/build_bootstrap
	@echo "Feito!"

perms:
	@echo "Ajustando permissões..."
	@mkdir -p app/logs
	@mkdir -p app/cache
	@chmod -R 777 app/logs
	@chmod -R 777 app/cache
	@echo "Feito!"

