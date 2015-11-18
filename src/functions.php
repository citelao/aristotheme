<?php

// Images and RSS stuff
add_theme_support('post-thumbnails', array('post', 'page')); 
add_theme_support('automatic-feed-links');
add_theme_support('title-tag');

function bs_legible_join($array) {
    if(!is_array($array)) {
        return "";
    }

    $rtn = "";
    foreach($array as $key => $value) {
        if($key == count($array) - 1) {
            $rtn .= str_replace(" ", "&nbsp;", $value);
        } elseif($key == count($array) - 2) {
            $rtn .= str_replace(" ", "&nbsp;", $value) . " &amp; ";
        } else {
            $rtn .= str_replace(" ", "&nbsp;", $value) . ", ";
        }
    }

    return $rtn;
}

// Scripts
function bs_register_scripts() {
    // wp_enqueue_script('textfit', get_template_directory_uri() . '/bower_components/');
}
add_action('wp_enqueue_scripts', 'bs_register_scripts');

// Add a menu
function bs_register_menus() {
  register_nav_menu('main-nav', 'Main Navigation');
  register_nav_menu('home-nav', 'Home Navigation');
}
add_action('init', 'bs_register_menus');

// Add a sidebar
add_action('widgets_init', 'bs_register_sidebars');
function bs_register_sidebars() {
    register_sidebar(array(
        'name' => 'Default sidebar',
        'id' => 'bs-sidebar',
        'description' => 'The default sidebar, shown on all pages and posts.',
        'before_widget' => '<li id="%1$s" class="widget sidebar__widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>'
    ));
}

// Make members and song types
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
        'public' => true,
        'menu_icon' => 'dashicons-smiley',
        'supports' => array('thumbnail', 'title')
    ));

    register_post_type('song', array(
        'label' => 'Songs',
        'labels' => array(
            'name_admin_bar' => 'Song',
            'add_new_item' => 'Add New Song',
            'edit_item' => 'Edit Song',
            'new_item' => 'New Song',
            'view_item' => 'View Song',
            'search_items' => 'Search songs',
            'not_found' => 'No songs found',
            'not_found_in_trash' => 'No songs found in trash'
            ),
        'description' => 'A song we sing or sang',
        'show_ui' => true,
        'menu_icon' => 'dashicons-controls-play',
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
            // array(
            //     'name' => 'Header Image',
            //     'id' => 'bs_header_image',
            //     'type' => 'image_advanced',
            //     'desc' => 'Which image to use as the header background.'
            // ),
            array(
                'name' => 'Alternate title',
                'id' => 'bs_alt_title',
                'type' => 'text',
                'size' => 60,
                'desc' => 'An alternate title to display when the page is viewed.'
            ),
            array(
                'name' => 'Homepage Image',
                'id' => 'bs_featured_image',
                'type' => 'image_advanced',
                'desc' => 'Which image to use as background when featured on homepage. Note, this is not the "header" image. That\'s on the right: the "featured image."'
            ),
            array(
                'name' => 'Homepage title',
                'id' => 'bs_featured_title',
                'type' => 'text',
                'size' => 60,
                'desc' => 'An alternate title to display if this is featured on the homepage.'
            ),
            array(
                'name' => 'Homepage summary',
                'id' => 'bs_featured_summary',
                'type' => 'wysiwyg',
                'size' => 60,
                'desc' => 'The blurb to display if this is featured on the homepage.'
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
                'name' => 'Last Name',
                'id' => 'bs_member_lastname',
                'type' => 'text',
                'size' => 60,
                'std' => '',
                'desc' => 'Member\'s last name (for sorting)'
            ),
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
                'std' => 'none',
                'desc' => '(optional) The role this member has (music director, etc); no role: `none`'
            ),
            array(
                'name' => 'Status',
                'id' => 'bs_member_status',
                'type' => 'checkbox',
                'desc' => 'Is alum?'
            )
        )
    );
    $meta_boxes[] = array(
        'title' => 'Info',
        'id' => 'bs_info',
        'pages' => array('song'),
        'context'  => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => 'Original',
                'id' => 'bs_original',
                'type' => 'text',
                'size' => 60,
                'desc' => 'The writers of the original song',
                'clone' => true
            ),
            array(
                'name' => 'Arranger',
                'id' => 'bs_arranger',
                'type' => 'text',
                'size' => 60,
                'desc' => 'The person who arranged this song',
                'clone' => true
            ),
            array(
                'name' => 'Soloists',
                'id' => 'bs_soloist',
                'type' => 'text',
                'size' => 60,
                'desc' => 'The person who will sing this song. Leave blank if there are no soloists.',
                'clone' => true
            ),
            array(
                'name' => 'Link',
                'id' => 'bs_link',
                'type' => 'text',
                'size' => 60,
                'desc' => '(optional) A link to the song.'
            ),
            array(
                'name' => 'Status',
                'id' => 'bs_song_status',
                'type' => 'checkbox',
                'desc' => 'Is retired?'
            ),
            array(
                'name' => 'Featured',
                'id' => 'bs_song_featured',
                'type' => 'checkbox',
                'desc' => 'Is featured? Only the first featured song gets featured.'
            ),
        )
    );
    return $meta_boxes;
}