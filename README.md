
This theme evolved out of the original UW–Madison theme that was first released in 2011. It represents a substantial rewrite of that theme (see Changes section below), adopting current best practices in WordPress theme development, as well as CSS, Javascript, HTML and accessibility. This theme offers a solid, responsive design solution out of the box.

## Using The Theme

The theme is still in development (and versioned as a beta release) but is available for download and testing. (It is being used in a couple production sites: Commencement and Campus Climate.)

After downloading and unzipping the theme, install it in your site’s themes folder and activate through your admin dashboard.

### Using A Child Theme

If you want to extend the theme, it’s best to use a child theme. See the WordPress documentation for Child Themes.

### Customizing the Theme Options

Use WordPress’s Customize screen to set options for the theme. The options that can be set include:

**Colors and Typography:** You can switch between a light grey or white page background. You can flip-flop the red and white background colors of the top global menu bar and the main menu bar. The theme uses the Verlag font face, which is now widely used in campus communications, most notably on wisc.edu. The theme will eventually include the Verlag font files once the purchasing of license has been completed. For now, the Customize screen describes how to turn on Verlag for your site. (University Marketing recommends waiting until the font files are packaged with the theme, which should happen by the end of May depending on the university purchasing process being completed.)

**Header:** The header options allow you to include a search input in your header. The search is the default WordPress search solution. We recommend using search only if your site has more than 50 pages. You can also set a “hero” image (see this demo site’s home page for example) for your site’s home page.

**Layout:**  You can pick between three layout options for your site: two-column with a sidebar on the right or left or one-column (no sidebar). If you choose a two-column layout, the sidebar can be excluded on a page-by-page basis by checking the Include sidebar option in the Page options box when posting a page. The content of your sidebar will be the same across the site. The default content includes the standard WordPress widgets as seen on this demo site. Sidebar widgets can be added, removed and rearranged through the Widgets section in the Customize screen.

**Menus:** The theme supports up to three different menus areas out of the box: the main menu, the secondary menu (which appears in the top menu bar) and two footer menus (which appear as lists of links in the footer under a heading corresponding to the menu name.) The Main and Secondary menus support one level of child, dropdown menus (though we recommend avoiding dropdown menus altogether if possible and instead trying to define a site information architecture that clearly leads your users through your site’s content hierarchy.) See below for more details about setting footer menus.

**Widgets:** There is one “widgetized” area in this theme: the sidebar. By default, the sidebar will use some of WordPress’s standard widgets (e.g. Meta, Archives, Blogroll). Widgets can be added, removed or rearranged to suit your needs. (The Custom Menu widget can be a handy way to add a list or lists of links to your sidebar.)

**Static Front Page:** This exposed WordPress’s built-in option for choosing a page you publish to serve as the front page of your site (instead of showing your most recent posts, which is the default). You first publish a page with content you want to include and then select that page through this option.

**Footer:** The footer options allow you to set an email and phone number, as well as a variety of social media URLs that will appear in your site’s footer. You can also specify up to two footer menus. You first need to create the menus in the menu manager (the menu name you choose will be used as the header in the menu) and then select them in the Footer options. It’s best to include between 4-8 items in each menu if you use them.

## Developing With the Theme

Web developers who use the theme can work with it in a number of different ways:

### As A Child Theme

As with any WordPress theme, you can create a child theme if you want to extend or override its functionality beyond what is possible using the theme customizer. See the WordPress documentation for Child Themes for documentation. The theme does provide a few hooks (see WordPress docs) that might be useful:

**uwmadison_body_classes filter:** Allows you to add additional classes to the <body> element for use in your CSS and JS.

**uwmadison_footer_contacts filter:** Allows you to override or extend the content that appears under the Contact Us header in the footer. E.g. if you needed to show a fax address or a different social media account.

**uw_hero_image filter:** Allows you to override the default markup used for the hero image if one is set in the theme Customizer.

**Aria_Walker_Nav_Menu class filters:** The menu walker class includes several filter, not specific to this theme, that allow you to override various aspects of how the menus are output.

If you have suggestions for additional filters or action hooks, please contact us or consider contributing to the theme’s development (see below).

### Customizing CSS

CSS customizations should be done within a child theme. The theme’s source code (not included with the zip download) includes the Sass files used to compile the theme’s CSS. If you’re working with the source code (see below), you can selectively compile in the theme’s source Sass as needed (including variables and a limited number of mixins). The theme’s source includes a Bower dependency for UW Style which is a set of Sass files and some Javascript that University Marketing is developing for use in any website or web app. This will be documented more in the future; for now, please direct questions to wordpress@umark.wisc.edu.

### Building a local environment

Install npm packages:

```
npm install
```

Install Bower packages:

```
bower install
```

To develop against the theme, you'll need to install it in a local Wordpress project. You can either git clone the theme into your local environment's *themes* directory or clone it elsewhere and symlink it inside the *themes* directory.

The Sass files for the theme can be found inside `assets/scss`. The packaged Gruntfile watches these files plus the Sass files inside bower_components/uw-style/assets/scss (the uw-style project is installed by bower; it includes Sass files used for common UW components).


## Changes

### See per-release changes listed under this project's *Tags* view

### Major changes from the 2011 theme

To come...


## Contributing To The Project

### Reporting Issues And Requesting Features

Please use the GitLab Issues tool inside the project to report issues and/or feature requests.

### Contributing Code

We welcome contributions to the code. To contribute, fork the repository, create a branch for your contribution, make and commit your code changes, push your branch to git.doit.wisc.edu and them make a merge request when you are ready. Please try to first submit an issue and let us know you’d like to work on it before submitting the merge request. Please keep merge requests as focused as possible. Let us know if you have questions by emailing wordpress@umark.wisc.edu.