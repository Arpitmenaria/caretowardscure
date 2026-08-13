(function() {
	'use strict';

	function initScrollReveal() {
		const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		const revealElements = document.querySelectorAll('[data-reveal]');

		if (revealElements.length === 0) {
			return;
		}

		if (prefersReducedMotion) {
			revealElements.forEach(el => {
				el.classList.add('is-visible');
			});
			return;
		}

		const observerOptions = {
			threshold: 0.1,
			rootMargin: '0px 0px -100px 0px'
		};

		const observer = new IntersectionObserver((entries) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					observer.unobserve(entry.target);
				}
			});
		}, observerOptions);

		revealElements.forEach(el => {
			observer.observe(el);
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initScrollReveal);
	} else {
		initScrollReveal();
	}
})();
