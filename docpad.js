var moment = require('moment');
	moment.locale('ru');
var marked = require('marked');
var sanitizer = require('sanitize-html');

module.exports = {

	templateData: {

		site: {
			title: 'Веб-стандарты',
			description: 'Российское сообщество разработчиков',
			url: 'http://web-standards.ru/',
			email: 'wst@web-standards.ru'
		},

		htmlTitle: function() {
			var siteTitle = this.site.title,
				documentTitle = this.document.title;
			return (documentTitle ? this.sanitizeHTML(documentTitle) + ' — ' : '') + siteTitle;
		},

		feedTitle: function() {
			var siteTitle = this.site.title,
				documentTitle = this.document.title;
			return siteTitle + (documentTitle ?  ' — '  + documentTitle : '');
		},

		getDate: function(date, format) {
			return moment(date).format(format || 'D MMMM YYYY');
		},

		isIndex: function(document) {
			return document.url == '/' ? true : false;
		},

		sanitizeHTML: function(title) {
			return sanitizer(title, {
				allowedTags: []
			})
		}

	},

	ignoreCustomPatterns: /.scss$|.js$/,

	events: {
		renderBefore: function() {
			return this.docpad.getCollection('documents').forEach(function(page) {
				var newPath, newUrl;

				newPath = page.get('outPath')
					// feed/foo.xml — feed/foo/index.xml
					.replace(/feed\/((?!index\.)[a-z]+)\.xml/, 'feed/$1/index.xml')
					// archive/foo.html — foo/index.html
					.replace(/archive\/([a-z]+)\.html/, '$1/index.html')
					// foo/bar.html — foo/bar/index.html
					.replace(/([a-z]+)\/((?!index\.)[a-z0-9_\-]+)\.html/, '$1/$2/index.html');

				newUrl = page.get('url')
					// foo/bar.html — foo/bar/index.html
					.replace(/([a-z]+)\/((?!index\.)[a-z0-9_\-]+)\.html/, '$1/$2/')
					// foo/index.html — foo/
					.replace(/(.*)index\.html/, '$1');

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
				var renderer = new marked.Renderer(),
					oldTitle = document.get('title'),
					newTitle;
				renderer.paragraph = function(text) {
					return text;
				}
				newTitle = marked(oldTitle, {
					renderer: renderer
				});
				document.setMetaDefaults({
					author_name: 'Редакция «Веб-стандартов»',
					author_url: 'http://web-standards.ru/editors/'
				}).set({
					title: newTitle
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
