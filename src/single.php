<?php get_header(); ?>
<section class="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
	<h2><?php the_title(); ?></h2>
	<p><?php the_content(); ?></p>
<?php endwhile; else : ?>
	no posts
<?php endif; ?>
</section>
<ul class="sidebar">
	<?php dynamic_sidebar('bs-sidebar'); ?>
</ul>
<?php get_footer(); ?>