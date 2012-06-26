<?php	get_header(); ?>
				<div id="main" class="content content-primary content-article">
<?php	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="heading-group">
						<h1 class="heading"><?php the_title(); ?></h1>
					</div>
					<?php the_content(); ?>
					<?php edit_post_link('E','<p>','</p>'); ?>
<?php	endwhile; endif; ?>
<?php	comments_template(); ?>
				</div>
<?php	get_sidebar('right'); ?>
<?php	get_footer(); ?>
