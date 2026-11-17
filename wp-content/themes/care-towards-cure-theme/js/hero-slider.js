/**
 * Hero Slider
 *
 * Lightweight dependency-free carousel for the front page hero.
 * Supports autoplay, arrows, dots, keyboard navigation and touch swipe.
 *
 * @package Care_Towards_Cure_Theme
 */

(function () {
	'use strict';

	var AUTOPLAY_DELAY = 5000;
	var SWIPE_THRESHOLD = 50;

	function initSlider(slider) {
		var track = slider.querySelector('.hero-slider-track');
		var slides = slider.querySelectorAll('.hero-slide');
		var prevBtn = slider.querySelector('.hero-slider-prev');
		var nextBtn = slider.querySelector('.hero-slider-next');
		var dots = slider.querySelectorAll('.hero-slider-dot');

		if (!track || slides.length === 0) {
			return;
		}

		var total = slides.length;
		var current = 0;
		var timer = null;
		var touchStartX = 0;
		var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		function render() {
			track.style.transform = 'translateX(-' + current * 100 + '%)';

			for (var i = 0; i < slides.length; i++) {
				// Keep off-screen slides out of the accessibility tree.
				slides[i].setAttribute('aria-hidden', i === current ? 'false' : 'true');
			}

			for (var d = 0; d < dots.length; d++) {
				dots[d].setAttribute('aria-current', d === current ? 'true' : 'false');
			}
		}

		function goTo(index) {
			current = (index + total) % total;
			render();
		}

		function next() {
			goTo(current + 1);
		}

		function prev() {
			goTo(current - 1);
		}

		function stop() {
			if (timer) {
				window.clearInterval(timer);
				timer = null;
			}
		}

		function start() {
			// A single slide needs no rotation, and reduced-motion users opt out.
			if (total < 2 || reduceMotion) {
				return;
			}

			stop();
			timer = window.setInterval(next, AUTOPLAY_DELAY);
		}

		function restart() {
			stop();
			start();
		}

		if (nextBtn) {
			nextBtn.addEventListener('click', function () {
				next();
				restart();
			});
		}

		if (prevBtn) {
			prevBtn.addEventListener('click', function () {
				prev();
				restart();
			});
		}

		for (var d = 0; d < dots.length; d++) {
			(function (index) {
				dots[index].addEventListener('click', function () {
					goTo(index);
					restart();
				});
			})(d);
		}

		// Keyboard support when the slider has focus.
		slider.addEventListener('keydown', function (event) {
			if (event.key === 'ArrowLeft') {
				event.preventDefault();
				prev();
				restart();
			} else if (event.key === 'ArrowRight') {
				event.preventDefault();
				next();
				restart();
			}
		});

		// Pause while the visitor is interacting with the slider.
		slider.addEventListener('mouseenter', stop);
		slider.addEventListener('mouseleave', start);
		slider.addEventListener('focusin', stop);
		slider.addEventListener('focusout', start);

		// Touch swipe.
		slider.addEventListener('touchstart', function (event) {
			touchStartX = event.changedTouches[0].screenX;
			stop();
		}, { passive: true });

		slider.addEventListener('touchend', function (event) {
			var delta = event.changedTouches[0].screenX - touchStartX;

			if (Math.abs(delta) > SWIPE_THRESHOLD) {
				if (delta < 0) {
					next();
				} else {
					prev();
				}
			}

			start();
		}, { passive: true });

		// Don't rotate in a background tab.
		document.addEventListener('visibilitychange', function () {
			if (document.hidden) {
				stop();
			} else {
				start();
			}
		});

		render();
		start();
	}

	document.addEventListener('DOMContentLoaded', function () {
		var sliders = document.querySelectorAll('.hero-slider');

		for (var i = 0; i < sliders.length; i++) {
			initSlider(sliders[i]);
		}
	});
})();
