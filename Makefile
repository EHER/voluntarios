default:
	@echo "install\t\tPrepara para rodar o projeto pela primera vez"
	@echo "depends\t\tInstala as dependências do projeto"
	@echo "perms\t\tAjusta as permisões dos arquivos"

install: depends perms

depends:
	wget http://getcomposer.org/composer.phar
	php composer.phar install

perms:
	mkdir -p app/logs
	mkdir -p app/cache
	chmod -R 777 app/logs
	chmod -R 777 app/cache
