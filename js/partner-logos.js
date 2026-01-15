/**
 * Centralized Partner Logos Configuration
 * Single source of truth for all partner logos across the website
 *
 * EDIT THIS FILE TO:
 * - Add new partners
 * - Update partner logo URLs
 * - Remove partners
 * - Change partner categories
 *
 * All pages reference partners by their key (e.g., 'insajder', 'qpr')
 * and pull the logo URL from this file automatically.
 */

const PARTNERS = {
    // ==========================================
    // MEDIA PARTNERS
    // ==========================================
    'insajder': {
        name: 'Insajder',
        logo: 'https://app-works.app/images/appworksPartners/Featured/Insajder.png',
        url: '#',
        category: 'media',
        featured: true // Shows on homepage
    },
    'politika': {
        name: 'Politika',
        logo: 'https://app-works.app/images/Politika.png',
        url: '#',
        category: 'media',
        featured: true
    },
    'dan': {
        name: 'DAN',
        logo: 'https://app-works.app/images/dan.png',
        url: '#',
        category: 'media',
        featured: true
    },
    'vecer': {
        name: 'Večer',
        logo: 'https://app-works.app/images/Večer.png',
        url: '#',
        category: 'media',
        featured: true
    },
    'media24': {
        name: 'Media 24',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/logo-dark.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'hrt': {
        name: 'HRT',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/hrvatska-radiotelevizija-logo.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'rts': {
        name: 'RTS',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/rts-3-logo.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'ringier': {
        name: 'Ringier',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/ringier-logo-1.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'n1': {
        name: 'N1',
        logo: 'https://app-works.app/images/appworksPartners/Featured/N1.png',
        url: '#',
        category: 'media',
        featured: true
    },
    'dpg': {
        name: 'DPG Media',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/324194622-572648424721395-1863643511798102048-n.jpg?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'euronews': {
        name: 'Euronews',
        logo: 'https://app-works.app/images/appworksPartners/Featured/Euronews.png',
        url: '#',
        category: 'media',
        featured: true
    },
    'danas': {
        name: 'Danas',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/danas-tamniji-logo.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'hanza-media': {
        name: 'Hanza Media',
        logo: 'https://app-works.app/images/appworksPartners/Featured/Hanza Media.png',
        url: '#',
        category: 'media',
        featured: true
    },
    'nova-s': {
        name: 'Nova S',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/nova-serbia.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'rtcg': {
        name: 'RTCG',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/rtcg-logo-1767170390.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'wmg': {
        name: 'WMG',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/wmg-logo-pozitiv-1-2-1.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'vijesti': {
        name: 'Vijesti',
        logo: 'https://app-works.app/images/appworksPartners/Featured/Vijesti.png',
        url: '#',
        category: 'media',
        featured: true
    },
    'tanjug': {
        name: 'Tanjug',
        logo: 'https://app-works.app/images/appworksPartners/Featured/Tanjug.png',
        url: '#',
        category: 'media',
        featured: true
    },
    'sat': {
        name: 'SAT Media',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/images-4-removebg-preview-1.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'krik': {
        name: 'KRIK',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/krik-logo-serbia-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'dnevnik': {
        name: 'Dnevnik',
        logo: 'https://app-works.app/images/appworksPartners/Media/Dnevnik.jpg',
        url: '#',
        category: 'media',
        featured: false
    },
    'mozzart': {
        name: 'Mozzart',
        logo: 'https://app-works.app/images/appworksPartners/Media/Mozzart.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'hrvatski-telekom': {
        name: 'Hrvatski Telekom',
        logo: 'https://app-works.app/images/appworksPartners/Media/Hrvatski telekom.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'fraktura': {
        name: 'Fraktura',
        logo: 'https://app-works.app/images/appworksPartners/All/Fraktura.jpg',
        url: '#',
        category: 'media',
        featured: false
    },
    'ipsos': {
        name: 'IPSOS',
        logo: 'https://app-works.app/images/appworksPartners/Media/IPSOS.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'fonet': {
        name: 'FONET',
        logo: 'https://app-works.app/images/appworksPartners/Media/FONET.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'oslobodjenje': {
        name: 'Oslobođenje',
        logo: 'https://app-works.app/images/appworksPartners/Media/Oslobodjenje.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'financial-afrik': {
        name: 'Financial Afrik',
        logo: 'https://app-works.app/images/appworksPartners/Media/Financial Afrik.jpg',
        url: '#',
        category: 'media',
        featured: false
    },
    'newsmax': {
        name: 'Newsmax',
        logo: 'https://app-works.app/images/appworksPartners/Media/newsmax.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'geopoetika': {
        name: 'Geopoetika',
        logo: 'https://app-works.app/images/appworksPartners/All/Geopoetika.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'motus-media': {
        name: 'Motus Media',
        logo: 'https://app-works.app/images/appworksPartners/Media/Motus Media.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'fena': {
        name: 'FENA',
        logo: 'https://app-works.app/images/appworksPartners/Media/FENA.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'boom93': {
        name: 'Boom 93',
        logo: 'https://app-works.app/images/appworksPartners/Media/boom 93.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'anem': {
        name: 'ANEM',
        logo: 'https://app-works.app/images/appworksPartners/Media/ANEM.jpg',
        url: '#',
        category: 'media',
        featured: false
    },
    'pc-press': {
        name: 'PC Press',
        logo: 'https://app-works.app/images/appworksPartners/Media/PC Press.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'alo': {
        name: 'ALO',
        logo: 'https://app-works.app/images/appworksPartners/Media/ALO.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'telegraf': {
        name: 'Telegraf',
        logo: 'https://app-works.app/images/appworksPartners/Media/telegraf.jpg',
        url: '#',
        category: 'media',
        featured: false
    },
    'tocka': {
        name: 'Točka',
        logo: 'https://app-works.app/images/appworksPartners/Media/Tocka.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'telesport': {
        name: 'Telesport',
        logo: 'https://app-works.app/images/appworksPartners/Media/Telesport.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'nedeljnik': {
        name: 'Nedeljnik',
        logo: 'https://app-works.app/images/appworksPartners/Media/nedeljnik-logo.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'astra': {
        name: 'Astra',
        logo: 'https://app-works.app/images/appworksPartners/Media/astra-logo.png',
        url: '#',
        category: 'media',
        featured: false
    },

    // ==========================================
    // SPORTS PARTNERS
    // ==========================================
    'qpr': {
        name: 'Queens Park Rangers',
        logo: 'https://app-works.app/images/appworksPartners/Featured/QPR.png',
        url: '#',
        category: 'sports',
        featured: true
    },
    'esake': {
        name: 'ESAKE',
        logo: 'https://app-works.app/images/appworksPartners/Featured/ESAKE.png',
        url: '#',
        category: 'sports',
        featured: true
    },
    'fk-partizan': {
        name: 'FK Partizan',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/fk-partizan-logo.png?crop=true',
        url: '#',
        category: 'sports',
        featured: true
    },
    'hks': {
        name: 'HKS',
        logo: 'https://app-works.app/images/appworksPartners/Featured/HKS.png',
        url: '#',
        category: 'sports',
        featured: true
    },
    'cedevita': {
        name: 'Cedevita Olimpija',
        logo: 'https://app-works.app/images/appworksPartners/Featured/Cedevita.png',
        url: '#',
        category: 'sports',
        featured: true
    },
    'pao': {
        name: 'Panathinaikos',
        logo: 'https://app-works.app/images/appworksPartners/Featured/PAO.png',
        url: '#',
        category: 'sports',
        featured: true
    },
    'leeds': {
        name: 'Leeds United',
        logo: 'https://app-works.app/images/appworksPartners/Featured/Leeds.png',
        url: '#',
        category: 'sports',
        featured: true
    },
    'ksbih': {
        name: 'KS BiH',
        logo: 'https://app-works.app/images/appworksPartners/Sports/KSBIH.png',
        url: '#',
        category: 'sports',
        featured: false
    },
    'peristeri': {
        name: 'Peristeri',
        logo: 'https://app-works.app/images/appworksPartners/Sports/Peristeri.png',
        url: '#',
        category: 'sports',
        featured: false
    },
    'hrs': {
        name: 'HRS',
        logo: 'https://app-works.app/images/appworksPartners/Sports/HRS.png',
        url: '#',
        category: 'sports',
        featured: false
    },
    'savez-skolski-sport': {
        name: 'Savez za školski sport',
        logo: 'https://app-works.app/images/appworksPartners/Sports/Savez za skolski sport.png',
        url: '#',
        category: 'sports',
        featured: false
    },
    'futsal-partizan': {
        name: 'Futsal Partizan',
        logo: 'https://app-works.app/images/appworksPartners/Sports/futsal-partizan-logo.png',
        url: '#',
        category: 'sports',
        featured: false
    },
};

// ==========================================
// HELPER FUNCTIONS
// ==========================================

/**
 * Get partner data by key
 * @param {string} key - Partner identifier key (e.g., 'insajder', 'qpr')
 * @returns {object|null} - Partner object or null if not found
 */
function getPartner(key) {
    return PARTNERS[key] || null;
}

/**
 * Get partner logo URL by key
 * @param {string} key - Partner identifier key
 * @returns {string} - Full URL to partner logo, or empty string if not found
 */
function getPartnerLogo(key) {
    return PARTNERS[key]?.logo || '';
}

/**
 * Get partner name by key
 * @param {string} key - Partner identifier key
 * @returns {string} - Partner display name
 */
function getPartnerName(key) {
    return PARTNERS[key]?.name || '';
}

/**
 * Get all partners
 * @returns {object} - All partners object
 */
function getAllPartners() {
    return PARTNERS;
}

/**
 * Get partners by category
 * @param {string} category - Category name ('media', 'sports', 'featured', or 'all')
 * @returns {object} - Filtered partners object
 */
function getPartnersByCategory(category) {
    if (category === 'featured') {
        // Return only featured partners (homepage)
        return Object.fromEntries(
            Object.entries(PARTNERS).filter(([key, data]) => data.featured === true)
        );
    } else if (category === 'media' || category === 'sports') {
        // Return partners by category
        return Object.fromEntries(
            Object.entries(PARTNERS).filter(([key, data]) => data.category === category)
        );
    }

    // Return all partners
    return PARTNERS;
}

/**
 * Render partner logo as HTML
 * @param {string} key - Partner key
 * @param {string} cssClass - Optional CSS classes for the img tag
 * @returns {string} - HTML img tag
 */
function renderPartnerLogo(key, cssClass = 'max-h-16 w-auto object-contain') {
    const partner = PARTNERS[key];
    if (!partner) return '';

    return `<img src="${partner.logo}" alt="${partner.name}" class="${cssClass}">`;
}

/**
 * Render partner as clickable link with logo
 * @param {string} key - Partner key
 * @param {string} imgClass - CSS classes for the img tag
 * @param {string} linkClass - CSS classes for the anchor tag
 * @returns {string} - HTML anchor tag with img
 */
function renderPartnerLink(key, imgClass = 'max-h-16 w-auto object-contain', linkClass = '') {
    const partner = PARTNERS[key];
    if (!partner) return '';

    return `
        <a href="${partner.url}" target="_blank" class="${linkClass}">
            <img src="${partner.logo}" alt="${partner.name}" class="${imgClass}">
        </a>
    `;
}

// ==========================================
// EXPORTS
// ==========================================

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        PARTNERS,
        getPartner,
        getPartnerLogo,
        getPartnerName,
        getAllPartners,
        getPartnersByCategory,
        renderPartnerLogo,
        renderPartnerLink
    };
}
