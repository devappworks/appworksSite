# Partner Logo Implementation Template

## Step 1: Add Scripts to HTML `<head>` or before `</body>`

```html
<!-- Partner Logo System -->
<script src="/js/partner-logos.js"></script>
<script src="/js/partner-loader.js"></script>
```

## Step 2: Replace Hardcoded Partner Logos

### BEFORE (Hardcoded):
```html
<a href="https://www.media24.si/" target="_blank" class="flex items-center justify-center p-6 glass-light rounded-xl smooth-transition hover-lift">
    <img src="https://appworks.mpanel.app/image/cache/original/files/images/logo-dark.png?crop=true" alt="Media 24" class="max-h-16 w-auto object-contain" style="transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
</a>
```

### AFTER (Using Partner Key):
```html
<a href="https://www.media24.si/" target="_blank" class="flex items-center justify-center p-6 glass-light rounded-xl smooth-transition hover-lift">
    <div data-partner="media24"
         data-css="max-h-16 w-auto object-contain"
         data-style="transition: transform 0.3s ease;"
         onmouseover="this.querySelector('img').style.transform='scale(1.1)'"
         onmouseout="this.querySelector('img').style.transform='scale(1)'"></div>
</a>
```

## Step 3: Partner Keys Reference

### Featured Partners (Homepage):
- `media24` - Media 24
- `leeds` - Leeds United
- `hrt` - HRT
- `fk-partizan` - FK Partizan
- `rts` - RTS
- `qpr` - QPR
- `ringier` - Ringier
- `pao` - Panathinaikos
- `n1` - N1
- `cedevita` - Cedevita Olimpija
- `politika` - Politika
- `dan` - DAN
- `dpg` - DPG Media
- `euronews` - Euronews
- `danas` - Danas
- `hanza-media` - Hanza Media
- `insajder` - Insajder
- `nova-s` - Nova S
- `esake` - ESAKE
- `rtcg` - RTCG
- `wmg` - WMG
- `vijesti` - Vijesti
- `tanjug` - Tanjug
- `sat` - SAT Media
- `hks` - HKS
- `krik` - KRIK

### All Partners (Partners Page):
Use all featured partners plus:
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
- `ksbih` - KS BiH
- `peristeri` - Peristeri
- `hrs` - HRS
- `savez-skolski-sport` - Savez za školski sport
- `futsal-partizan` - Futsal Partizan

## Alternative: Dynamic Rendering

Instead of hardcoding each partner, render them dynamically:

```html
<!-- Partners Grid Container -->
<div id="partners-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-12"></div>

<script>
    // Get all featured partners
    const featuredPartners = getPartnersByCategory('featured');
    const grid = document.getElementById('partners-grid');

    // Render each partner
    Object.keys(featuredPartners).forEach(key => {
        const partner = featuredPartners[key];

        const link = document.createElement('a');
        link.href = partner.url;
        link.target = '_blank';
        link.className = 'flex items-center justify-center p-6 glass-light rounded-xl smooth-transition hover-lift';

        const img = document.createElement('img');
        img.src = partner.logo;
        img.alt = partner.name;
        img.className = 'max-h-16 w-auto object-contain';
        img.style.transition = 'transform 0.3s ease';
        img.onmouseover = function() { this.style.transform = 'scale(1.1)'; };
        img.onmouseout = function() { this.style.transform = 'scale(1)'; };

        link.appendChild(img);
        grid.appendChild(link);
    });
</script>
```

## Pages to Update:

1. **home_v2.html** - Partners section (line ~1190-1276)
2. **partners_v2.html** - All partners grid (line ~247-434)
3. **cms_v2.html** - Partner logos in "Built for Media & Sports" section
4. **media_v2.html** - Media partners showcase
5. **sport_v2.html** - Sports partners showcase

## Benefits:

✅ Edit `/js/partner-logos.js` once, updates everywhere
✅ No duplicate URLs across pages
✅ Consistent partner branding
✅ Easy to add/remove partners
✅ Single source of truth
