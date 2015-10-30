# Веб-стандарты

Исходный код сайта «[Веб-стандарты](http://web-standards.ru/)» для совместной разработки и поддержки проекта силами редакции ВСТ.

## Как работает

Как склонировать, установить зависимости и сгенерировать сайт в `out/`

	git clone -b docpad git@github.com:web-standards-ru/web-standards-ru.git
	cd web-standards-ru/
	npm install
	bower install
	npm run static

Можно удобно запускать автогенерацию и сервер для разработки:

	npm run server
