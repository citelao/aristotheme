# The Aristocats Wordpress Template

License is proprietary because I don't want to take the time to find one.

## Install

Typically run a `npm install` and a `bower install`. Your Wordpress needs the Meta Box plugin (metabox.io) and Simple Page Sidebars (wordpress.org/plugins/simple-page-sidebars). Just install them in the WP dashboard.

I used Menu Icons (https://wordpress.org/plugins/menu-icons/) for ... menu icons.

Because load times are important, also install CW Image Optimizer. You need to install littleutils for it to work properly. The instructions on the plugin site are good (https://wordpress.org/plugins/cw-image-optimizer/installation/).

## Building

`gulp` or `gulp serve` will compile the theme into `dist/`. I usually symlink that to my `wp-content/themes/` folder.