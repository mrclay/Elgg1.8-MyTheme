
# MyTheme

You're a new Elgg user ready to customize your site. You may have heard that your customizations should be put in a theme plugin just for your site.

Since Elgg does not ship with one, you're free to use this one.

## Installation

1. Place this folder in `Elgg/mod/` so you have `Elgg/mod/MyTheme/`.
2. Activate this plugin and keep it at the bottom of the plugin list.

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
