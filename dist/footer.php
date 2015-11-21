	</section>
	<footer class="footer">
		<p>
			The songs we sing are copyrights of their respective owners, but the arrangements are ours, and this site is ours. Please don't use anything here without permission.
		</p>

		<p>We sing their songs, but we are not affiliated with the Walt Disney Company.</p>

		
			<nav class="navigation navigation--footer">
				<ul class="navigation__list">
					<li class="navigation__item">
						<a href="http://su.wustl.edu">
							<img class="footer__image" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/footer/sulogo.svg" alt="Student Union Logo" height="50" width="50">&nbsp;Student&nbsp;Union
						</a>
					</li>
					<li class="navigation__item">
						<a href="http://wustl.edu">
							<img class="footer__image" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/footer/wustllogo.svg" alt="WUSTL Logo" height="50" width="50">&nbsp;Washington&nbsp;University&nbsp;in&nbsp;St.&nbsp;Louis
						</a>
					</li>
				</ul>
			</nav>
		</p>

		<nav class="navigation navigation--footer">
			<?php wp_nav_menu(array(
				'container' => 'false',
				'menu_class' => 'navigation__list',
				'theme_location' => 'social-nav'
			)); ?>
		</nav>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>