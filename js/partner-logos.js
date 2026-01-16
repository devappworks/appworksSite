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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/insajder-logo-generic-removebg-preview.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/images-13-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'media24': {
        name: 'Media 24',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/logo-white.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/radio-televizija-srbije-logo.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/dpgmediaog-removebg-preview-1768490527.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'euronews': {
        name: 'Euronews',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/images-14-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'danas': {
        name: 'Danas',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/donacije-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'hanza-media': {
        name: 'Hanza Media',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/1707230054179-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'nova-s': {
        name: 'Nova S',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/logo-nova-rs-2-725x408-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'rtcg': {
        name: 'RTCG',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/channels4-profile-2-removebg-preview-1768488596.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'wmg': {
        name: 'WMG',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/images-16-removebg-preview.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/header-logo.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'sat': {
        name: 'SAT Media',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/unnamed-4-1-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'krik': {
        name: 'KRIK',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/krik-logo-white.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'dnevnik': {
        name: 'Dnevnik',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/images-15-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'mozzart': {
        name: 'Mozzart',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/unnamed-7-removebg-preview-1768490353.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/fraktura-logo-crni-525-x120.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/fonet-logo-removebg-preview.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/financialafrik-logo.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/geopoetika-logo-footer.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'motus-media': {
        name: 'Motus Media',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/motus-media-grupa-logo-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'fena': {
        name: 'FENA',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/no-image-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'boom93': {
        name: 'Boom 93',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/boom93-social-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'anem': {
        name: 'ANEM',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/anem-logo-12-removebg-preview.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/images-20-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'telesport': {
        name: 'Telesport',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/logotelesoprtwhite-382x235-1trans.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/stoiximan-gbl-logo-extreme-vertical-white-rgb2.png?crop=true',
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
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/8akygu1764154144.png?crop=true',
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

    // ==========================================
    // NEW MEDIA PARTNERS (January 2026)
    // ==========================================
    'italpress': {
        name: 'Italpress',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/italpress-logo-vector-removebg-preview-1768552125.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'star': {
        name: 'Star',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/images-20-removebg-preview-1.png?crop=true',
        url: '#',
        category: 'media',
        featured: true
    },
    'rtv-budva': {
        name: 'RTV Budva',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/channels4-profile-1-removebg-preview.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'varadzinske': {
        name: 'Varaždinske',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/logo-invert.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'riportal': {
        name: 'Riportal',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/unnamed-7-removebg-preview-1.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'infovranjske': {
        name: 'InfoVranjske',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/logo-infovranjske-xx-x-153.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'radio-magnum': {
        name: 'Radio Magnum',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/magnum-logo-7.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'novi-tednik': {
        name: 'Novi Tednik',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/novi-tednik.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'novski': {
        name: 'Novski',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/novski-vrh-logo.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'star-gr': {
        name: 'Star Channel Greece',
        logo: 'https://appworks.mpanel.app/image/cache/original/files/images/star-channel-greece-logosvg.png?crop=true',
        url: '#',
        category: 'media',
        featured: false
    },
    'codigopro': {
        name: 'Codigopro',
        logo: 'https://app-works.app/images/appworksPartners/Media/Codigopro.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'dnevno-hr': {
        name: 'Dnevno HR',
        logo: 'https://app-works.app/images/appworksPartners/Media/Dnevno Hr.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'ora-de-sibiu': {
        name: 'Ora De Sibiu',
        logo: 'https://app-works.app/images/appworksPartners/Media/Ora De Sibiu.png',
        url: '#',
        category: 'media',
        featured: false
    },
    'zagreb-info': {
        name: 'Zagreb Info',
        logo: 'https://app-works.app/images/appworksPartners/Media/Zagreb Info.png',
        url: '#',
        category: 'media',
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
