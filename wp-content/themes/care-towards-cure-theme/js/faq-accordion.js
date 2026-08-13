(function() {
	'use strict';

	function initFAQAccordion() {
		const faqCards = document.querySelectorAll('.faq-card');

		if (faqCards.length === 0) {
			return;
		}

		faqCards.forEach(card => {
			const question = card.querySelector('.faq-question');
			const answer = card.querySelector('.faq-answer');

			if (!question || !answer) {
				return;
			}

			question.style.cursor = 'pointer';
			question.setAttribute('role', 'button');
			question.setAttribute('tabindex', '0');
			question.setAttribute('aria-expanded', 'false');

			const toggle = function(e) {
				if (e.type === 'keydown' && e.key !== 'Enter' && e.key !== ' ') {
					return;
				}

				e.preventDefault();

				const isOpen = card.classList.contains('is-open');
				card.classList.toggle('is-open');
				question.setAttribute('aria-expanded', !isOpen);
			};

			question.addEventListener('click', toggle);
			question.addEventListener('keydown', toggle);
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initFAQAccordion);
	} else {
		initFAQAccordion();
	}
})();
