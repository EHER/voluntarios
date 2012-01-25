default:
	@echo depends\t\tInstala as dependências do projeto
	@echo perms\t\tAjusta as permisões dos arquivos

depends:
	git submodules update --init

perms:
	chmod -R 777 app/logs
	chmod -R 777 app/cache
