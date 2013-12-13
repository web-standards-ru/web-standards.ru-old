<?php	get_header(); ?>
<?php	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php		if ( in_category('articles') ) : ?>
					<div id="main" class="content content-primary hentry">
						<div class="heading-group heading-article">
							<h1 class="heading entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
							<p>
								<?php the_author(); ?>
								<abbr class="published" title="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time('j F Y'); ?></abbr>
							</p>
						</div>
						<div class="content-article entry-content">
							<?php the_content(); ?>
							<?php edit_post_link('E','<p>','</p>'); ?>
							<script src="//yandex.st/share/share.js"></script>
							<p class="share-buttons yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="twitter,facebook,gplus,vkontakte,lj"></p>
							<?php the_tags('<p class="tag-list">Теги: ', ', ', '</p>'); ?>
						</div>
						<div class="content-article" id="comments">
							<?php comments_template(); ?>
						</div>
					</div>
<?php		else : ?>
				<div id="main" class="content content-primary">
					<div class="heading-group">
						<h1 class="heading"><?php the_title(); ?></h1>
						<p><abbr title="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time('j F Y'); ?></abbr></p>
					</div>
					<div class="content-article">
						<?php the_content(); ?>
						<?php edit_post_link('E','<p>','</p>'); ?>
						<script src="//yandex.st/share/share.js"></script>
						<p class="share-buttons yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="twitter,facebook,gplus,vkontakte,lj"></p>
					</div>
				</div>
<?php		endif; ?>
<?php	endwhile; endif; ?>
<?php	get_sidebar('right'); ?>
<?php	get_footer(); ?>
