				<div id="aside" class="content content-secondary content-aside">
<?php	if( is_category('events') || ( is_single() && in_category('events') ) ) : ?>
				    <?php get_static( 'events-sidebar' ); ?>
<?php	endif; ?>
<?php	if( is_category('articles') ) : ?>
					<?php // <h3>Популярные статьи</h3> ?>
					<?php // popular_posts( 3 ); ?>
					<h3>Статьи по тегам</h3>
					<?php wp_tag_cloud( 'format=list&number=0&smallest=11&largest=11&unit=px' ); ?>
<?php	endif; ?>
<?php	if( is_single() && in_category('articles') ) : ?>
					<h3>Статьи по тегам</h3>
					<?php wp_tag_cloud( 'format=list&number=0&smallest=11&largest=11&unit=px' ); ?>
<?php	endif; ?>
<?php	if( is_category('news') || ( is_single() && in_category('news') ) ) : ?>
    				<?php get_static( 'news-sidebar' ); ?>
<?php	endif; ?>
<?php	if( is_page('about') ) : ?>
					<?php get_static( 'about-sidebar' ); ?>
<?php	endif; ?>
				</div>
