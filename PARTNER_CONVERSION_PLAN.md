# Partner Logo Centralization - Action Plan

## Problem
Currently, partner logos are hardcoded with different URLs across different pages:
- **home_v2.html** uses a mix of mpanel and app-works URLs
- **partners_v2.html** uses different URLs (mostly from Media/Sports folders)
- **cms_v2.html**, **media_v2.html**, **sport_v2.html** also have hardcoded logos

This causes inconsistent images showing on different pages.

## Solution
Convert ALL pages to pull partner logos from the centralized `/js/partner-logos.js` file.

## Files Created
1. **`/js/partner-logos.js`** - Central partner database (DONE ✓)
2. **`/js/partner-loader.js`** - Auto-loader script (DONE ✓)
3. **`PARTNER_LOGOS_GUIDE.md`** - Usage documentation (DONE ✓)

## Files to Update

### 1. home_v2.html
**Section**: Partners grid (~lines 1190-1276)
**Partners**: All featured partners (27 total)
**Action**: Replace ~27 hardcoded `<img>` tags with `data-partner` attributes

### 2. partners_v2.html
**Section**: Partners grid (~lines 247-434)
**Partners**: All partners (55+ total)
**Action**: Replace ~55 hardcoded `<img>` tags with `data-partner` attributes

### 3. cms_v2.html
**Section**: "Built for Media & Sports" (~lines 590-630)
**Partners**: Select media and sports logos
**Action**: Replace hardcoded `<img>` tags with `data-partner` attributes

### 4. media_v2.html
**Section**: Media partners showcase (~line 428+)
**Partners**: Media partner logos
**Action**: Replace hardcoded `<img>` tags with `data-partner` attributes

### 5. sport_v2.html
**Section**: Sports partners showcase (~line 341+)
**Partners**: Sports partner logos
**Action**: Replace hardcoded `<img>` tags with `data-partner` attributes

## Implementation Steps

For each file:

1. **Add scripts** (before `</body>`):
```html
<!-- Partner Logo System -->
<script src="/js/partner-logos.js"></script>
<script src="/js/partner-loader.js"></script>
```

2. **Replace each hardcoded image** from:
```html
<img src="https://appworks.mpanel.app/image/cache/original/files/images/logo-dark.png?crop=true"
     alt="Media 24"
     class="max-h-16 w-auto object-contain">
```

To:
```html
<div data-partner="media24"
     data-css="max-h-16 w-auto object-contain"></div>
```

3. **Test the page** to ensure all logos load correctly

## URL → Key Mapping

| URL Contains | Partner Key |
|---|---|
| `logo-dark.png` | `media24` |
| `Leeds.png` | `leeds` |
| `hrvatska-radiotelevizija-logo.png` | `hrt` |
| `FK Partizan.png` or `fk-partizan-logo.png` | `fk-partizan` |
| `rts-3-logo.png` | `rts` |
| `QPR.png` | `qpr` |
| `ringier-logo-1.png` | `ringier` |
| `PAO.png` | `pao` |
| `N1.png` | `n1` |
| `Cedevita.png` | `cedevita` |
| `Politika.png` | `politika` |
| `DAN.png` or `dan.png` | `dan` |
| `324194622-` (DPG) | `dpg` |
| `Euronews.png` | `euronews` |
| `danas-tamniji-logo.png` | `danas` |
| `Hanza Media.png` | `hanza-media` |
| `Insajder.png` | `insajder` |
| `nova-serbia.png` | `nova-s` |
| `ESAKE.png` | `esake` |
| `rtcg-logo` | `rtcg` |
| `wmg-logo` | `wmg` |
| `Vijesti.png` | `vijesti` |
| `Tanjug.png` | `tanjug` |
| `images-4-removebg-preview-1.png` | `sat` |
| `HKS.png` | `hks` |
| `krik-logo` | `krik` |

(See `/js/partner-logos.js` for complete list of all 58 partners)

## Expected Outcome

After conversion:
- ✅ All pages will use identical partner logos
- ✅ Editing `/js/partner-logos.js` updates all pages automatically
- ✅ No URL inconsistencies across pages
- ✅ Easy to add/remove/update partners
- ✅ Single source of truth

## Manual Conversion Recommended

Given the number of replacements (~150+ img tags across 5 files), it's recommended to:

1. Start with **home_v2.html** (most visible page)
2. Then **partners_v2.html**
3. Then remaining pages (cms, media, sport)

OR use the Python script `/convert-partners.py` to automate the conversion.
