/**
 * Partner Logo Auto-Loader
 * Automatically loads partner logos from centralized PARTNERS database
 *
 * Usage in HTML:
 * <div data-partner="insajder"></div>
 * <div data-partner="qpr" data-css="custom-class another-class"></div>
 */

(function() {
    'use strict';

    /**
     * Initialize partner logo loading
     */
    function initPartnerLogos() {
        // Find all elements with data-partner attribute
        const partnerElements = document.querySelectorAll('[data-partner]');

        partnerElements.forEach(element => {
            const partnerKey = element.getAttribute('data-partner');
            const partner = getPartner(partnerKey);

            if (!partner) {
                console.warn(`Partner not found: ${partnerKey}`);
                return;
            }

            // Get custom CSS classes if specified
            const customCss = element.getAttribute('data-css') || 'max-h-16 w-auto object-contain';

            // Create img element
            const img = document.createElement('img');
            img.src = partner.logo;
            img.alt = partner.name;
            img.className = customCss;

            // Copy any inline styles from parent
            const inlineStyle = element.getAttribute('data-style');
            if (inlineStyle) {
                img.setAttribute('style', inlineStyle);
            }

            // Clear element and append img
            element.innerHTML = '';
            element.appendChild(img);
        });
    }

    /**
     * Render multiple partners dynamically
     * @param {string} containerId - ID of container element
     * @param {string[]} partnerKeys - Array of partner keys to render
     * @param {string} cssClass - CSS classes for images
     * @param {string} wrapperClass - CSS classes for wrapper divs
     */
    function renderPartners(containerId, partnerKeys, cssClass = 'max-h-16 w-auto object-contain', wrapperClass = '') {
        const container = document.getElementById(containerId);
        if (!container) {
            console.warn(`Container not found: ${containerId}`);
            return;
        }

        container.innerHTML = '';

        partnerKeys.forEach(key => {
            const partner = getPartner(key);
            if (!partner) {
                console.warn(`Partner not found: ${key}`);
                return;
            }

            const wrapper = document.createElement('div');
            if (wrapperClass) {
                wrapper.className = wrapperClass;
            }

            const img = document.createElement('img');
            img.src = partner.logo;
            img.alt = partner.name;
            img.className = cssClass;

            wrapper.appendChild(img);
            container.appendChild(wrapper);
        });
    }

    /**
     * Render partners by category
     * @param {string} containerId - ID of container element
     * @param {string} category - Category to filter ('media', 'sports', 'featured', 'all')
     * @param {string} cssClass - CSS classes for images
     * @param {string} wrapperClass - CSS classes for wrapper divs
     */
    function renderPartnersByCategory(containerId, category, cssClass = 'max-h-16 w-auto object-contain', wrapperClass = '') {
        const partners = getPartnersByCategory(category);
        const partnerKeys = Object.keys(partners);
        renderPartners(containerId, partnerKeys, cssClass, wrapperClass);
    }

    // Expose functions globally
    window.initPartnerLogos = initPartnerLogos;
    window.renderPartners = renderPartners;
    window.renderPartnersByCategory = renderPartnersByCategory;

    // Auto-initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPartnerLogos);
    } else {
        initPartnerLogos();
    }
})();
