/**
 * Care Towards Cure Theme - Main JavaScript
 * Handles interactions and functionality for the theme
 */

(function() {
	'use strict';

	/**
	 * Mobile Menu Toggle
	 */
	function initMobileMenu() {
		const toggleBtn = document.getElementById('mobile-menu-toggle');
		const nav = document.getElementById('main-navigation');

		if (!toggleBtn || !nav) {
			return;
		}

		toggleBtn.addEventListener('click', function() {
			const isActive = nav.classList.toggle('active');
			toggleBtn.setAttribute('aria-expanded', isActive ? 'true' : 'false');
		});

		// Close menu when a link is clicked
		const menuLinks = nav.querySelectorAll('.navbar-link');
		menuLinks.forEach(link => {
			link.addEventListener('click', function() {
				nav.classList.remove('active');
				toggleBtn.setAttribute('aria-expanded', 'false');
			});
		});

		// Close menu when clicking outside
		document.addEventListener('click', function(event) {
			const isClickInsideNav = nav.contains(event.target);
			const isClickOnToggle = toggleBtn.contains(event.target);

			if (!isClickInsideNav && !isClickOnToggle && nav.classList.contains('active')) {
				nav.classList.remove('active');
				toggleBtn.setAttribute('aria-expanded', 'false');
			}
		});
	}

	/**
	 * Smooth Scroll for Anchor Links
	 */
	function initSmoothScroll() {
		document.querySelectorAll('a[href^="#"]').forEach(anchor => {
			anchor.addEventListener('click', function(e) {
				const href = this.getAttribute('href');

				// Ignore empty anchors and modal triggers
				if (href === '#' || this.getAttribute('data-open-modal')) {
					return;
				}

				const target = document.querySelector(href);
				if (!target) {
					return;
				}

				e.preventDefault();

				const headerHeight = 107;
				const targetPosition = target.getBoundingClientRect().top + window.scrollY - headerHeight - 5;

				window.scrollTo({
					top: targetPosition,
					behavior: 'smooth'
				});

				// Update active navbar link
				updateActiveNavLink(href);

				// Close mobile menu if open
				const nav = document.getElementById('main-navigation');
				if (nav && nav.classList.contains('active')) {
					nav.classList.remove('active');
					const toggleBtn = document.getElementById('mobile-menu-toggle');
					if (toggleBtn) {
						toggleBtn.setAttribute('aria-expanded', 'false');
					}
				}
			});
		});
	}

	/**
	 * Update Active Navigation Link Based on Scroll
	 */
	function updateActiveNavLink(targetId) {
		const navLinks = document.querySelectorAll('.navbar-link');
		navLinks.forEach(link => {
			link.classList.remove('active');
		});

		const activeLink = document.querySelector(`.navbar-link[href="${targetId}"]`);
		if (activeLink) {
			activeLink.classList.add('active');
		}
	}

	/**
	 * Highlight Navigation Link on Scroll
	 */
	function initScrollSpyNavigation() {
		const sections = document.querySelectorAll('section[id]');
		const navLinks = document.querySelectorAll('.navbar-link');

		if (sections.length === 0) return;

		function updateActiveLink() {
			let currentSection = '';
			const headerHeight = 107;

			sections.forEach(section => {
				const sectionTop = section.offsetTop;

				if (window.scrollY >= sectionTop - headerHeight - 100) {
					currentSection = section.getAttribute('id');
				}
			});

			navLinks.forEach(link => {
				link.classList.remove('active');
				if (link.getAttribute('href') === `#${currentSection}`) {
					link.classList.add('active');
				}
			});
		}

		window.addEventListener('scroll', updateActiveLink, { passive: true });
		updateActiveLink();
	}

	/**
	 * Lazy Load Images
	 */
	function initLazyLoad() {
		if ('IntersectionObserver' in window) {
			const imageObserver = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						const img = entry.target;
						if (img.dataset.src) {
							img.src = img.dataset.src;
							img.removeAttribute('data-src');
						}
						imageObserver.unobserve(img);
					}
				});
			});

			document.querySelectorAll('img[data-src]').forEach(img => {
				imageObserver.observe(img);
			});
		}
	}

	/**
	 * Add Active State to Navigation Menu
	 */
	function initActiveMenuState() {
		// Active state is now handled by scroll spy
	}

	/**
	 * Handle Form Submissions with Loading State
	 */
	function initFormHandling() {
		const forms = document.querySelectorAll('form');

		forms.forEach(form => {
			form.addEventListener('submit', function() {
				const submitBtn = this.querySelector('button[type="submit"]');
				if (submitBtn) {
					const originalText = submitBtn.textContent;
					submitBtn.disabled = true;
					submitBtn.textContent = 'Processing...';

					// Restore button after request completes
					setTimeout(() => {
						submitBtn.disabled = false;
						submitBtn.textContent = originalText;
					}, 2000);
				}
			});
		});
	}

	/**
	 * Print Page Styles
	 */
	function initPrintStyles() {
		const style = document.createElement('style');
		style.textContent = `
			@media print {
				.site-header,
				.site-footer,
				.mobile-menu-toggle,
				#inquiry-modal {
					display: none !important;
				}
			}
		`;
		document.head.appendChild(style);
	}

	/**
	 * Image Loading Placeholder
	 */
	function initImageLoadingPlaceholder() {
		const images = document.querySelectorAll('img');

		images.forEach(img => {
			// Skip if image is already loaded
			if (img.complete) {
				img.classList.add('loaded');
				return;
			}

			// Add loaded class when image finishes loading
			img.addEventListener('load', function() {
				this.classList.add('loaded');
			});

			// Handle error - still remove placeholder
			img.addEventListener('error', function() {
				this.classList.add('loaded');
			});
		});
	}

	/**
	 * Add scroll shadow to header
	 */
	function initHeaderShadow() {
		const header = document.querySelector('.site-header');
		if (!header) {
			return;
		}

		let ticking = false;
		function updateHeaderOnScroll() {
			const scrolled = window.scrollY > 10;
			if (scrolled) {
				header.classList.add('scrolled');
			} else {
				header.classList.remove('scrolled');
			}
			ticking = false;
		}

		window.addEventListener('scroll', function() {
			if (!ticking) {
				window.requestAnimationFrame(updateHeaderOnScroll);
				ticking = true;
			}
		}, { passive: true });

		updateHeaderOnScroll();
	}

	/**
	 * Initialize All Features
	 */
	function init() {
		// Wait for DOM to be fully loaded
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', function() {
				initMobileMenu();
				initSmoothScroll();
				initScrollSpyNavigation();
				initLazyLoad();
				initActiveMenuState();
				initFormHandling();
				initPrintStyles();
				initImageLoadingPlaceholder();
				initHeaderShadow();
			});
		} else {
			initMobileMenu();
			initSmoothScroll();
			initScrollSpyNavigation();
			initLazyLoad();
			initActiveMenuState();
			initFormHandling();
			initPrintStyles();
			initImageLoadingPlaceholder();
			initHeaderShadow();
		}
	}

	// Initialize when script loads
	init();
})();
