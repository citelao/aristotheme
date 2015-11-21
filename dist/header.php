<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- TODO: Make all this dynamic -->
    <meta name="description" content="The Washington University Aristocats wreak havoc and sing Disney music at Washington University in St. Louis. Listen to our music &amp; join us!">
    <meta name="og:title" content="The Washington University Aristocats">
    <meta name="og:description" content="The Washington University Aristocats wreak havoc and sing Disney music at Washington University in St. Louis. Listen to our music &amp; join us!">
    <meta name="og:site_name" content="The Washington University Aristocats">
    <meta name="og:see_also" content="http://aristocats.wustl.edu/">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@WashUAristocats">
    <meta name="twitter:title" content="The Washington University Aristocats">
    <meta name="twitter:description" content="The Washington University Aristocats wreak havoc and sing Disney music at Washington University in St. Louis. Listen to our music &amp; join us!">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,400|Crimson+Text:400,400italic,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

    <?php wp_head(); ?>
</head>
<body <?php body_class( $class ); ?>>
<div class="wrapper">
	<!--[if lt IE 10]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

	<a href="#content" class="skip-to-content">Skip to content</a>
	
	<?php // get the header image

	$attachment = get_post_thumbnail_id(get_queried_object()->ID);
	$img = wp_get_attachment_image_src($attachment, 'full');
    if(!$img && is_singular('post')) {
        if (get_option('show_on_front')=='page') {
          $page_id = get_option('page_for_posts');
          $page = get_post($page_id);
        } else {
          $page = false;
        }
        $attachment = get_post_thumbnail_id($page->ID);
        $img = wp_get_attachment_image_src($attachment, 'full');
    }
	$style = '';
    $class = 'header';
	if($img) {
		$style = 'background-image: url(' . $img[0] . ')';
        $class .= ' header--bleed';
	}

    if(is_front_page()) {
        $class .= ' header--jumbo';
    }

	?>
	<header style="<?php echo $style; ?>" class="<?php echo $class; ?>">
		<?php if(is_front_page()): ?>
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/header/logo.svg" alt="The Aristocat typographic logo, with the phrase 'The Aristocats a cappella' written out in a style similar to the Disney logo" class="header__logo">
		<?php elseif(is_page() || is_home()): ?>
			<h1 class="header__title"><?php single_post_title(); ?></h1>
        <?php elseif(is_singular('post')): ?>
            <h1 class="header__title">news</h1>
        <?php elseif(is_search()): ?>
            <h1 class="header__title">Search results</h1>
        <?php else: ?>
            <h1 class="header__title">Oops...</h1>
		<?php endif; ?>
	</header>

	<nav class="navigation" id="nav">
		<button id="nav-toggler" class="navigation__hamburger">Menu</button>
		<?php wp_nav_menu(array(
			'container' => 'false',
			'menu_class' => 'navigation__list',
			'theme_location' => 'main-nav'
		)); ?>
	</nav>

    <section class="main" id="content">