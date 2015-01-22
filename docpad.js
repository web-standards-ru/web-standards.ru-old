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
		articles: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: /^articles\//,
				extension: 'md'
			}, [{ date:-1 }]).on('add', function(model){
				model.setMetaDefaults({
					layout: 'article'
				})
			})
		},
		books: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: /^books\//,
				extension: 'md'
			}, [{ date:-1 }]).on('add', function(model){
				model.setMetaDefaults({
					layout: 'book'
				})
			})
		},
		news: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: /^news/,
				extension: 'md'
			}, [{ date:-1 }]).on('add', function(model){
				model.setMetaDefaults({
					layout: 'news'
				})
			})
		},
		videos: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: /^videos/,
				extension: 'md'
			}, [{ date:-1 }]).on('add', function(model){
				model.setMetaDefaults({
					layout: 'video'
				})
			})
		},
		all: function() {
			return this.getCollection('html').findAllLive({
				relativeOutDirPath: /(^articles\/|^books\/|^news|^videos)/,
				extension: 'md'
			}, [{ date:-1 }])
		}
	}

}
