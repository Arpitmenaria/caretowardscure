/**
 * Doctor Profile Show More/Less
 * Handles expand/collapse functionality for doctor cards
 */

(function() {
	'use strict';

	function initDoctorProfiles() {
		const doctorCards = document.querySelectorAll('.doctor-card');

		doctorCards.forEach(card => {
			const bio = card.querySelector('.doctor-bio');
			const toggleBtn = card.querySelector('.doctor-show-more-btn');

			if (!bio || !toggleBtn) return;

			// Check if text is long enough to show button
			const bioText = bio.textContent || '';
			if (bioText.length <= 150) {
				toggleBtn.style.display = 'none';
				return;
			}

			// Set initial state
			bio.classList.add('collapsed');
			const fullHeight = bio.scrollHeight;
			bio.style.maxHeight = '150px';

			// Toggle functionality
			toggleBtn.addEventListener('click', function(e) {
				e.preventDefault();

				if (bio.classList.contains('collapsed')) {
					// Expand
					bio.classList.remove('collapsed');
					bio.style.maxHeight = fullHeight + 'px';
					toggleBtn.textContent = 'Show Less';
				} else {
					// Collapse
					bio.classList.add('collapsed');
					bio.style.maxHeight = '150px';
					toggleBtn.textContent = 'Show More';
				}
			});
		});
	}

	// Initialize on DOM ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initDoctorProfiles);
	} else {
		initDoctorProfiles();
	}
})();
