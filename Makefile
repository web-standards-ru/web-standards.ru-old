TODAY = $(shell date "+%Y-%m-%d")
DUMP = webstandards-$(TODAY).sql

publish:
	@echo 'Uploading files…'
	@rsync -rtz -O --chmod g+rw --delete --exclude '.DS_Store' static/ web-standards.ru:/var/www/web-standards.ru/www/htdocs/static/
	@rsync -rtz -O --chmod g+rw --exclude '.DS_Store' plugins/ web-standards.ru:/var/www/web-standards.ru/www/htdocs/wp-content/plugins/
	@rsync -rtz -O --chmod g+rw --exclude '.DS_Store' theme/ web-standards.ru:/var/www/web-standards.ru/www/htdocs/wp-content/themes/webstandards/
	@rsync -rtz -O --chmod g+rw .htaccess favicon.ico apple-touch-icon.png google*.html yandex*.txt robots.txt humans.txt web-standards.ru:/var/www/web-standards.ru/www/htdocs/
	@echo 'Done.'

install:
	@echo 'Getting WordPress…'
	@curl -O http://ru.wordpress.org/latest-ru_RU.tar.gz
	@tar --strip-components=1 -xf latest-ru_RU.tar.gz
	@rm -f latest-ru_RU.tar.gz
	@echo 'Copying files…'
	@cp -r plugins wp-content/
	@cp -r theme wp-content/themes/webstandards
	@cp -n wp-config-sample.php wp-config.php
	@echo 'Done. Now change wp-config.php to connect DB.'

cleanup:
	@rm -rf wp-* *.php readme.html license.txt

getdump:
	@echo 'Connecting to DB…'
	@ssh wst@web-standards.ru 'mysqldump -c -h mysql.web-standards.ru -u wst -p webstandards' > $(DUMP)
	@echo 'Your dump is ready: $(DUMP)'