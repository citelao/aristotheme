<?php get_header(); ?>
	<ul>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
			<li>
				<h2><?php the_title(); ?></h2>
				<p><?php the_content(); ?></p>
			</li>
		<?php endwhile; else : ?>
			no posts
	 	<?php endif; ?>
	</ul>
	<ul class="sidebar">
		<?php dynamic_sidebar('bs-sidebar'); ?>
	</ul>
<?php get_footer(); ?>