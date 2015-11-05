<?php
/*
 * Template Name: Member-list page
 * Description: Page with member portraits after the content.
 */
 get_header(); ?>
<section class="content content--contiguous-bottom">
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
<section class="content content--contiguous-top">
	<h2>Members</h2>
</section>
	<ul class="person">
	<?php query_posts( 'post_type=member' );
	while ( have_posts() ) : the_post();
	 	// exclude alumni
		$is_alum = (get_post_meta(get_the_ID(), 'bs_member_status', true) == 1);
		if($is_alum) { continue; } 

		$attachment = get_post_meta(get_the_ID(), 'bs_member_image', true);
		$img = wp_get_attachment_image_src($attachment, 'full');
		$style = "";
		if($img) {
			$style = $style = 'background-image: url(' . $img[0] . ')';
		}
		?>
		<li style="<?php echo $style; ?>" class="person__item">
			<div class="person__content">
				<h3><?php the_title(); ?></h3>
			</div>
		</li>
	<?php endwhile; ?>
	</ul>
<section class="content">
	<h2>Alumni</h2>
</section>
	<ul class="person person--small">
	<?php rewind_posts();
	while ( have_posts() ) : the_post(); ?>
		<?php // only alumni
		$is_alum = (get_post_meta(get_the_ID(), 'bs_member_status', true) == 1);
		if(!$is_alum) { continue; } 

		$attachment = get_post_meta(get_the_ID(), 'bs_member_image', true);
		$img = wp_get_attachment_image_src($attachment, 'full');
		$style = "";
		if($img) {
			$style = $style = 'background-image: url(' . $img[0] . ')';
		}
		?>
		<li style="<?php echo $style; ?>" class="person__item">
			<div class="person__content">
				<h3><?php the_title(); ?></h3>
			</div>
		</li>
	<?php endwhile; ?>
	</ul>

<?php get_footer(); ?>