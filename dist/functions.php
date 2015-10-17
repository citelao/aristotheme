<?php
// We depend on them, makes our lives easier
require_once('Custom-Meta-Boxes/custom-meta-boxes.php');

// Add a menu
function bs_register_menus() {
  register_nav_menu('main-nav', 'Main Navigation');
}
add_action( 'init', 'bs_register_menus' );

// Add some BEM classes to the nav
function bs_add_new_classes($classes, $item){
    $classes[] = 'navigation__item';
    return $classes;
}
add_filter('nav_menu_css_class' , 'bs_add_new_classes' , 10 , 2);

// Add a default title
function baw_hack_wp_title_for_home($title) {
  if(empty( $title ) && (is_home() || is_front_page())) {
    return get_bloginfo('title');
  }
  return $title;
}
add_filter('wp_title', 'baw_hack_wp_title_for_home');

// Add image box for posts and pages
add_filter('rwmb_meta_boxes', 'bs_register_meta_boxes');
function bs_register_meta_boxes($meta_boxes){
    $meta_boxes[] = array(
        'title' => 'Header',
        'id' => 'bs_header',
        'pages' => array('post', 'page'),
        'context'  => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => 'Header Image',
                'id' => 'bs_header_image',
                'type' => 'image_advanced',
                'desc' => 'Which image to use as the header background.'
            )
            // array(
            //     'name' => 'Post Image',
            //     'id' => 'bs_post_image',
            //     'type' => 'image_advanced',
            //     'desc' => 'Which image to use in '
            // )
        )
    );
    return $meta_boxes;
}