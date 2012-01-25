default:
	@echo "depends\t\tInstala as dependências do projeto"
	@echo "perms\t\tAjusta as permisões dos arquivos"

depends:
	git submodule update --init

update-depends:
	git submodule foreach git checkout master
	git submodule foreach git pull

perms:
	chmod -R 777 app/logs
	chmod -R 777 app/cache
