# Веб-стандарты

Исходный код сайта «[Веб-стандарты](http://web-standards.ru/)» для совместной разработки и поддержки проекта силами редакции ВСТ.

## Как работает

Как склонировать, установить зависимости и сгенерировать сайт в `out/`

	git clone -b docpad git@github.com:web-standards-ru/web-standards-ru.git
	cd web-standards-ru/
	npm install
	bower install
	node_modules/.bin/docpad generate --env static

Вместо замысловатого последнего шага удобнее установить DocPad глобально:

	npm install docpad -g

Тогда можно будет удобно запускать автогенерацию и сервер для разработки:

	docpad run

Для простой генерации в той же папке без сервера:

	docpad generate --env static
