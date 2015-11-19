<?php get_header(); ?>
<ul class="content">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
		<li class="post">
			<?php 
				$attachment = get_post_thumbnail_id();
				$img = wp_get_attachment_image_src($attachment, 'full')[0];
			?>
			<!-- <img src="<?php echo $img; ?>" alt="" class="content__image"> -->
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p><?php the_content(''); ?></p>
			<a class="post__more" href="<?php the_permalink(); ?>" title="Read <?php the_title_attribute(); ?>">Read more&hellip;</a>
		</li>
	<?php endwhile; else : ?>
		<li>
			<h2>No results for &ldquo;<?php echo get_search_query(); ?>&rdquo;</h2>
			<p>
				The post you're looking for might have been deleted (oops!). I would suggest going <a href="/">home</a> or <a href="/contact/">contacting us</a> about the problem.
			</p>
			<p>Here's a gif instead:</p>
			<img src="<?php bloginfo('template_directory'); ?>/img/error/didney.gif" />
			<p>
				<cite>(<a href="http://perel.tumblr.com/">Yotam Perel</a> via Giphy)</cite>
			</p>
		</li>
 	<?php endif; ?>
 	<?php posts_nav_link('', '&laquo; Newer posts', 'Older posts &raquo;'); ?>
</ul>
<ul class="sidebar">
	<?php dynamic_sidebar('bs-sidebar'); ?>
</ul>
<?php get_footer(); ?>