<?php

namespace MyThema;

/** スライドショー出力 */
function slideShow(array $list) {
	include(dirname(__DIR__) . '/templates/common/slide-show.php');
};

/** 設定読み込み */
function loadConfig(string $name) {
	return include(dirname(__DIR__) . '/config/' . $name . '.php');
};
