<?php

function MyTheme_init() {

	$theme = new MyTheme();

	$theme->extendView('js/elgg', 999);
	$theme->extendView('css/elgg', 999);

	//$theme->filterView('foo/bar', 'MyTheme_alter_foo_bar');
}

//function MyTheme_alter_foo_bar($content, $view, $params) {
//	return trim($content);
//}

elgg_register_event_handler('init', 'system', 'MyTheme_init');
