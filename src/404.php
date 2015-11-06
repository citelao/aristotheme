<?php get_header(); ?>
<section class="content">
	<h2>Error 404.</h2>
	<h3>We couldn't find the page you're looking for.</h3>
	<img src="<?php bloginfo('template_directory'); ?>/img/error/smashing.gif" />
	<p>
		<cite>(<a href="http://zetobichan.tumblr.com/">zetobichan</a> via <a href="http://www.smosh.com/smosh-pit/photos/14-smashing-nigel-thornberry-gifs">Smosh</a>)</cite>
	</p>
	<p>
		Maybe Belle borrowed it... I would suggest going <a href="/">home</a> or <a href="/contact/">contacting us</a> about the problem.
	</p>
</section>
<ul class="sidebar">
	<?php dynamic_sidebar('bs-sidebar'); ?>
</ul>
<?php get_footer(); ?>