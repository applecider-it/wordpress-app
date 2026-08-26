<?php

namespace MyTheme;

class UI {
	/** スライドショー出力 */
	public static function slideShow(array $list) {
		include(dirname(__DIR__) . '/templates/common/slide-show.php');
	}
}
