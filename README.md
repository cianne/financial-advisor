# RWP - Financial Theme

Version: 1.0

## Author:

RecommendWP

## Summary

RWP - Financial Theme is a based on [Boilerplate for Genesis](https://bitbucket.org/webdevsuperfast/boilerplate-for-genesis). It comes bundled with the latest [Developer Bundle](https://bitbucket.org/webdevsuperfast/developer-bundle) plugin.

### Deployment

You can skip this step if you prefer old-school CSS code. Check out the `Installation` instruction for it.

* Clone repository
* Install dependencies
    * [Ruby](http://rubyinstaller.org/)
    * [Node.js](https://nodejs.org/)
    * [Compass](http://compass-style.org)
    * ~~[Breakpoint](http://breakpoint-sass.com/)~~
* Open Command Line and run `npm install` to install gulp and dependencies.
* Run `bower install` to install packages.
* Run `gulp` to compile scripts and stylesheet.

### Installation

* Clone/download files from Bitbucket repository.
* Rename extracted folder to match your theme name.
* Copy/extract/upload to WordPress themes folder.
* If you don't want to use Gulp replace `style.css` with `temp/css/style.css`, `assets/js/app.min.js` with `temp/js/app.js` and `assets/js/vendor.min.js` with `temp/js/vendor.js` to use the uncompressed files.

### Features

1. Compass, SCSS, LESS
2. Easy to customize
3. Gulp
4. Child theme tweaks
    * WordPress `head` cleanup
    * Before Footer Hook `mb_before_footer`
    * Before Footer Widget Area Hook `mb_before_footer_widget_area`
    * Additional widget areas
    * Many more...
5. ~~Built-in SuperCPT support~~
6. Built-in Vafpress Theme Options Framework support
7. Built-in TGM Plugin Activation support
8. ~~Built-in Pushy Off-Canvas Navigation support~~
9. [WP-LESS](https://github.com/sanchothefat/wp-less) support
10. Theme Updater using [GitHub Updater](https://github.com/afragen/github-updater)
11. [AniJS](http://anijs.github.io/) support
12. ~~[Font Awesome](https://fortawesome.github.io/) support~~
13. Responsive videos using [FitVids](http://fitvidsjs.com/)
14. CSS animations using [Animate.css](https://daneden.github.io/animate.css/)
15. [Developer Bundle](https://bitbucket.org/webdevsuperfast/developer-bundle) without installing the plugin.
16. The bloat.
17. [Velocity JS](http://julian.com/research/velocity/) support
18. Additonal SiteOrigin Widgets Bundle widgets
	* Accordion Widget
	* Image Carousel Widget
	* Popup Widget
19. [Octicons](https://octicons.github.com) support

### Scripts

The theme comes bundled with the following scripts which comes default with the `Boilerplate for Genesis` theme, `Developer Bundle` plugin and theme-specific widgets based on `SiteOrigin Widgets Bundle` widget framework.

* [Modernizr](http://modernizr.com/)
* [Velocity JS](http://julian.com/research/velocity/)
* [AniJS](http://anijs.github.io/)
* [FitVids](http://fitvidsjs.com/)
* [Packery](http://packery.metafizzy.co/)
* [EasyTabs](http://os.alfajango.com/easytabs/)
* [Fancybox](http://fancybox.net/)
* [Own Carousel](http://owlgraphic.com/owlcarousel/)

### Suggested Plugins

The plugins below are already added into the [TGM Plugin Activation](http://tgmpluginactivation.com/) script. Just install them after activating the theme.

* [Page Builder by SiteOrigin](https://wordpress.org/plugins/siteorigin-panels/)
* [SiteOrigin Widgets Bundle](https://wordpress.org/plugins/so-widgets-bundle/)
* [GitHub Updater](https://github.com/afragen/github-updater)

### Update

[Octicons](https://octicons.github.com) is now the default icon font replacing [Font Awesome](https://fortawesome.github.io/Font-Awesome/) but you can change it back in `assets/scss/partials/_partials.scss` if you wish to get back to Font-Awesome.

### Credits

Without these projects, this WordPress Genesis Starter Child Theme wouldn't be where it is today.

* [Genesis Framework](http://my.studiopress.com/themes/genesis/)
* [SASS / SCSS](http://sass-lang.com/)
* [Less](http://lesscss.org/)
* [Compass](http://compass-style.org)
* [Gulp](http://gulpjs.com/)
* [Bower](https://github.com/bower/bower)
* ~~[Page Builder by SiteOrigin](https://wordpress.org/plugins/siteorigin-panels/)~~
* ~~[SiteOrigin Widgets Bundle](https://wordpress.org/plugins/so-widgets-bundle/)~~
* ~~[SuperCPT](https://wordpress.org/plugins/super-cpt/)~~
* [Vafpress](https://github.com/vafour/vafpress-framework-plugin)
* ~~[Pushy](https://github.com/christophery/pushy)~~
* [WP-Less](https://github.com/sanchothefat/wp-less)
* [TGM Plugin Activation](http://tgmpluginactivation.com/)
* ~~[Font Awesome](https://fortawesome.github.io/Font-Awesome/)~~
* [Animate.css](https://daneden.github.io/animate.css/)
* [FitVids](http://fitvidsjs.com/)
* [AniJS](http://anijs.github.io/)
* ~~[Velocity JS](http://julian.com/research/velocity/)~~
* [Octicons](https://octicons.github.com)
