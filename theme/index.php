<?php	get_header(); ?>
				<div id="main" class="content content-primary">
<?php	if ( have_posts() ) : ?>
<?php		query_posts('cat=3&showposts=4'); ?>
					<ol class="archive-list article-list">
<?php		while ( have_posts() ) : the_post(); ?>
						<li class="archive-item hentry">
							<div class="heading-group heading-article">
								<h2 class="heading entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								<p>
									<?php the_author(); ?>
									<abbr class="published" title="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time('j F'); ?></abbr>
								</p>
							</div>
							<div class="entry-summary content-article">
								<?php the_excerpt(); ?>
							</div>
							<p class="comments-number"><a href="<?php comments_link(); ?>"><?php comments_human('Комментарии', 'комментарий', 'комментария', 'комментариев'); ?></a></p>
						</li>
<?php		endwhile; ?>
					</ol>
					<p><a href="/category/articles/">Архив статей</a></p>
				</div>
				<div id="aside" class="content content-secondary">
					<div class="heading-group">
						<div class="heading heading-rss">
							<h2><a href="/category/news/">Новости</a></h2>
							<a href="/category/news/feed/" class="rss" title="RSS-трансляция">RSS</a>
						</div>
					</div>
					<ol class="archive-list compact-list">
<?php		query_posts('cat=1&showposts=3'); ?>
<?php		while ( have_posts() ) : the_post(); ?>
						<li class="archive-item">
							<div class="heading">
								<p><abbr title="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time('j F'); ?></abbr></p>
								<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
							</div>
<?php			if ( has_excerpt() ) : ?>
							<?php the_excerpt(); ?>
							<p><a href="<?php the_permalink(); ?>">Читать дальше…</a></p>
<?php			else : ?>
							<?php the_content(); ?>
<?php			endif; ?>
						</li>
<?php		endwhile; ?>
					</ol>
					<p><a href="/category/news/">Архив новостей</a></p>
<?php	endif; ?>
				</div>
<?php	get_footer(); ?>
