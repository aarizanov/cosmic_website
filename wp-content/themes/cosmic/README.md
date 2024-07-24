Cosmic Development Website
===

This is a custom made theme for Cosmic Development Website. It's based upon [underscores](https://underscores.me/) (  `underscores` or `_s` ) theme by [Automattic](https://automattic.com/). 

Css is partitioned and located in `/sass` folder.
JS files are located in `/js` folder.
Images are in `/img` folder. 

 **Vendor** files are located in `/vendor` folder. Vendor files used are:
* [Font Awesome Pro](https://fontawesome.com/) v.5.3 - As Font icons.
* [Slick Slider](http://kenwheeler.github.io/slick/) v.1.9.0 - For sliders.
* [Theia Sticky Sidebar](https://github.com/WeCodePixels/theia-sticky-sidebar) v.1.7.0 - For sticky sidebar, used on single posts.
* [Fancybox](http://fancyapps.com/fancybox/3/) v.3.5.1 - For lightbox like image animations.

**Plugin** activation is handled by [TGM Plugin Activation](http://tgmpluginactivation.com/).  Plugins shipped with the theme are located in `/inc/TGM-Plugin-Activation/plugins/` folder, and are activated in `/inc/TGM-Plugin-Activation/required_plugins.php` file. Plugins included in the theme are:
* [WP Bakery Page Builder](https://wpbakery.com/) - As primary page builder. This plugin is **required** in order for theme to function and style properly. 

* [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) - For all metadata requirements. Although the theme will function without ACF, it's highly recommended to install it. Without it no metadata will be shown.

Important Plugin Notices
---------------

[WP Bakery Page Builder](https://wpbakery.com/) ( formerly Visual Composer ) is required for theme to function. All of the custom grid functionalities are pulled from the plugin css file, and enqueued in functions.php.
**Custom widget classes**  are all located in `/inc/vc/` folder, and included in `/inc/vc/widgets.php`. 

[Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) plugin data is located in `/acf-json/` folder.  **All the field modifications should be done in wp-admin area**, as they are automatically saved as .json files in acf-json folder.  

Getting Started
---------------
Build scripts are included in the theme, and are handled via [npm](https://www.npmjs.com/). After theme installation please run **`npm install`** to install required dependencies.
After the npm has done it's work, you can run `npm run watch` to run watcher tasks which include:
1. Sass compiling ( all of the files inside of `/sass/` folder are compiled to the main `style.css` file )
2. Js minification ( all of the files inside of `/js/` folder are separately minified and stored in `/js/dist/` folder. )

Now you're ready to go! The next step is easy to say, but harder to do: make an awesome theme. :)

Good luck!
