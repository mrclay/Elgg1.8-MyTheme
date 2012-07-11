# MyTheme

This is an empty Elgg theme plugin in which you can put CSS/JS/HTML customizations for your site.

### Why do I need this?

Are you a new Elgg user eager to start customizing your site's look? You may be tempted (or even told) to jump in and modify core files; [Don't Do This](http://community.elgg.org/pages/view/880143/dont-modify-core)! Instead, install this plugin and make your modifications in it.

## Installation

### Without git

1. [Download a copy](https://github.com/mrclay/Elgg1.8-MyTheme/downloads) of this repository in your format of choice.
2. Extract the archive
3. Rename the folder from `Elgg1.8-MyTheme` to `MyTheme`
4. Move the `MyTheme` directory into `/path/to/Elgg/mod`, so that this file is at: `/path/to/Elgg/mod/MyTheme/README.md`
5. In Elgg's admin panel plugins page, activate "My Theme". Make sure it stays at the bottom of the plugin list after activating new plugins.

### With git

1. `$ cd /path/to/Elgg/mod`
2. `$ git clone https://github.com/mrclay/Elgg1.8-MyTheme.git MyTheme`
3. `$ rm -rf MyTheme/.git` (optional step)
4. In Elgg's admin panel plugins page, activate "My Theme". Make sure it stays at the bottom of the plugin list after activating new plugins.

## Where to put things

### CSS

Add CSS to `./views/default/MyTheme/999/css/elgg.php`.

### JS

Add JavaScript to `./views/default/MyTheme/999/js/elgg.php`.

### Language strings

You can override English strings in `./languages/en.php`.

## How to alter views

### Overriding (replacing) a view

Place a copy of the view script (and its directory path) into `./views/default/`. E.g. when overriding a view named `foo/bar`, you'll end up with `./views/default/foo/bar.php`.

### Extending (prepending or appending) a view

Elgg imposes no convention on extension view locations, but it's wise to follow one. This plugin's init function `MyTheme_init()` offers a simple wrapper to `elgg_extend_view()` which sets the extension view based on the original view's name and priority:

> The extending view name is always prepended with `MyTheme/###/`, where `###` is the extension priority, left-padded with zeroes to 3 digits.

E.g., `$theme->extendView('foo/bar', 60)` would cause Elgg to use this file for extending the `foo/bar` view:

 `./views/default/MyTheme/060/foo/bar.php`.

### Filtering a view's output

After rending a view, Elgg passes the output through the hook `['view', $view_name]`. MyTheme offers a streamlined API for setting up a handler as a filter:

```php
function MyTheme_init() {
    ...
    $theme->filterView('foo/bar', 'MyTheme_filter_foo_bar');
    ...
}

function MyTheme_filter_foo_bar($content, $view_name, $view_params) {
	return trim($content);
}
```
