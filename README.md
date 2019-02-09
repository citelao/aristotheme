# The Aristocats Wordpress Template

License is proprietary because I don't want to take the time to find one.

## Install

For an in-depth installation guide, see **Ground-up installation**, below.

If you already know how to install Wordpress and get it going, you just need to know that Aristotheme uses `gulp` to compile all the `src/` files into a true theme in `dist/`. That `dist/` folder needs to be symlinked into `wp-content/themes/<somewhere>`.

The theme expects a static front page and will probably fail otherwise.

The theme has three nav menus, 2 are surely necessary, 1 IDK:

- **Main nav**: the traditional navigation links at the top.
- **Home nav**: this controls which pages appear as homepage content. The first item here is full-width and the second two are half-width. They should all be pages. Actual configuration can be done on the pages themselves.
- **Social nav**: the social nav links in the footer.

1. Symlink `dist/` into your WP themes directory.
2. `npm install && bower install && brew install graphicsmagick` to get dependencies.
3. Install necessary plugins, via the WP dashboard.
	* Meta Box plugin (metabox.io)
	* Simple Page Sidebars (wordpress.org/plugins/simple-page-sidebars)
4. Setup a front page (Admin page > Settings > Reading). Create a Home page and a News page. None of the content from either is used.
5. Add the navigation menus (Admin page > Appearance > Menus). Make sure you add all three, or you won't be using the theme to the fullest!
6. Create custom sidebars for each page (Admin page > Appearance > Widgets to create them, the page editor to apply them to specific pages).

    1. Create a sidebar for the page (on the Widgets page).
    2. Open the page editor for the page you want.
    3. On the right side of the page, select your sidebar from the dropdown.
    4. Update the page.

    I like to create a flow, so the "About Us" page suggests going to the "Music" or "Audition" pages, for example. I usually use the simple Text widget and add custom HTML: you can add buttons by using the `button` class (`<a href="/music" class="button">Learn about us →</a>`).
    
    I like the blog section to have a blog-style sidebar, with search and some recent posts: 
    
    1. Create a "news sidebar"
    2. Click the `Sidebar Location` button.
    3. Apply it to be the default sidebar for all posts: check `As Default sidebar for selected Post Types` and make sure it is the default for `Posts`.
    4. Apply it to be the default sidebar for the blog homepage: in the `For Archives` section, check `As Default sidebar for selected Archive Types` for `Post Index`. If you try to manually set it on the blog page in the page editor, you will see these instructions, too :D.
 
I used Menu Icons (https://wordpress.org/plugins/menu-icons/) for (you guessed it!) menu icons.

Because load times are important, also install CW Image Optimizer. You need to install littleutils for it to work properly. The instructions on the plugin site are good (https://wordpress.org/plugins/cw-image-optimizer/installation/).

## Development & Building

`gulp` or `gulp serve` will compile the theme into `dist/`.

`gulp` is one-off.

`gulp serve` will watch the `src/` directory for changes.

## TODO

- The instructions presume local gulp. I need to run `npm install --save-dev gulp babel-core`. If you get build errors, run `npm install babel-core gulp`.

## Ground-up installation

To get a Wordpress installation running locally, I prefer to use a VM & Vagrant to orchestrate it:

### Start up the VM!

1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](https://www.vagrantup.com/docs/installation/).
2. Download [ScotchBox](https://box.scotch.io/) (my favorite configuration for Vagrant).
3. Run `vagrant up` in the newly downloaded ScotchBox folder. This will start a new VM that can run Wordpress! When it's completed, you can browse to [http://192.168.33.10](http://192.168.33.10) and you should see a welcome page.

ScotchBox automatically hosts (on 192.168.33.10) any files in the `public/` directory in the ScotchBox folder you downloaded. If you added `test.html` with some content and browsed to `192.168.33.10/test.html` you would see its content.

### Install Wordpress on VM!

1. Download [Wordpress](https://wordpress.org/). It's just a bunch of PHP files.
2. Move these files to `public/` or `public/wordpress`. I like keeping them in `public/`, but make sure you rename the existing `index.php` to something you'll remember, like `index.scotch.php`, so you can access it in the next step.
3. Begin configuring Wordpress. If Wordpress's `index.php` is in `public/`, start the process by going to `192.168.33.10`. If it's in `public/wordpress`, go to `192.168.33.10/wordpress`.
4. Find the Database access information on the ScotchBox welcome page (I told you it would be useful :D) and finish the installation process.

### Add the theme!

Because of the way Aristotheme builds, you need to do some shenanigans.

1. Clone this repository.
2. Create an alias/shortcut to this folder and keep it somewhere easy to find, since you're about to bury the real file.
3. Place this folder somewhere within ScotchBox. I like next to `Vagrantfile` and `publics/`.
4. `vagrant ssh`
5. Cd to `/var/www/`. You should see all the same directories mirrored, including this one.
6. Create a symlink from the Aristotheme `dist/` folder to a new directory in `public/(wordpress?)/wp-content/themes/`. I like `aristotheme`. You may have to use an absolute path for the source directory: `ln -s /var/www/(whatever_you_called_this_repo)/dist /var/www/public/(wordpress?)/wp-content/themes/aristotheme`, with `(whatever_you_called_this_repo)` replaced with this folder's name and `(wordpress?)` replaced with `wordpress` if you installed Wordpress in a sub-directory in `publics/`. You're creating a link from the themes folder into this folder so that Wordpress can use your compiled files.
7. Activate the theme from Wordpress!
8. Add a static front page in Wordpress Settings
9. Add menus (Admin page > Appearance > Menus). See **Install** above for more information.

You should now see a vaguely Acats-looking site.

### Begin development

1. Install [Node.js](https://nodejs.org/en/)
2. Install [Gulp](https://gulpjs.com/) (`npm install --global gulp-cli`). This is the build tool Aristotheme uses.
3. Install [Bower](https://bower.io/) (`npm install -g bower`). This helps with some package management.
4. Install GraphicsMagick or ImageMagick for image minification via [gm](https://aheckmann.github.io/gm/) (`brew install graphicsmagick`).
4. In the theme directory (with `src/` and `dist/`), run `npm install && bower install`. This installs all the packages we need to develop the theme.
5. When everything is finished, you can now run `gulp serve` or `gulp` to develop: `gulp` will compile everything from `src/` into `dist/` once; `gulp serve` will monitor `src/` for changes and compile all changes into `dist/`.
6. Begin working! Change `src/`, recompile `dist/` (or have it automatically compile with `gulp serve`). Do not change `dist/` directly.

I would love to see your changs as PRs in this GitHub project!
