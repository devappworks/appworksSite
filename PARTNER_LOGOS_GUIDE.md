# Partner Logos - Usage Guide

## Overview
All partner logos are now centralized in `/js/partner-logos.js` to ensure consistency across all pages.

## File Location
```
/js/partner-logos.js
```

## How to Use

### 1. Include the Script
Add this line to your HTML file's `<head>` or before the closing `</body>` tag:
```html
<script src="/js/partner-logos.js"></script>
```

### 2. Access Partner Logos

#### Method 1: Direct Access
```javascript
// Get a specific partner logo
const insajderLogo = getPartnerLogo('insajder');
// Returns: 'https://app-works.app/images/appworksPartners/Featured/Insajder.png'
```

#### Method 2: Get All Logos
```javascript
// Get all partner logos
const allLogos = getAllPartnerLogos();
```

#### Method 3: Get by Category
```javascript
// Get only media partner logos
const mediaLogos = getPartnerLogosByCategory('media');

// Get only sports partner logos
const sportsLogos = getPartnerLogosByCategory('sports');

// Get all logos
const allLogos = getPartnerLogosByCategory('all');
```

### 3. Example HTML Usage
```html
<img src="" alt="Insajder" class="partner-logo" data-partner="insajder">

<script>
    // Set partner logo from centralized source
    document.querySelector('[data-partner="insajder"]').src = getPartnerLogo('insajder');
</script>
```

### 4. Example: Dynamically Create Partner Grid
```html
<div id="partners-grid"></div>

<script>
    const partnersGrid = document.getElementById('partners-grid');
    const mediaPartners = getPartnerLogosByCategory('media');

    Object.entries(mediaPartners).forEach(([key, url]) => {
        const partnerDiv = document.createElement('div');
        partnerDiv.innerHTML = `
            <img src="${url}" alt="${key}" class="max-h-16 w-auto">
        `;
        partnersGrid.appendChild(partnerDiv);
    });
</script>
```

## Available Partner Keys

### Media Partners
- insajder
- politika
- dan
- vecer
- media24
- hrt
- rts
- ringier
- n1
- dpg
- euronews
- danas
- hanza-media
- nova-s
- rtcg
- wmg
- vijesti
- tanjug
- sat
- krik
- dnevnik
- mozzart
- hrvatski-telekom
- fraktura
- ipsos
- fonet
- oslobodjenje
- financial-afrik
- sat-media
- newsmax
- geopoetika
- motus-media
- fena
- boom93
- anem
- pc-press
- alo
- telegraf
- tocka
- telesport
- nedeljnik
- astra

### Sports Partners
- qpr
- esake
- fk-partizan
- hks
- cedevita
- pao
- leeds
- ksbih
- peristeri
- hrs
- savez-skolski-sport
- futsal-partizan

## Updating Partner Logos

To update a partner logo:
1. Open `/js/partner-logos.js`
2. Find the partner key
3. Update the URL
4. Save the file
5. All pages will automatically use the new logo

## Benefits

✅ **Single Source of Truth**: Update once, changes everywhere
✅ **Consistency**: All pages use identical logos
✅ **Easy Maintenance**: One file to manage all partner images
✅ **Type Safety**: Clear partner keys prevent typos
✅ **Categorization**: Easy filtering by media/sports
