JP API MENUS
============
Adds a menu endpoint for the [WordPress REST API](https://wordpress.org/plugins/json-rest-api/).

### Installation
This is not a plugin.

Add `"jp-menu-route": "dev-master"` to your site/plugin/theme's composer.json file. Include composer autoloader.

### Use
Make request to `wp-json/jp-api/menus/` to get info about all menus.

Make request to `wp-json/jp-api/menus/<menu-name>` to get all items of specific menu.

Note that the base URL for the REST API "wp-json" can be modified with a filter. Also this lib's route can be modified using the JP_API_ROUTE constant.

### License, Copyright etc.
Copyright 2014 [Josh Pollock](http://JoshPress.net) Licensed under the terms of the [GNU General Public License version 2](http://www.gnu.org/licenses/gpl-2.0.html) or later. Please share with your neighbor.
