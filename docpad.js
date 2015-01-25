module.exports = {

	templateData: {

		site: {
			title: 'Веб-стандарты',
			description: 'Российское сообщество разработчиков',
			url: 'http://web-standards.ru/',
			email: 'wst@web-standards.ru'
		},

		htmlTitle: function() {
			if (this.document.title) {
				return this.document.title + ' — ' + this.site.title;
			} else {
				return this.site.title;
			}
		},

		feedTitle: function() {
			if (this.document.title) {
				return this.site.title + ' — ' + this.document.title;
			} else {
				return this.site.title;
			}
		}

	},

	plugins: {

		grunt: {
			writeAfter: false,
			generateAfter: []
		}

	},

	events: {
		renderBefore: function() {
			return this.docpad.getCollection('html').forEach(function(page) {

				// archive/books.html — books/
				// news/000.html — news/000/
				// videos/xxx.html — videos/xxx/

				var pageName = page.attributes.basename,
					newPath, newUrl;

				newPath = page.get('outPath')
					.replace('archive/' + pageName + '.html', pageName + '/index.html')
					.replace('news/' + pageName + '.html', 'news/' + pageName + '/index.html')
					.replace('videos/' + pageName + '.html', 'videos/' + pageName + '/index.html');

				newUrl = page.get('url')
					.replace('archive/' + pageName + '.html', pageName + '/')
					.replace('news/' + pageName + '.html', 'news/' + pageName + '/')
					.replace('videos/' + pageName + '.html', 'videos/' + pageName + '/')
					.replace('/index.html', '/');

				page.set('outPath', newPath);
				page.setUrl(newUrl);

				return page;
			})
		}
	},

	collections: {

		all: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: {
					$beginsWith: [
						'articles',
						'books',
						'news',
						'videos'
					]
				},
				extension: 'md'
			}, [{ date:-1 }]).on('add', function(document) {
				document.setMetaDefaults({
					author_name: 'Редакция «Веб-стандартов»',
					author_url: 'http://web-standards.ru/editors/'
				})
			})
		},

		articles: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: {
					$beginsWith: 'articles'
				},
				extension: 'md'
			}, [{ date:-1 }]).on('add', function(document) {
				document.setMeta({
					layout: 'article'
				})
			})
		},

		books: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: {
					$beginsWith: 'books'
				},
				extension: 'md'
			}, [{ date:-1 }]).on('add', function(document) {
				document.setMeta({
					layout: 'book'
				})
			})
		},

		news: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: {
					$beginsWith: 'news'
				},
				extension: 'md'
			}, [{ date:-1 }]).on('add', function(document) {
				document.setMeta({
					layout: 'news'
				})
			})
		},

		videos: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: {
					$beginsWith: 'videos'
				},
				extension: 'md'
			}, [{ date:-1 }]).on('add', function(document) {
				document.setMeta({
					layout: 'video'
				})
			})
		},

		feeds: function() {
			return this.getCollection('documents').findAllLive({
				relativeOutDirPath: {
					$beginsWith: 'feed'
				}
			}).on('add', function(document) {
				document.setMeta({
					layout: 'feed'
				})
			})
		}

	}

}
