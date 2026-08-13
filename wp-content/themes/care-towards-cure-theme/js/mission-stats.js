/**
 * Care Towards Cure - Mission Stats Counter
 * Animates statistics numbers when they come into view
 */

(function() {
	'use strict';

	/**
	 * Initialize stats counter
	 */
	function initStatsCounter() {
		const statElements = document.querySelectorAll('.mission-stat-value[data-count]');

		if (statElements.length === 0) {
			return;
		}

		// Use Intersection Observer to trigger animation when element is visible
		const observerOptions = {
			threshold: 0.5,
		};

		const observer = new IntersectionObserver((entries) => {
			entries.forEach((entry) => {
				// Only animate once
				if (entry.isIntersecting && !entry.target.dataset.animated) {
					animateCounter(entry.target);
					entry.target.dataset.animated = 'true';
					observer.unobserve(entry.target);
				}
			});
		}, observerOptions);

		statElements.forEach((el) => {
			observer.observe(el);
		});
	}

	/**
	 * Animate a counter from 0 to target value
	 */
	function animateCounter(element) {
		const targetValue = parseInt(element.dataset.count, 10);
		const suffix = element.dataset.suffix || '';
		const duration = 2000; // 2 seconds
		const steps = 60;
		const stepValue = targetValue / steps;
		let currentValue = 0;
		let currentStep = 0;

		const interval = setInterval(() => {
			currentStep++;
			currentValue = Math.floor(stepValue * currentStep);

			// Ensure we don't exceed target
			if (currentValue >= targetValue) {
				currentValue = targetValue;
				clearInterval(interval);
			}

			element.textContent = currentValue + suffix;
		}, duration / steps);
	}

	/**
	 * Initialize on DOM ready
	 */
	function init() {
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', initStatsCounter);
		} else {
			initStatsCounter();
		}
	}

	init();
})();
