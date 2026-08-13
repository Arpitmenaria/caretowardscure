/**
 * Care Towards Cure - Appointment Modal
 * Handles opening, closing, and form submission for appointment booking
 */

(function() {
	'use strict';

	/**
	 * Initialize appointment modal
	 */
	function initAppointmentModal() {
		const modal = document.getElementById('appointmentModal');
		const successModal = document.getElementById('successModal');
		const openBtns = document.querySelectorAll('[data-open-modal="appointmentModal"]');
		const closeBtn = document.querySelector('.modal-close');
		const cancelBtn = document.querySelector('.modal-btn-cancel');
		const closeSuccessBtn = document.querySelector('[data-close-success="successModal"]');
		const form = document.getElementById('appointmentForm');

		if (!modal) {
			return;
		}

		// Open modal
		openBtns.forEach((btn) => {
			btn.addEventListener('click', (e) => {
				e.preventDefault();
				openModal(modal);
			});
		});

		// Close modal
		closeBtn?.addEventListener('click', () => {
			closeModal(modal);
		});

		cancelBtn?.addEventListener('click', () => {
			closeModal(modal);
		});

		// Close success modal
		closeSuccessBtn?.addEventListener('click', () => {
			closeModal(successModal);
		});

		// Close modal when clicking overlay
		modal.addEventListener('click', (e) => {
			if (e.target === modal) {
				closeModal(modal);
			}
		});

		// Close success modal when clicking overlay
		successModal?.addEventListener('click', (e) => {
			if (e.target === successModal) {
				closeModal(successModal);
			}
		});

		// Handle form submission
		form?.addEventListener('submit', function(e) {
			handleFormSubmit.call(this, e, modal, successModal);
		});

		// Close modal on escape key
		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape' && modal.classList.contains('active')) {
				closeModal(modal);
			}
		});
	}

	/**
	 * Open modal
	 */
	function openModal(modal) {
		modal.classList.add('active');
		document.body.style.overflow = 'hidden';
		// Hide navbar on mobile
		const header = document.querySelector('.site-header');
		if (header) {
			header.style.pointerEvents = 'none';
			header.style.opacity = '0';
		}
	}

	/**
	 * Close modal
	 */
	function closeModal(modal) {
		modal.classList.remove('active');
		document.body.style.overflow = '';
		// Show navbar again
		const header = document.querySelector('.site-header');
		if (header) {
			header.style.pointerEvents = '';
			header.style.opacity = '';
		}
	}

	/**
	 * Handle form submission
	 */
	function handleFormSubmit(e, appointmentModal, successModal) {
		e.preventDefault();

		const formData = new FormData(this);
		const submitBtn = document.querySelector('.modal-btn-submit');
		const form = this;

		// Show loading state
		if (submitBtn) {
			submitBtn.disabled = true;
			submitBtn.textContent = 'Submitting...';
		}

		// Send AJAX request
		fetch(careTheme.ajaxUrl, {
			method: 'POST',
			body: new URLSearchParams({
				action: 'care_inquiry_form',
				nonce: careTheme.nonce,
				patient_name: formData.get('patient_name'),
				phone: formData.get('phone'),
				email: formData.get('email') || '',
				appointment_date: formData.get('appointment_date') || '',
				appointment_time: formData.get('appointment_time') || '',
				reason: formData.get('reason') || '',
				country_code: '+91',
			}),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					// Reset form
					form.reset();
					// Close appointment modal
					closeModal(appointmentModal);
					// Show success modal
					openModal(successModal);
				} else {
					alert('Error: ' + (data.data?.message || 'Failed to submit inquiry'));
				}
			})
			.catch((error) => {
				console.error('Error:', error);
				alert('An error occurred. Please try again.');
			})
			.finally(() => {
				// Reset button state
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.textContent = 'Submit Inquiry';
				}
			});
	}

	/**
	 * Initialize on DOM ready
	 */
	function init() {
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', initAppointmentModal);
		} else {
			initAppointmentModal();
		}
	}

	init();
})();
