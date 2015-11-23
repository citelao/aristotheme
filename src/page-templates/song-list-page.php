<?php
/*
 * Template Name: Song-list page
 * Description: Page with list of songs. TBD content ideas
 */
 get_header(); ?>
<section class="content content--contiguous-bottom">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
		<p><?php the_content(); ?></p>
	<?php endwhile; else : ?>
		no posts
 	<?php endif; ?>
</section>
<!-- <ul class="sidebar">
	<?php dynamic_sidebar('bs-sidebar'); ?>
</ul> -->

<?php 
$id = get_queried_object()->ID;
$featid = get_post_meta($id, 'bs_featured_song', true);

if($featid): 
	$song = get_post($featid);
	$url = get_post_meta($id, 'bs_featured_song_embed', true);
	$embed = wp_oembed_get($url, array('width' => '780', 'height' => '585'));

	$title = $song->post_title;
	$arrangers = get_post_meta($song->ID, 'bs_arranger', true);
	$arranger_string = bs_legible_join($arrangers, ", ");
	$soloists = get_post_meta($song->ID, 'bs_soloist', true);
	$soloist_string = bs_legible_join($soloists, ", ");

	$venue = get_post_meta($id, 'bs_featured_song_venue', true);
	?>

	<section class="content content--contiguous-bottom content--contiguous-top content--right">
		<?php echo $embed; ?>
	</section>
	<ul class="sidebar sidebar--left">
			<h2><?php echo $title; ?></h2>
			<p>
				Watch our performance of 
				<?php echo $arranger_string; ?>&rsquo;s
				arrangement of
				<strong><?php echo $feat['post_title']; ?></strong>
				from <?php echo $venue; ?>.
			</p>
			<p>
				<strong>Soloist(s):</strong>
				<?php echo $soloist_string; ?>
			</p>
			<p>
				<a href="https://youtube.com/user/thearistocatswashu/" class="button">Watch more on YouTube&nbsp;&rarr;</a>
			</p>
	</ul>
<?php endif;?>
<section class="content content--contiguous-top">
	<h2>Current Songs</h2>
</section>
	<ul class="song-list">
	<?php query_posts(array(
			'post_type' => 'song',
			'posts_per_page' => -1,
			'orderby' => array('title' => 'ASC')
		));

	while ( have_posts() ) : the_post();
		// skip retired songs 
		$is_retired = (get_post_meta(get_the_ID(), 'bs_song_status', true) == 1);
		if($is_retired) { continue; } 

		$originals = get_post_meta(get_the_ID(), 'bs_original', true);
		$original_string = bs_legible_join($originals, ", ");

		$arrangers = get_post_meta(get_the_ID(), 'bs_arranger', true);
		$arranger_string = bs_legible_join($arrangers, ", ");

		$soloists = get_post_meta(get_the_ID(), 'bs_soloist', true);
		$soloist_string = bs_legible_join($soloists, ", ");
	?>
		<li class="song-list--item">
			<h3><?php the_title(); ?></h3>
			<table class="definition-table">
				<tbody>
					<tr>
						<th class="definition-table__term">Original</th>
						<td class="definition-table__def"><?php echo $original_string; ?></td>
					</tr>
					<tr>
						<th class="definition-table__term">Arrangement</th>
						<td class="definition-table__def"><?php echo $arranger_string; ?></td>
					</tr>
					<?php if($soloist_string): ?>
						<tr>
							<th class="definition-table__term">Soloist</th>
							<td class="definition-table__def"><?php echo $soloist_string; ?></td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</li>
	<?php endwhile; ?>
	</ul>
</section>
<?php get_footer(); ?>