#!/usr/bin/env python3
"""
Partner Logo URL Converter
Converts hardcoded partner logo URLs to use centralized partner keys
"""

import re
import os

# Mapping of logo URLs to partner keys
URL_TO_KEY = {
    # Media Partners
    'Insajder.png': 'insajder',
    'Politika.png': 'politika',
    'dan.png': 'dan',
    'Večer.png': 'vecer',
    'logo-dark.png': 'media24',
    'hrvatska-radiotelevizija-logo.png': 'hrt',
    'rts-3-logo.png': 'rts',
    'ringier-logo-1.png': 'ringier',
    'Ringier.jpg': 'ringier',
    'N1.png': 'n1',
    '324194622-572648424721395-1863643511798102048-n.jpg': 'dpg',
    'DPG.jpg': 'dpg',
    'Euronews.png': 'euronews',
    'danas-tamniji-logo.png': 'danas',
    'Hanza Media.png': 'hanza-media',
    'nova-serbia.png': 'nova-s',
    'rtcg-logo-1767170390.png': 'rtcg',
    'wmg-logo-pozitiv-1-2-1.png': 'wmg',
    'Vijesti.png': 'vijesti',
    'Tanjug.png': 'tanjug',
    'images-4-removebg-preview-1.png': 'sat',
    'SAT Media.png': 'sat',
    'krik-logo-serbia-removebg-preview.png': 'krik',
    'KRIK.png': 'krik',
    'DAN.png': 'dan',

    # Sports Partners
    'QPR.png': 'qpr',
    'ESAKE.png': 'esake',
    'fk-partizan-logo.png': 'fk-partizan',
    'FK Partizan.png': 'fk-partizan',
    'HKS.png': 'hks',
    'Cedevita.png': 'cedevita',
    'images-4-removebg-preview.png': 'cedevita',  # Hero image
    'PAO.png': 'pao',
    'Leeds.png': 'leeds',
    'KSBIH.png': 'ksbih',
    'Peristeri.png': 'peristeri',
    'HRS.png': 'hrs',
    'Savez za skolski sport.png': 'savez-skolski-sport',
    'futsal-partizan-logo.png': 'futsal-partizan',

    # Additional media partners
    'Dnevnik.jpg': 'dnevnik',
    'Mozzart.png': 'mozzart',
    'Hrvatski telekom.png': 'hrvatski-telekom',
    'Fraktura.jpg': 'fraktura',
    'IPSOS.png': 'ipsos',
    'FONET.png': 'fonet',
    'Oslobodjenje.png': 'oslobodjenje',
    'Financial Afrik.jpg': 'financial-afrik',
    'newsmax.png': 'newsmax',
    'Geopoetika.png': 'geopoetika',
    'Motus Media.png': 'motus-media',
    'FENA.png': 'fena',
    'boom 93.png': 'boom93',
    'ANEM.jpg': 'anem',
    'PC Press.png': 'pc-press',
    'ALO.png': 'alo',
    'telegraf.jpg': 'telegraf',
    'Tocka.png': 'tocka',
    'Telesport.png': 'telesport',
    'nedeljnik-logo.png': 'nedeljnik',
    'astra-logo.png': 'astra',
    'WMG.png': 'wmg',
    'Media 24.png': 'media24',
}

def get_partner_key_from_url(url):
    """Extract partner key from image URL"""
    for filename, key in URL_TO_KEY.items():
        if filename in url:
            return key
    return None

def convert_img_tag(match):
    """Convert hardcoded img tag to use data-partner attribute"""
    full_tag = match.group(0)
    src = match.group(1)
    alt = match.group(2) if len(match.groups()) >= 2 else ''
    css_class = match.group(3) if len(match.groups()) >= 3 else 'max-h-16 w-auto object-contain'

    # Get partner key from URL
    partner_key = get_partner_key_from_url(src)

    if not partner_key:
        print(f"  WARNING: Could not find partner key for: {src}")
        return full_tag  # Return original if we can't map it

    # Build new tag with data-partner
    new_tag = f'<div data-partner="{partner_key}" data-css="{css_class}"></div>'

    return new_tag

def convert_file(filepath):
    """Convert partner logos in a single file"""
    print(f"\\nProcessing: {filepath}")

    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    original_content = content

    # Pattern to match partner logo img tags
    # Matches: <img src="..." alt="..." class="...">
    pattern = r'<img src="(https://[^"]*(?:appworks|app-works)[^"]*)" alt="([^"]*)" class="([^"]*)"[^>]*>'

    # Count matches
    matches = re.findall(pattern, content)
    print(f"  Found {len(matches)} partner logo images")

    # Replace matches
    content = re.sub(pattern, convert_img_tag, content)

    # Check if content changed
    if content != original_content:
        # Create backup
        backup_path = filepath + '.backup'
        with open(backup_path, 'w', encoding='utf-8') as f:
            f.write(original_content)
        print(f"  Created backup: {backup_path}")

        # Write updated content
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"  Updated {filepath}")
        return True
    else:
        print(f"  No changes needed")
        return False

def add_scripts_to_file(filepath):
    """Add partner logo scripts to HTML file if not present"""
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Check if scripts already included
    if 'partner-logos.js' in content:
        print(f"  Scripts already included in {filepath}")
        return False

    # Add scripts before </body>
    scripts = '''
    <!-- Partner Logo System -->
    <script src="/js/partner-logos.js"></script>
    <script src="/js/partner-loader.js"></script>
</body>'''

    content = content.replace('</body>', scripts)

    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

    print(f"  Added scripts to {filepath}")
    return True

def main():
    """Main conversion function"""
    files_to_convert = [
        'home_v2.html',
        'partners_v2.html',
        'cms_v2.html',
        'media_v2.html',
        'sport_v2.html'
    ]

    print("=" * 60)
    print("Partner Logo Converter")
    print("=" * 60)

    total_updated = 0

    for filename in files_to_convert:
        if os.path.exists(filename):
            if convert_file(filename):
                total_updated += 1
            add_scripts_to_file(filename)
        else:
            print(f"\\nFile not found: {filename}")

    print("\\n" + "=" * 60)
    print(f"Conversion complete! Updated {total_updated} files")
    print("=" * 60)
    print("\\nNext steps:")
    print("1. Review the changes in each file")
    print("2. Test the pages to ensure logos load correctly")
    print("3. Delete .backup files once satisfied")
    print("4. Edit /js/partner-logos.js to manage all partner logos")

if __name__ == '__main__':
    main()
