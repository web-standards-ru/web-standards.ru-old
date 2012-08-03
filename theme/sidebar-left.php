			<div id="sidebar">
				<h2>Навигация</h2>
				<?php wst_menu(); ?>
<?php	if ( $user_ID ) : global $current_user; get_currentuserinfo(); ?>
				<dl class="module">
					<dt>Профиль</dt>
					<dd class="content content-secondary content-aside">
						<p>
							<span class="user"><?php echo $current_user->display_name; ?></span> <a href="<?php echo wp_logout_url( get_current_url() ); ?>" title="Выйти">×</a>
						</p>
<?php		if ( is_editor() ) : ?>
						<ul>
							<li><a href="/wp-admin/">Панель управления</a></li>
							<li><a href="/wp-admin/profile.php">Ваш профиль</a></li>
							<li><a href="/wp-admin/post-new.php">Новая запись</a></li>
						</ul>
<?php		endif; ?>
					</dd>
				</dl>
<?php	endif; ?>
				<dl class="module">
					<dt>Ссылки</dt>
					<dd class="content content-secondary content-aside">
						<ul>
							<li><a href="http://twitter.com/webstandards_ru">Новости в Твиттере</a></li>
							<li><a href="http://vimeo.com/channels/wstdays">Видео на Vimeo</a></li>
							<li><a href="http://vk.com/webstandards_ru">ВКонтакте</a></li>
							<li><a href="http://fb.com/webstandardsru">Facebook</a></li>
							<li><a href="https://plus.google.com/102454977730856836566/about">Google+</a></li>
						</ul>
					</dd>
				</dl>
				<dl class="module module-tags">
					<dt>Теги</dt>
					<dd class="content content-secondary">
						<?php wst_tag_cloud(); ?>

					</dd>
				</dl>
				<dl class="module">
					<dt>RSS</dt>
					<dd class="content content-secondary content-aside">
						<ul>
							<li><a href="/category/news/feed/">Новости</a></li>
							<li><a href="/category/articles/feed/">Статьи</a></li>
							<li><a href="/feed/">Всё сразу</a></li>
						</ul>
					</dd>
				</dl>
			</div>
