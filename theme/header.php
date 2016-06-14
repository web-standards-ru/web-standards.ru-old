<!DOCTYPE HTML>
<html lang="ru">
<head>
	<title><?php wp_title('—',true,'right'); ?><?php bloginfo('name'); ?></title>
	<meta charset="utf-8">
	<meta name="description" content="Российское сообщество разработчиков «Веб-стандарты»">
	<meta name="keywords" content="веб-стандарты, вст, wst, web standards, wsd, wstdays, web standards days, wsg, web standards group, wsg russia, xhtml, html, html5, css, css3, svg, canvas, микроформаты, microformats">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="http://static.web-standards.ru/styles/screen.css">
	<link rel="stylesheet" href="http://static.web-standards.ru/styles/mobile.css" media="only screen and (max-width:640px)">
	<!--[if lt IE 9]><link rel="stylesheet" href="http://static.web-standards.ru/styles/ie.css"><![endif]-->
	<link rel="icon" sizes="16x16" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="alternate" type="application/rss+xml" title="Все публикации" href="http://web-standards.ru/feed/">
<?php	if ( is_category() ) : foreach ( get_the_category() as $cat ) : ?>
	<link rel="alternate" type="application/rss+xml" title="<?php echo $cat->cat_name; ?>" href="http://web-standards.ru/category/<?php echo $cat->category_nicename; ?>/feed/">
<?php	endforeach; else : ?>
	<link rel="alternate" type="application/rss+xml" title="Новости" href="http://web-standards.ru/category/news/feed/">
<?php	endif; ?>
	<link rel="edituri" type="application/rsd+xml" title="RSD" href="http://web-standards.ru/xmlrpc.php?rsd">
</head>
<body id="<?php get_page_type() ?>">
	<!--noindex-->
	<ul class="skipto">
		<li><a href="#content" accesskey="c">Перейти к содержанию</a> ↓</li>
		<li><a href="#sidebar" accesskey="n">Перейти к навигации</a> ↓</li>
	</ul>
	<!--/noindex-->
	<div id="page">
		<div id="header" class="vcard">
			<div class="logotype">
<?php	if ( is_home() ) : ?>
				<img src="http://static.web-standards.ru/images/hex.svg" alt="Логотип" class="logo">
<?php	else : ?>
				<a href="/"><img src="http://static.web-standards.ru/images/hex.svg" alt="Логотип" class="logo"></a>
<?php	endif; ?>
			</div>
			<div class="heading">
<?php	if ( is_home() ) : ?>
				<h1 class="fn org"><?php bloginfo('name'); ?></h1>
<?php	else : ?>
				<h3 class="fn org"><a href="/" class="url"><?php bloginfo('name'); ?></a></h3>
<?php	endif; ?>
				<p class="note"><?php bloginfo('description'); ?></p>
			</div>
			<form action="http://yandex.ru/yandsearch" method="get" class="form form-secondary form-search">
				<fieldset>
					<legend>
						<label for="search-text">Поиск</label>
					</legend>
					<input type="hidden" name="site" value="web-standards.ru">
					<input type="search" name="text" id="search-text" class="text">
					<input type="submit" title="Найти" value="Найти" class="submit">
				</fieldset>
			</form>
		</div>
		<div id="body">
			<div id="content">
<?php	if( is_home() ) : ?>
				<div id="intro" class="content content-secondary">
                    <?php get_static( 'index-announce' ); ?>
					<div class="logo"></div>
				</div>
<?php	endif; ?>
