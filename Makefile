TODAY = $(shell date "+%Y-%m-%d")
DUMP = webstandards-dump-$(TODAY).sql

init:
	@echo 'Getting WordPress…'
	@curl -O http://wordpress.org/latest.tar.gz
	@tar --strip-components=1 -xf latest.tar.gz
	@rm -rf latest.tar.gz
	@echo 'Copying folders…'
	@cp -r plugins wp-content/plugins
	@cp -r theme wp-content/themes/webstandards
	@cp -n wp-config-sample.php wp-config.php
	@echo 'Done. Now change wp-config.php to connect DB.'

clean:
	rm -rf wp-* *.php readme.html license.txt

publish:
	#

getdump:
	ssh wst@web-standards.ru
	mysqldump -u wst -p webstandards > $(DUMP) && exit
	scp wst@web-standards.ru:$(DUMP) .
	ssh wst@web-standards.ru
	rm -rf $(DUMP)