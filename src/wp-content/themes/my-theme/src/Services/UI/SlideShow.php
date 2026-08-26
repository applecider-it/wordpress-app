<?php

namespace MyTheme\Services\UI;

class SlideShow {
	public static function slideShow(array $list) {
		include(dirname(dirname(dirname(__DIR__))) . '/templates/common/slide-show.php');
	}
}
