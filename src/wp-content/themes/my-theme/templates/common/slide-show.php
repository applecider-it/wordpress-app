<?php

/** @var array $list */
?>

<div class="swiper-container swiper-container1">
	<div class="swiper swiper1">
		<div class="swiper-wrapper">
			<?php foreach ($list as $val): ?>
				<div class="swiper-slide">
					<Image src="<?= esc_html($val) ?>" alt="" class="mx-auto" />
				</div>
			<?php endforeach; ?>
		</div>

		<div class="swiper-pagination swiper-pagination1"></div>
	</div>
</div>