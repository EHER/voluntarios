default:
	@echo "install\t\tPrepara para rodar o projeto pela primera vez"
	@echo "depends\t\tInstala as dependências do projeto"
	@echo "perms\t\tAjusta as permisões dos arquivos"

install: vendors-install build-bootstrap perms

update: vendors-update build-bootstrap perms

vendors-install:
	@echo "Instalando vendors..."
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
	@chmod 755 app/logs
	@chmod 755 app/cache
	@echo "Feito!"

