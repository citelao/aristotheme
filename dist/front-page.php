<?php get_header(); ?>
<section class="content content--full">
	<?php 
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object($locations['home-nav']);
	$items = wp_get_nav_menu_items($menu->term_id);

	if(!$items): ?>
		<h1>So...</h1>
		<h2>Apparently <em>someone</em> didn't add the navigation menus correctly.</h2>
		<p>I'm gonna go get Janet. JANET! FIX IT!</p>
	<?php endif;

	foreach ($items as $key => $post): 

		$meta = get_post_custom($post->object_id);

		// print_r($meta);

		$title = $post->title;
		if($meta['bs_alt_title']) {
			$title = $meta['bs_alt_title'][0];
		}
		if($meta['bs_featured_title']) {
			$title = $meta['bs_featured_title'][0];
		}

		$blurb = $meta['bs_featured_summary'];

		$attachment = '';
		if($meta['bs_featured_image'][0]) {
			$attachment = $meta['bs_featured_image'][0];
		} elseif(get_post_thumbnail_id($post->object_id)) {
			$attachment = get_post_thumbnail_id($post->object_id);
		}
		$img = wp_get_attachment_image_src($attachment, 'full');
		$style = '';
		if($img) {
			$style = 'background-image: url(' . $img[0] . ')';
		}

		?>
	
		<a href="<?php echo $post->url; ?>" class="spotlight" style="<?php echo $style; ?>">
			<div class="spotlight__content">
				<h2><?php echo $title; ?></h2>
				<?php 
					if($blurb) {
						echo $blurb[0];
					}
				?>
			</div>
		</a>

	<?php endforeach; ?>
</section>
<?php get_footer(); ?>	