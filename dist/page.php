<?php get_header(); ?>
<section class="content">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
		<h2><?php
			// if we have an alternate title, use that
			$alt_title = get_post_meta(get_the_ID(), 'bs_alt_title', true);
			if($alt_title) {
				echo $alt_title;
			} else {
				the_title();
			}
		?></h2>
		<p><?php the_content(); ?></p>
	<?php endwhile; else : ?>
		no posts
 	<?php endif; ?>
</section>
<ul class="sidebar">
	<?php dynamic_sidebar('bs-sidebar'); ?>
</ul>
<?php get_footer(); ?>