# Partner Logos - Centralized Management System

## Overview
All partner logos are managed in a single file: `/js/partner-logos.js`

This file is the **single source of truth** for all partner information across the entire website.

## File Structure

```javascript
const PARTNERS = {
    'partner-key': {
        name: 'Partner Display Name',
        logo: 'https://url-to-logo.png',
        url: '#',  // Partner website or link
        category: 'media', // or 'sports'
        featured: true  // true = shows on homepage, false = only on partners page
    },
    // ... more partners
};
```

## How to Edit Partners

### 1. Add a New Partner
Open `/js/partner-logos.js` and add a new entry:

```javascript
'new-partner-key': {
    name: 'Partner Name',
    logo: 'https://example.com/logo.png',
    url: 'https://partner-website.com',
    category: 'media',  // or 'sports'
    featured: true  // true for homepage, false for partners page only
},
```

### 2. Update Partner Logo
Find the partner key and update the `logo` URL:

```javascript
'insajder': {
    name: 'Insajder',
    logo: 'https://NEW-URL-HERE.png',  // ← Change this
    url: '#',
    category: 'media',
    featured: true
},
```

### 3. Remove a Partner
Simply delete the entire partner object from the file.

### 4. Change Partner Category
Update the `category` field:
- `'media'` for media partners
- `'sports'` for sports partners

### 5. Toggle Homepage Visibility
Update the `featured` field:
- `true` = Shows on homepage
- `false` = Only shows on partners page

---

## Using Partners in HTML Pages

### Step 1: Include the Script
Add this to your HTML `<head>` or before `</body>`:

```html
<script src="/js/partner-logos.js"></script>
```

### Step 2: Reference Partners by Key

#### Method A: Using Data Attributes (Recommended)
```html
<!-- The logo will be loaded automatically -->
<div class="partner-logo" data-partner="insajder"></div>

<script>
    // Auto-load all partner logos
    document.querySelectorAll('[data-partner]').forEach(el => {
        const key = el.getAttribute('data-partner');
        const partner = getPartner(key);
        if (partner) {
            el.innerHTML = `<img src="${partner.logo}" alt="${partner.name}" class="max-h-16 w-auto">`;
        }
    });
</script>
```

#### Method B: Using Helper Functions
```html
<div id="partners-grid"></div>

<script>
    const partnersGrid = document.getElementById('partners-grid');

    // Get all featured partners (for homepage)
    const featuredPartners = getPartnersByCategory('featured');

    // Render each partner
    Object.keys(featuredPartners).forEach(key => {
        const partner = featuredPartners[key];
        partnersGrid.innerHTML += `
            <a href="${partner.url}" target="_blank" class="partner-card">
                <img src="${partner.logo}" alt="${partner.name}" class="max-h-16 w-auto">
            </a>
        `;
    });
</script>
```

#### Method C: Render Specific Partners
```html
<!-- Homepage: Show only featured partners -->
<div class="homepage-partners">
    <div data-partner="insajder"></div>
    <div data-partner="qpr"></div>
    <div data-partner="n1"></div>
    <!-- Just list the keys, logos load automatically -->
</div>

<!-- Partners Page: Show all partners -->
<script>
    const allPartners = getAllPartners();
    // Render all partners...
</script>
```

---

## Available Helper Functions

### `getPartner(key)`
Get full partner data object
```javascript
const partner = getPartner('insajder');
// Returns: { name: 'Insajder', logo: '...', url: '#', category: 'media', featured: true }
```

### `getPartnerLogo(key)`
Get just the logo URL
```javascript
const logoUrl = getPartnerLogo('insajder');
// Returns: 'https://app-works.app/images/...'
```

### `getPartnerName(key)`
Get partner display name
```javascript
const name = getPartnerName('insajder');
// Returns: 'Insajder'
```

### `getAllPartners()`
Get all partners
```javascript
const all = getAllPartners();
// Returns the entire PARTNERS object
```

### `getPartnersByCategory(category)`
Filter partners by category

```javascript
// Get only featured partners (homepage)
const featured = getPartnersByCategory('featured');

// Get only media partners
const media = getPartnersByCategory('media');

// Get only sports partners
const sports = getPartnersByCategory('sports');

// Get all partners
const all = getPartnersByCategory('all');
```

### `renderPartnerLogo(key, cssClass)`
Generate HTML img tag
```javascript
const html = renderPartnerLogo('insajder', 'max-h-20 w-auto');
// Returns: '<img src="..." alt="Insajder" class="max-h-20 w-auto">'
```

### `renderPartnerLink(key, imgClass, linkClass)`
Generate clickable partner logo
```javascript
const html = renderPartnerLink('insajder', 'max-h-16 w-auto', 'partner-card');
// Returns: '<a href="..."><img src="..." alt="Insajder" class="max-h-16 w-auto"></a>'
```

---

## Available Partner Keys

### Media Partners (Featured - Homepage)
- `insajder` - Insajder
- `politika` - Politika
- `dan` - DAN
- `vecer` - Večer
- `media24` - Media 24
- `hrt` - HRT
- `rts` - RTS
- `ringier` - Ringier
- `n1` - N1
- `dpg` - DPG Media
- `euronews` - Euronews
- `danas` - Danas
- `hanza-media` - Hanza Media
- `nova-s` - Nova S
- `rtcg` - RTCG
- `wmg` - WMG
- `vijesti` - Vijesti
- `tanjug` - Tanjug
- `sat` - SAT Media
- `krik` - KRIK

### Media Partners (Partners Page Only)
- `dnevnik` - Dnevnik
- `mozzart` - Mozzart
- `hrvatski-telekom` - Hrvatski Telekom
- `fraktura` - Fraktura
- `ipsos` - IPSOS
- `fonet` - FONET
- `oslobodjenje` - Oslobođenje
- `financial-afrik` - Financial Afrik
- `newsmax` - Newsmax
- `geopoetika` - Geopoetika
- `motus-media` - Motus Media
- `fena` - FENA
- `boom93` - Boom 93
- `anem` - ANEM
- `pc-press` - PC Press
- `alo` - ALO
- `telegraf` - Telegraf
- `tocka` - Točka
- `telesport` - Telesport
- `nedeljnik` - Nedeljnik
- `astra` - Astra

### Sports Partners (Featured - Homepage)
- `qpr` - Queens Park Rangers
- `esake` - ESAKE
- `fk-partizan` - FK Partizan
- `hks` - HKS
- `cedevita` - Cedevita Olimpija
- `pao` - Panathinaikos
- `leeds` - Leeds United

### Sports Partners (Partners Page Only)
- `ksbih` - KS BiH
- `peristeri` - Peristeri
- `hrs` - HRS
- `savez-skolski-sport` - Savez za školski sport
- `futsal-partizan` - Futsal Partizan

---

## Example: Homepage Partners Section

```html
<section class="partners-section">
    <div class="container">
        <h2>Our Partners</h2>
        <div id="featured-partners" class="partners-grid"></div>
    </div>
</section>

<script>
    // Load featured partners for homepage
    const featuredPartners = getPartnersByCategory('featured');
    const grid = document.getElementById('featured-partners');

    Object.keys(featuredPartners).forEach(key => {
        const partner = featuredPartners[key];
        grid.innerHTML += `
            <a href="${partner.url}" target="_blank" class="partner-logo-link">
                <img src="${partner.logo}"
                     alt="${partner.name}"
                     class="max-h-16 w-auto object-contain grayscale hover:grayscale-0 transition-all">
            </a>
        `;
    });
</script>
```

---

## Benefits

✅ **Single Source of Truth** - Edit once, updates everywhere
✅ **No Hardcoded URLs** - All logos managed in one place
✅ **Easy Maintenance** - Add/remove/update partners easily
✅ **Consistent Display** - Same partner data across all pages
✅ **Flexible Filtering** - Filter by category, featured status, etc.
✅ **Type Safety** - Clear partner keys prevent typos
✅ **Automatic Updates** - Change logo URL once, all pages update

---

## Best Practices

1. **Always use partner keys** - Never hardcode logo URLs in HTML files
2. **Update centrally** - Only edit `/js/partner-logos.js` to manage partners
3. **Use data attributes** - `data-partner="key"` for automatic loading
4. **Filter appropriately** - Use `featured: true` for homepage, `false` for partners page
5. **Test after changes** - Check homepage and partners page after editing
