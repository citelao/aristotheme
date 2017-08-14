<?php

// Images and RSS stuff
add_theme_support('post-thumbnails', array('post', 'page')); 
add_theme_support('automatic-feed-links');
add_theme_support('html5');
add_theme_support('title-tag');

// Add smarter image sizes
add_image_size( 'member_thumbnail', 600, 600, true );
add_image_size( 'alumni_thumbnail', 350, 350, true );

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
    wp_enqueue_script('acatsscript', get_template_directory_uri() . '/js/main.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'bs_register_scripts');

// Add a menu
function bs_register_menus() {
  register_nav_menu('main-nav', 'Main Navigation');
  register_nav_menu('home-nav', 'Home Navigation');
  register_nav_menu('social-nav', 'Social Navigation');
}
add_action('init', 'bs_register_menus');

// Add some BEM classes to the nav menus
function bs_add_new_classes($classes, $item){
    $classes[] = 'navigation__item';
    return $classes;
}
add_filter('nav_menu_css_class' , 'bs_add_new_classes' , 10 , 2);


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
        'title' => 'Homepage',
        'pages' => array('post', 'page'),
        'context'  => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => 'Help',
                'id' => 'bs_help',
                'type' => 'custom_html',
                'std' => '<p>These fields customize how this page/post is displayed on the home page if you have added it to the homepage navigation menu.</p>'
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
                'desc' => 'The blurb to display if this is featured on the homepage. Try to keep this short (one or two sentences)'
            )
        )
    );
    $meta_boxes[] = array(
        'title' => 'Templates',
        'pages' => array('page'),
        'context'  => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => 'Help',
                'id' => 'bs_help',
                'type' => 'custom_html',
                'std' => '<p>These fields are targetted at specific page templates, so that you can add dynamic content to other fields not traditionally present on a page.</p><p>So make sure that the fields you fill out correspond to the correct <strong>Template</strong>, under <strong>Page Attributes</strong>, on the right.'
            ),
            array(
                'name' => 'Song-list Page: Featured Song',
                'id' => 'bs_featured_song',
                'type' => 'post',
                'post_type' => 'song',
                'desc' => 'Which song to feature with a video and blurb'
            ),
            array(
                'name' => 'Song-list Page: Featured Song URL',
                'id' => 'bs_featured_song_embed',
                'type' => 'oembed',
                'desc' => 'The embed URL for the featured song.'
            ),
            array(
                'name' => 'Song-list Page: Featured Song Venue',
                'id' => 'bs_featured_song_venue',
                'type' => 'text',
                'desc' => 'The name of the venue where we performed (e.g. "Bella Notte 2015")'
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
                'name' => 'Original Writer',
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
                'desc' => 'The person who will sing this song. Leave blank if there are no soloists. Write "TBD" if currently undetermined.',
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
            )
        )
    );
    return $meta_boxes;
}

// Custom editor buttons
function bs_mce_buttons( $buttons ) { 
    // print_r($buttons);
    return array(
        'styleselect',
        'bold',
        'italic',
        'strikethrough',
        'bullist',
        'numlist',
        'blockquote',
        'seperator',
        'link',
        'unlink',
        'wp_more',
        'fullscreen'
        // 'wp_adv'
    );
}
add_filter('mce_buttons', 'bs_mce_buttons');

// Custom editor styles
function bs_mce_before_init($settings) {
    $style_formats = array(
        array(
            'title' => 'Post Headers',
            'items' => array(
                array(
                    'title' => 'Post Heading',
                    'format' => 'h3'
                ),
                array(
                    'title' => 'Post Subheading',
                    'format' => 'h4'
                )
            )
        ),
        array(
            'title' => 'Page Headers',
            'items' => array(
                array(
                    'title' => 'Page Heading',
                    'format' => 'h2'
                ),
                array(
                    'title' => 'Page Subheading',
                    'format' => 'h3'
                )
            )
        ),
        array(
            'title' => 'Inline',
            'items' => array(
                array(
                    'title' => 'Superscript',
                    'inline' => 'sup',
                    'icon' => 'superscript'
                ),
                array(
                    'title' => 'Subscript',
                    'inline' => 'sub',
                    'icon' => 'subscript'
                )
            )
        )

    );
    //     array(
    //         'title' => 'Button',
    //         'selector' => 'a',
    //         'classes' => 'button'
    //     ),
    //     array(
    //         'title' => 'Callout Box',
    //         'block' => 'div',
    //         'classes' => 'callout',
    //         'wrapper' => true
    //     ),
    //     array(
    //         'title' => 'Bold Red Text',
    //         'inline' => 'span',
    //         'styles' => array(
    //             'color' => '#f00',
    //             'fontWeight' => 'bold'
    //         )
    //     )
    // );
    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
}
add_filter('tiny_mce_before_init', 'bs_mce_before_init');

// Sitemaps!
// https://gist.github.com/lgladdy/10586308
function show_sitemap() {
  if (isset($_GET['show_sitemap'])) {
    $the_query = new WP_Query(array('post_type' => 'any', 'posts_per_page' => '-1', 'post_status' => 'publish'));
    $urls = array();
    while ($the_query->have_posts()) {
      $the_query->the_post();
      $urls[] = get_permalink();
    }
    die(json_encode($urls));
  }
}
add_action('template_redirect','show_sitemap');