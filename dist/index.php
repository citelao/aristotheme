<?php get_header(); ?>
<ul class="content">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
		<li>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p><?php the_content(); ?></p>
		</li>
	<?php endwhile; else : ?>
		<li>
			<h2>No posts.</h2>
			<p>I don't know how that happened&#8230;</p>
			<p>
				The post you're looking for might have been deleted (oops!). I would suggest going <a href="/">home</a> or <a href="/contact/">contacting us</a> about the problem.
			</p>
			<p>Here's a gif instead:</p>
			<img src="<?php bloginfo('template_directory'); ?>/img/error/didney.gif" />
			<p>
				<cite>(<a href="http://perel.tumblr.com/">Yotam Perel</a> via Giphy)</cite>
			</p>
		</li>
 	<?php endif; ?>
</ul>
<ul class="sidebar">
	<?php dynamic_sidebar('bs-sidebar'); ?>
</ul>
<?php get_footer(); ?>