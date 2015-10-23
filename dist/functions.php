<?php

// RSS stuff
add_theme_support('automatic-feed-links');

// Add a menu
function bs_register_menus() {
  register_nav_menu('main-nav', 'Main Navigation');
}
add_action( 'init', 'bs_register_menus' );

function bs_register_posts() {
    register_post_type('member', array(
            'label' => 'Members',
            'labels' => array(
                'name_admin_bar' => 'Member',
                'add_new_item' => 'Add New Member',
                'edit_item' => 'Edit Member',
                'new_item' => 'New Member',
                'view_item' => 'View Member',
                'search_items' => 'Search members',
                'not_found' => 'No members found',
                'not_found_in_trash' => 'No members found in trash'
                ),
            'description' => 'A member or alum of the group',
            'show_ui' => true,
            'menu_icon' => 'dashicons-smiley',
            'supports' => array('thumbnail', 'title')
        ));
}
add_action( 'init', 'bs_register_posts' );

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

// Add image box for posts and pages and members
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
            ),
            array(
                'name' => 'Alternate title',
                'id' => 'bs_alt_title',
                'type' => 'text',
                'size' => 60,
                'desc' => 'An alternate title to display when the page is read.'
            )
        )
    );
    $meta_boxes[] = array(
        'title' => 'Info',
        'id' => 'bs_info',
        'pages' => array('member'),
        'context'  => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => 'Image',
                'id' => 'bs_member_image',
                'type' => 'image_advanced',
                'desc' => 'A hi-res (>500px square) image to use in the member list.'
            ),
            array(
                'name' => 'Role',
                'id' => 'bs_member_role',
                'type' => 'text',
                'size' => 60,
                'desc' => '(optional) The role this member has (music director, etc)'
            ),
            array(
                'name' => 'Status',
                'id' => 'bs_member_status',
                'type' => 'checkbox',
                'desc' => 'Is alum?'
            )
        )
    );
    return $meta_boxes;
}