function getCollection(pathPrefix, layout) {
	return this.getCollection('html').findAllLive({
				relativeOutDirPath: {
					$beginsWith: pathPrefix
				},
				extension: 'md'
			}, [{ date:-1 }]).on('add', function(model){
				model.setMetaDefaults({
					layout: layout
				})
			})
}

module.exports = {

	templateData: {
		site: {
			title: 'Веб-стандарты',
			description: 'Российское сообщество разработчиков',
			url: 'http://web-standards.ru/'
		}
	},

	plugins: {
		grunt: {
			writeAfter: false,
			generateAfter: []
		}
	},

	collections: {

		all: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: {
					$beginsWith: {
						$or: [
							'articles',
							'books',
							'news',
							'videos'
						]
					}
				},
				extension: 'md'
			}, [{ date:-1 }])
		},

		articles: getCollection('articles', 'article'),

		books: getCollection('books', 'book'),

		news: getCollection('news', 'news'),

		videos: getCollection('videos', 'video')
	}

}
