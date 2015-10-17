<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(''); ?></title>

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

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

    <?php wp_head(); ?>
</head>
<body <?php body_class( $class ); ?>>
<div class="wrapper">
	<!--[if lt IE 10]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

	TODO skip to content

	<header>
		<?php if(is_home()): ?>
			<h1>The Aristocats</h1>
		<?php else: ?>
			<?php // get the header image

			$attachment = get_post_meta(get_queried_object()->ID, 'bs_header_image', true);
			$img = wp_get_attachment_image_src($attachment, 'full');
			?>
			<h1><?php single_post_title(); ?></h1>
			<img height="100" src="<?php echo $img[0]; ?>">
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
