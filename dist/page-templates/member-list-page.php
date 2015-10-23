<?php
/*
 * Template Name: Member-list page
 * Description: Page with member portraits after the content.
 */
 get_header(); ?>
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

	<h2>Members</h2>
	<ul>
	<?php query_posts( 'post_type=member' );
	while ( have_posts() ) : the_post();
	 	// exclude alumni
		$is_alum = (get_post_meta(get_the_ID(), 'bs_member_status', true) == 1);
		if($is_alum) { continue; } ?>
		<li>
			<?php the_title(); ?>
		</li>
	<?php endwhile; ?>
	</ul>

	<h2>Alumni</h2>
	<ul>
	<?php rewind_posts();
	while ( have_posts() ) : the_post(); ?>
		<?php // only alumni
		$is_alum = (get_post_meta(get_the_ID(), 'bs_member_status', true) == 1);
		if(!$is_alum) { continue; } ?>
		<li>
			<?php the_title(); ?>
		</li>
	<?php endwhile; ?>
	</ul>

<?php get_footer(); ?>