/**
 * Care Towards Cure - Services Horizontal Scroll
 * Handles scrolling navigation for services cards
 */

(function() {
	'use strict';

	/**
	 * Initialize services scroll
	 */
	function initServicesScroll() {
		const scrollContainer = document.querySelector('.services-grid');
		const prevBtn = document.querySelector('.services-scroll-btn.prev');
		const nextBtn = document.querySelector('.services-scroll-btn.next');

		if (!scrollContainer || !prevBtn || !nextBtn) {
			return;
		}

		// Scroll amount (one card width + gap)
		const getScrollAmount = () => {
			const card = scrollContainer.querySelector('.service-card');
			if (!card) return 0;
			return card.offsetWidth + 20; // gap is 20px
		};

		// Scroll left
		prevBtn.addEventListener('click', () => {
			scrollContainer.scrollBy({
				left: -getScrollAmount(),
				behavior: 'smooth'
			});
		});

		// Scroll right
		nextBtn.addEventListener('click', () => {
			scrollContainer.scrollBy({
				left: getScrollAmount(),
				behavior: 'smooth'
			});
		});

		// Handle keyboard navigation
		scrollContainer.addEventListener('keydown', (e) => {
			if (e.key === 'ArrowLeft') {
				e.preventDefault();
				prevBtn.click();
			} else if (e.key === 'ArrowRight') {
				e.preventDefault();
				nextBtn.click();
			}
		});

		// Update button visibility based on scroll position
		const updateButtonState = () => {
			const isAtStart = scrollContainer.scrollLeft <= 0;
			const isAtEnd = scrollContainer.scrollLeft >=
				scrollContainer.scrollWidth - scrollContainer.clientWidth - 10;

			prevBtn.style.opacity = isAtStart ? '0.5' : '1';
			prevBtn.style.cursor = isAtStart ? 'not-allowed' : 'pointer';
			nextBtn.style.opacity = isAtEnd ? '0.5' : '1';
			nextBtn.style.cursor = isAtEnd ? 'not-allowed' : 'pointer';
		};

		scrollContainer.addEventListener('scroll', updateButtonState);
		window.addEventListener('resize', updateButtonState);
		updateButtonState();
	}

	/**
	 * Initialize on DOM ready
	 */
	function init() {
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', initServicesScroll);
		} else {
			initServicesScroll();
		}
	}

	init();
})();
