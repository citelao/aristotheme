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

<section class="content content--contiguous-bottom content--contiguous-top content--right">
	<iframe width="780" height="406.6875" src="https://www.youtube.com/embed/F4ICMxmSLBc" frameborder="0" allowfullscreen="" data-aspect="1.7777777777777777"></iframe>
</section>
<ul class="sidebar sidebar--left">
	<h2>(title)</h2>
	<p>(description)</p>
	<p>
		<a href="https://youtube.com/user/thearistocatswashu/" class="button">Watch more on YouTube&nbsp;&rarr;</a>
	</p>
</ul>
<section class="content content--contiguous-top">
	<h2>Current Songs</h2>
</section>
	<ul class="song-list">
	<?php query_posts(array(
			'post_type' => 'song',
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