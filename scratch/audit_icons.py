import re

files = [
    'resources/views/pages/pembelian/daftar-pembelian.blade.php',
    'resources/views/pages/pembelian/tambah-pembelian.blade.php',
    'resources/views/pages/pembelian/edit-pembelian.blade.php',
    'resources/views/pages/vendorPgs/daftar-vendor.blade.php',
]

for path in files:
    print('=== ' + path + ' ===')
    with open(path, 'r', encoding='utf-8') as f:
        text = f.read()
    icons = re.findall(r'<i class=["\']([^"\']+)["\']', text)
    unique_icons = sorted(list(set(icons)))
    for ic in unique_icons:
        print('  ' + ic)

