/**
 * Centralized Partner Logos Configuration
 * Single source of truth for all partner logos across the website
 * Priority: Homepage images first, then Partners page if not on homepage
 */

const partnerLogos = {
    // Media Partners
    'insajder': 'https://app-works.app/images/appworksPartners/Featured/Insajder.png',
    'politika': 'https://app-works.app/images/Politika.png',
    'dan': 'https://app-works.app/images/dan.png',
    'vecer': 'https://app-works.app/images/Večer.png',
    'media24': 'https://appworks.mpanel.app/image/cache/original/files/images/logo-dark.png?crop=true',
    'hrt': 'https://appworks.mpanel.app/image/cache/original/files/images/hrvatska-radiotelevizija-logo.png?crop=true',
    'rts': 'https://appworks.mpanel.app/image/cache/original/files/images/rts-3-logo.png?crop=true',
    'ringier': 'https://appworks.mpanel.app/image/cache/original/files/images/ringier-logo-1.png?crop=true',
    'n1': 'https://app-works.app/images/appworksPartners/Featured/N1.png',
    'dpg': 'https://appworks.mpanel.app/image/cache/original/files/images/324194622-572648424721395-1863643511798102048-n.jpg?crop=true',
    'euronews': 'https://app-works.app/images/appworksPartners/Featured/Euronews.png',
    'danas': 'https://appworks.mpanel.app/image/cache/original/files/images/danas-tamniji-logo.png?crop=true',
    'hanza-media': 'https://app-works.app/images/appworksPartners/Featured/Hanza Media.png',
    'nova-s': 'https://appworks.mpanel.app/image/cache/original/files/images/nova-serbia.png?crop=true',
    'rtcg': 'https://appworks.mpanel.app/image/cache/original/files/images/rtcg-logo-1767170390.png?crop=true',
    'wmg': 'https://appworks.mpanel.app/image/cache/original/files/images/wmg-logo-pozitiv-1-2-1.png?crop=true',
    'vijesti': 'https://app-works.app/images/appworksPartners/Featured/Vijesti.png',
    'tanjug': 'https://app-works.app/images/appworksPartners/Featured/Tanjug.png',
    'sat': 'https://appworks.mpanel.app/image/cache/original/files/images/images-4-removebg-preview-1.png?crop=true',
    'krik': 'https://appworks.mpanel.app/image/cache/original/files/images/krik-logo-serbia-removebg-preview.png?crop=true',

    // Media Partners (from Partners page only)
    'dnevnik': 'https://app-works.app/images/appworksPartners/Media/Dnevnik.jpg',
    'mozzart': 'https://app-works.app/images/appworksPartners/Media/Mozzart.png',
    'hrvatski-telekom': 'https://app-works.app/images/appworksPartners/Media/Hrvatski telekom.png',
    'fraktura': 'https://app-works.app/images/appworksPartners/All/Fraktura.jpg',
    'ipsos': 'https://app-works.app/images/appworksPartners/Media/IPSOS.png',
    'fonet': 'https://app-works.app/images/appworksPartners/Media/FONET.png',
    'oslobodjenje': 'https://app-works.app/images/appworksPartners/Media/Oslobodjenje.png',
    'peristeri': 'https://app-works.app/images/appworksPartners/Sports/Peristeri.png',
    'financial-afrik': 'https://app-works.app/images/appworksPartners/Media/Financial Afrik.jpg',
    'sat-media': 'https://app-works.app/images/appworksPartners/Media/SAT Media.png',
    'newsmax': 'https://app-works.app/images/appworksPartners/Media/newsmax.png',
    'geopoetika': 'https://app-works.app/images/appworksPartners/All/Geopoetika.png',
    'hrs': 'https://app-works.app/images/appworksPartners/Sports/HRS.png',
    'motus-media': 'https://app-works.app/images/appworksPartners/Media/Motus Media.png',
    'fena': 'https://app-works.app/images/appworksPartners/Media/FENA.png',
    'boom93': 'https://app-works.app/images/appworksPartners/Media/boom 93.png',
    'anem': 'https://app-works.app/images/appworksPartners/Media/ANEM.jpg',
    'pc-press': 'https://app-works.app/images/appworksPartners/Media/PC Press.png',
    'alo': 'https://app-works.app/images/appworksPartners/Media/ALO.png',
    'telegraf': 'https://app-works.app/images/appworksPartners/Media/telegraf.jpg',
    'tocka': 'https://app-works.app/images/appworksPartners/Media/Tocka.png',
    'telesport': 'https://app-works.app/images/appworksPartners/Media/Telesport.png',
    'nedeljnik': 'https://app-works.app/images/appworksPartners/Media/nedeljnik-logo.png',
    'astra': 'https://app-works.app/images/appworksPartners/Media/astra-logo.png',

    // Sports Partners
    'qpr': 'https://app-works.app/images/appworksPartners/Featured/QPR.png',
    'esake': 'https://app-works.app/images/appworksPartners/Featured/ESAKE.png',
    'fk-partizan': 'https://appworks.mpanel.app/image/cache/original/files/images/fk-partizan-logo.png?crop=true',
    'hks': 'https://app-works.app/images/appworksPartners/Featured/HKS.png',
    'cedevita': 'https://app-works.app/images/appworksPartners/Featured/Cedevita.png',
    'pao': 'https://app-works.app/images/appworksPartners/Featured/PAO.png',
    'leeds': 'https://app-works.app/images/appworksPartners/Featured/Leeds.png',
    'ksbih': 'https://app-works.app/images/appworksPartners/Sports/KSBIH.png',
    'savez-skolski-sport': 'https://app-works.app/images/appworksPartners/Sports/Savez za skolski sport.png',
    'futsal-partizan': 'https://app-works.app/images/appworksPartners/Sports/futsal-partizan-logo.png',
};

/**
 * Get partner logo URL by key
 * @param {string} key - Partner identifier key
 * @returns {string} - Full URL to partner logo
 */
function getPartnerLogo(key) {
    return partnerLogos[key] || '';
}

/**
 * Get all partner logos
 * @returns {object} - Object containing all partner logos
 */
function getAllPartnerLogos() {
    return partnerLogos;
}

/**
 * Get partner logos by category
 * @param {string} category - Category name ('media', 'sports', or 'all')
 * @returns {object} - Filtered partner logos object
 */
function getPartnerLogosByCategory(category) {
    const mediaPartners = [
        'insajder', 'politika', 'dan', 'vecer', 'media24', 'hrt', 'rts', 'ringier',
        'n1', 'dpg', 'euronews', 'danas', 'hanza-media', 'nova-s', 'rtcg', 'wmg',
        'vijesti', 'tanjug', 'sat', 'krik', 'dnevnik', 'mozzart', 'hrvatski-telekom',
        'fraktura', 'ipsos', 'fonet', 'oslobodjenje', 'financial-afrik',
        'sat-media', 'newsmax', 'geopoetika', 'motus-media', 'fena', 'boom93',
        'anem', 'pc-press', 'alo', 'telegraf', 'tocka', 'telesport',
        'nedeljnik', 'astra'
    ];

    const sportsPartners = [
        'qpr', 'esake', 'fk-partizan', 'hks', 'cedevita', 'pao',
        'leeds', 'ksbih', 'peristeri', 'hrs', 'savez-skolski-sport', 'futsal-partizan'
    ];

    if (category === 'media') {
        const filtered = {};
        mediaPartners.forEach(key => {
            if (partnerLogos[key]) filtered[key] = partnerLogos[key];
        });
        return filtered;
    } else if (category === 'sports') {
        const filtered = {};
        sportsPartners.forEach(key => {
            if (partnerLogos[key]) filtered[key] = partnerLogos[key];
        });
        return filtered;
    }

    return partnerLogos;
}

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { partnerLogos, getPartnerLogo, getAllPartnerLogos, getPartnerLogosByCategory };
}
