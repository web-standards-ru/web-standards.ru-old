<?php	get_header(); ?>
				<div id="main" class="content content-primary">
<?php	if ( is_category('news') ) : ?>
					<div class="heading-group">
						<div class="heading heading-rss">
							<h1>Новости</h1>
							<a href="/category/news/feed/" class="rss" title="RSS-трансляция">RSS</a>
						</div>
					</div>
					<ol class="archive-list compact-list">
<?php		$posts = query_posts($query_string . '&posts_per_page=10'); ?>
<?php		while ( have_posts() ) : the_post(); ?>
						<li class="archive-item">
							<div class="heading">
								<p><abbr title="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time('j F Y'); ?></abbr></p>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</div>
							<?php the_content(); ?>
						</li>
<?php		endwhile; ?>
					</ol>
<?php	elseif ( is_category('events') ) : ?>
					<div class="heading-group">
						<div class="heading heading-rss">
							<h1>События</h1>
							<a href="/category/events/feed/" class="rss" title="RSS-трансляция">RSS</a>
						</div>
					</div>
					<ol class="archive-list compact-list">
<?php		$posts = query_posts($query_string . '&posts_per_page=10'); ?>
<?php		while ( have_posts() ) : the_post(); ?>
						<li class="archive-item hentry">
							<div class="heading">
								<p><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time('j F Y'); ?></abbr></p>
								<h2 class="heading entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							</div>
							<div class="entry-summary content-article">
<?php			if ( has_excerpt() ) : ?>
								<?php the_excerpt(); ?>
<?php			else : ?>
								<?php the_content(); ?>
<?php			endif; ?>
							</div>
						</li>
<?php		endwhile; ?>
					</ol>
<?php	else : ?>
					<h1>Статьи</h1>
					<ol class="archive-list article-list">
<?php		while ( have_posts() ) : the_post(); ?>
						<li class="archive-item hentry">
							<div class="heading-group heading-article">
								<h2 class="heading entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								<p>
									<?php the_author(); ?>
									<abbr class="published" title="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time('j F Y'); ?></abbr>
								</p>
							</div>
							<div class="entry-summary content-article">
<?php			if ( has_excerpt() ) : ?>
								<?php the_excerpt(); ?>
<?php			else : ?>
								<?php the_content(); ?>
<?php			endif; ?>
								<p class="comments-number"><a href="<?php comments_link(); ?>"><?php comments_human('Комментарии', 'комментарий', 'комментария', 'комментариев'); ?></a></p>
							</div>
						</li>
<?php		endwhile; ?>
					</ol>
<?php	endif; ?>
					<?php wst_paging(); ?>
				</div>
<?php	get_sidebar('right'); ?>
<?php	get_footer(); ?>
