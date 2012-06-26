<?php	if ( isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) ) die (':o)'); ?>
<?php	if ( have_comments() ) : ?>
					<h2>Комментарии <a href="#comment" title="Добавить">+</a></h2>
					<ol class="comments">
<?php		foreach ( $comments as $comment ) : ?>
						<li class="comments-item">
							<dl id="comment-<?php comment_ID(); ?>">
								<dt>
<?php			if ( get_comment_author_url() ) : ?>
									<a href="<?php echo get_comment_author_url(); ?>" class="user"><?php echo get_comment_author(); ?></a>
<?php			else : ?>
									<span class="user"><?php echo get_comment_author(); ?></span>
<?php			endif; ?>
									<span class="date">
										<abbr title="<?php the_time('Y-m-d\TH:i:sP'); ?>"><a href="#comment-<?php comment_ID(); ?>" title="Ссылка на комментарий"><?php comment_date(); ?> в <?php comment_time(); ?></a></abbr>
										<?php edit_comment_link('E','&middot; ',''); ?>
									</span>
								</dt>
								<dd>
									<?php comment_text(); ?>
<?php			if ( $comment->comment_approved == '0' ) : ?>
									<p class="note">Ваш комментарий успешно добавлен и ожидает проверки.</p>
<?php			endif; ?>
								</dd>
							</dl>
						</li>
<?php		endforeach; ?>
					</ol>
<?php	endif; ?>
<?php	if ( 'open' == $post->comment_status ) : ?>
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment" class="form form-primary form-comment">
						<h2><label for="comment-text">Ваш комментарий</label></h2>
<?php		if ( !$user_ID ) : ?>
						<fieldset>
							<input type="text" name="author" id="comment-name" value="<?php echo $comment_author; ?>" class="text">
							<label for="comment-name">Имя •</label>
						</fieldset>
						<fieldset>
							<input type="email" name="email" id="comment-email" value="<?php echo $comment_author_email; ?>" class="text">
							<label for="comment-email">E-mail •</label>
						</fieldset>
						<fieldset>
							<input type="url" name="url" id="comment-url" value="<?php echo $comment_author_url; ?>" class="text">
							<label for="comment-url">Сайт</label>
						</fieldset>
<?php		endif; ?>
						<fieldset>
							<textarea name="comment" id="comment-text" cols="70" rows="10" class="text"></textarea>
							<p class="form-note">
								Разрешённые HTML-теги: <code>&lt;blockquote&gt;</code>, <code>&lt;a href="…"&gt;</code>, <code>&lt;del&gt;</code>, <code>&lt;strong&gt;</code>, <code>&lt;b&gt;</code>, <code>&lt;em&gt;</code>, <code>&lt;i&gt;</code>.<br>
								Исходный код блочного уровня для лучшего отображения обрамляйте в элемент <code>&lt;source&gt;</code>.
							</p>
							<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>">
							<input type="submit" value="Добавить" class="submit">
						</fieldset>
					</form>
<?php	endif; ?>
