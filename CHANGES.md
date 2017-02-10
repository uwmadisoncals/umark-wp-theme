CHANGES

### 2.0.0-beta-4

* Fixes nexted list markup in footer contacts
* Fixes two-colum layout horizintal spacing bug

### 2.0.0-beta-3

* Fixes aria-hidden value for menu container on window load and resize

### 2.0.0-beta-2

* Fixes responsive search input that moves the search input from to the first menu item and vice-versa above and below the main menu breakpoint (640px)

### 2.0.0-beta-1

* Major update of the UW theme


## Below needs editing and cleanup

The following are very rough, unoprganized notes about what changes from the original theme. Short answer: a lot!

Header

- header.php and footer.php HTML strcture has changed; child themes will need to adjust accordingly
  - removed custom.css -- use a child theme or add this via functions enque_styles or manually
  - replaced hgroup with .uw-header-title

Main
- <div id="main"> replaced with <main id="#main">

Footer
- Introduced theme options for email, phone social accounts etc
- Reduced optional widget areas from 3 to 2

Menus
- we recommend avoiding dropdown menus if possible in your site's information architecture. 
- dropdown menus are now trigger on click instead of hover
  - this mean your main menu item will not go to the page assigned
  - you'll need to add that page as the first item in your dropdown menu (e.g. labeled "Main" or "Overview")


Theme Options Removed
- no more theme options; uses only WP Customizer now
  - theme modifications are stored individually instead of in an array
  - remove the uwmadison_get_default_theme_options() function; use get_theme_mod instead

Removes UW_Madison_Ephemera_Widget 

New customizations
- page background color
- top navbar colors
- show search in header or not

Page templates
- Drop the template named Sidebar Template
- Drop the Showcase page template

Theme template parts
- Remove post format content partial templates (which were not being used in old theme). All post formats display the same.


functions.php
- Moved theme options body_class filter into functions' uwmadison_body_classes filter and renamed this function set_uwmadison_body_classes. This function applies the uwmadison_body_classes filter
- uwmadison_javascripts renamed uwmadison_frontend_assets for enquing CSS and JS
  - minified CSS enqueued by default
  - define WP_ENV to be 'development' to enqueue unminifief CSS with sourcemapping embedded (don't do this in production because the file is big!)
- removed output_uw_wordpress_banner() function

single.php
- moved previous and next post navigation from before post content to after post content; also removed all styling for #nav-single

Internationalization
- The theme does not currently support internationalization for translating into other languages. Though Wordpress's internationalization functions are partially (and inconsistently) implemented, more work would need to be done in order to formally support internationalization. This will be done if the need is identified.

Requires Wordpress 4.1+
- for title-tag theme support
