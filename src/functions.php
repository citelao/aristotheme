<?php

// Add a menu
function register_menus() {
  register_nav_menu('main-nav', 'Main Navigation');
}
add_action( 'init', 'register_menus' );

// Add some BEM classes to the nav
function add_new_classes($classes, $item){
	$classes[] = 'navigation__item';
	return $classes;
}
add_filter('nav_menu_css_class' , 'add_new_classes' , 10 , 2);

// Add a default Title
function baw_hack_wp_title_for_home( $title )
{
  if(empty( $title ) && (is_home() || is_front_page())) {
    return get_bloginfo('title');
  }
  return $title;
}
add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );