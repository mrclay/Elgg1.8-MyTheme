<?php

class MyTheme {

	protected $viewFilters = array();

	static public function path() {
		return dirname(dirname(__FILE__));
	}

	/**
	 * Extend a view. Your script must be placed in:
	 * MyTheme/views/default/MyTheme/<priority:3>/original/view/name.php
	 *
	 * <code>
	 * $ms->extendView('foo/bar', 1);
	 * // view script must be in views/default/MyTheme/001/foo/bar.php
	 * </code>
	 *
	 * @param string $originalView
	 * @param int $priority
	 */
	public function extendView($originalView, $priority = 500) {
		$priority = round(min(max($priority, 0), 999));
		$priority = str_pad($priority, 3, '0', STR_PAD_LEFT);
		elgg_extend_view($originalView, "MyTheme/$priority/$originalView", $priority);
	}

	/**
	 * @param string $view
	 * @param callable $callable
	 * @return MyTheme
	 */
	public function filterView($view, $callable) {
		if (empty($this->viewFilters[$view])) {
			elgg_register_plugin_hook_handler('view', $view, array($this, 'handleViewHook'), 999);
		}
		$this->viewFilters[$view][] = $callable;
		return $this;
	}

	/**
	 * @param string $hook
	 * @param string $type
	 * @param string $content
	 * @param array $params
	 * @return string
	 * @access private
	 */
	public function handleViewHook($hook, $type, $content, $params) {
		if ($params['viewtype'] === 'default') {
			if (!empty($this->viewFilters[$type])) {
				foreach ($this->viewFilters[$type] as $callable) {
					if (is_callable($callable)) {
						$content = call_user_func($callable, $content, $type, $params);
					}
				}
			}
		}
		return $content;
	}
}
