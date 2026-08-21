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
		const resetBtn = document.querySelector('.modal-btn-reset');
		const closeSuccessBtn = document.querySelector('[data-close-success="successModal"]');
		const form = document.getElementById('appointmentForm');
		const dateInput = document.getElementById('appointment_date');
		const timeInput = document.getElementById('appointment_time');

		if (!modal) {
			return;
		}

		// Set default date and time
		setDefaultDateTime();

		// Disable past dates
		disablePastDates();

		// Open modal
		openBtns.forEach((btn) => {
			btn.addEventListener('click', (e) => {
				e.preventDefault();
				setDefaultDateTime();
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

		// Reset form
		resetBtn?.addEventListener('click', (e) => {
			e.preventDefault();
			form.reset();
			setDefaultDateTime();
		});

		// Validate date on input - prevent old dates immediately (mobile compatibility)
		dateInput?.addEventListener('input', function() {
			if (!this.value) return;

			const selectedDate = new Date(this.value + 'T00:00:00');
			const today = new Date();
			today.setHours(0, 0, 0, 0);

			if (selectedDate < today) {
				// Silently reset to today on mobile without alert
				setDefaultDateTime();
			}
		});

		// Validate date on change - reset past dates to today and update time min
		dateInput?.addEventListener('change', function() {
			if (!this.value) return;

			const selectedDate = new Date(this.value + 'T00:00:00');
			const today = new Date();
			today.setHours(0, 0, 0, 0);

			if (selectedDate < today) {
				setDefaultDateTime();
				return;
			}

			// If date is today, set time min to current time; otherwise clear it
			if (selectedDate.getTime() === today.getTime()) {
				const now = new Date();
				const hours = String(now.getHours()).padStart(2, '0');
				const minutes = String(now.getMinutes()).padStart(2, '0');
				timeInput.min = `${hours}:${minutes}`;

				// Reset time if it's now in the past
				if (timeInput.value) {
					const [selectedHours, selectedMinutes] = timeInput.value.split(':').map(Number);
					const selectedTime = new Date(today.getFullYear(), today.getMonth(), today.getDate(), selectedHours, selectedMinutes);
					if (selectedTime < now) {
						timeInput.value = `${hours}:${minutes}`;
					}
				}
			} else {
				// For future dates, allow any time
				timeInput.min = '';
			}
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

		// Validate time on change - prevent selecting past times on today's date
		timeInput?.addEventListener('change', function() {
			if (!this.value || !dateInput.value) return;

			const today = new Date();
			const selectedDate = new Date(dateInput.value + 'T00:00:00');
			const todayDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());

			// Only validate time if date is today
			if (selectedDate.getTime() === todayDate.getTime()) {
				const [hours, minutes] = this.value.split(':').map(Number);
				const selectedTime = new Date(today.getFullYear(), today.getMonth(), today.getDate(), hours, minutes);

				if (selectedTime < today) {
					// Reset to current time
					const currentHours = String(today.getHours()).padStart(2, '0');
					const currentMinutes = String(today.getMinutes()).padStart(2, '0');
					this.value = `${currentHours}:${currentMinutes}`;
				}
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
			// Validate date and time before submission
			if (!isValidDateTime()) {
				e.preventDefault();
				alert('Please select a future date and time for your appointment.');
				return false;
			}
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
		// Reset form before opening
		const form = document.getElementById('appointmentForm');
		if (form) {
			form.reset();
			setDefaultDateTime();
		}

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
	 * Set default date to today and time to current time
	 */
	function setDefaultDateTime() {
		const dateInput = document.getElementById('appointment_date');
		const timeInput = document.getElementById('appointment_time');

		if (dateInput) {
			const today = new Date();
			const year = today.getFullYear();
			const month = String(today.getMonth() + 1).padStart(2, '0');
			const day = String(today.getDate()).padStart(2, '0');
			const todayString = `${year}-${month}-${day}`;

			dateInput.value = todayString;
			dateInput.min = todayString;
			dateInput.max = ''; // Clear any max restriction
		}

		if (timeInput) {
			const now = new Date();
			const hours = String(now.getHours()).padStart(2, '0');
			const minutes = String(now.getMinutes()).padStart(2, '0');
			const currentTimeString = `${hours}:${minutes}`;

			timeInput.value = currentTimeString;
			timeInput.min = currentTimeString; // Prevent selecting past times today
		}
	}

	/**
	 * Disable past dates in date picker
	 */
	function disablePastDates() {
		const dateInput = document.getElementById('appointment_date');

		if (dateInput) {
			const today = new Date();
			const year = today.getFullYear();
			const month = String(today.getMonth() + 1).padStart(2, '0');
			const day = String(today.getDate()).padStart(2, '0');
			const minDate = `${year}-${month}-${day}`;
			dateInput.min = minDate;
		}
	}

	/**
	 * Validate selected date and time
	 */
	function validateDateTime() {
		const dateInput = document.getElementById('appointment_date');
		const timeInput = document.getElementById('appointment_time');

		if (!dateInput || !dateInput.value) {
			return;
		}

		const today = new Date();
		const selectedDate = new Date(dateInput.value + 'T00:00:00');
		const todayDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());

		// If selected date is today, validate time
		if (selectedDate.getTime() === todayDate.getTime()) {
			if (timeInput && timeInput.value) {
				const [hours, minutes] = timeInput.value.split(':').map(Number);
				const selectedTime = new Date(today.getFullYear(), today.getMonth(), today.getDate(), hours, minutes);

				if (selectedTime < today) {
					timeInput.value = '';
					alert('Please select a future time for today.');
				}
			}
		}
	}

	/**
	 * Check if selected date and time is valid (not in past)
	 */
	function isValidDateTime() {
		const dateInput = document.getElementById('appointment_date');
		const timeInput = document.getElementById('appointment_time');

		// If no date selected, let other validation handle it
		if (!dateInput || !dateInput.value) {
			return true;
		}

		const today = new Date();
		const selectedDate = new Date(dateInput.value + 'T00:00:00');
		const todayDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());

		// Check if selected date is in past
		if (selectedDate < todayDate) {
			return false;
		}

		// If selected date is today, check if time is in past
		if (selectedDate.getTime() === todayDate.getTime()) {
			if (!timeInput || !timeInput.value) {
				return true; // Time not required
			}

			const [hours, minutes] = timeInput.value.split(':').map(Number);
			const selectedTime = new Date(today.getFullYear(), today.getMonth(), today.getDate(), hours, minutes);

			if (selectedTime < today) {
				return false;
			}
		}

		return true;
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
