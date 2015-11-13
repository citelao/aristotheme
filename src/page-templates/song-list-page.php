<?php
/*
 * Template Name: Song-list page
 * Description: Page with list of songs. TBD content ideas
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
	<h2>Current Songs</h2>
	<ul>
	<?php query_posts(array(
			'post_type' => 'song'
		));

	while ( have_posts() ) : the_post();
		// skip retired songs 
		$is_retired = (get_post_meta(get_the_ID(), 'bs_song_status', true) == 1);
		if($is_retired) { continue; } 

		$arrangers = get_post_meta(get_the_ID(), 'bs_arranger', true);
		$arranger_string = join($arrangers, ", ");

		$soloists = get_post_meta(get_the_ID(), 'bs_soloist', true);
		$soloist_string = join($soloists, ", ");

		$originals = get_post_meta(get_the_ID(), 'bs_original', true);
		$original_string = join($originals, ", ");
	?>
		<li>
			<div>
				<h3><?php the_title(); ?></h3>
				<table class="definition-table">
					<tr>
						<th>Original</th>
						<td><?php echo $original_string; ?></td>
					</tr>
					<tr>
						<th>Arrangement</th>
						<td><?php echo $arranger_string; ?></td>
					</tr>
					<tr>
						<th>Soloist</th>
						<td><?php echo $soloist_string; ?></td>
					</tr>
				</table>
			</div>
		</li>
	<?php endwhile; ?>
	</ul>
</section>
<?php get_footer(); ?>