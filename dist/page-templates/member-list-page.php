<?php
/*
 * Template Name: Member-list page
 * Description: Page with member portraits after the content.
 */
 get_header(); ?>
<section class="content content--contiguous-bottom">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
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
	<?php query_posts(array(
			'post_type' => 'member',
			'meta_key' => 'bs_member_role',
			// 'meta_query' => array(
			// 	array(
			// 		'key' => 'bs_member_role',
			// 		'compare' => 'EXISTS',
			// 		'type' => 'CHAR'
			// 	)
			// ),
			'orderby' => array('meta_value' => 'ASC', 'title' => 'ASC')
		));
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

		$role = get_post_meta(get_the_ID(), 'bs_member_role', true);
		$role_block = '';
		if($role != 'none') {
			$role_block = '<h4 class="person__role">' . $role . '</h4>';
		}

		?>
		<li style="<?php echo $style; ?>" class="person__item">
			<div class="person__content">
				<h3 class="person__name"><?php the_title(); ?></h3>
				<?php echo $role_block; ?>
			</div>
		</li>
	<?php endwhile; ?>
		<li class="person__item person__item--link">
			<a class="person__content" href="/auditions">
				<h3 class="person__name">You?
				</h3>
			</a>
		</li>
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

		$role = get_post_meta(get_the_ID(), 'bs_member_role', true);
		$role_block = '';
		if($role != 'none') {
			$role_block = '<h4 class="person__role">' . $role . '</h4>';
		}
		?>
		<li style="<?php echo $style; ?>" class="person__item">
			<div class="person__content">
				<h3 class="person__name"><?php the_title(); ?></h3>
				<?php echo $role_block; ?>
			</div>
		</li>
	<?php endwhile; ?>
	</ul>

<?php get_footer(); ?>