import re

files = [
    'resources/views/pages/pembelian/daftar-pembelian.blade.php',
    'resources/views/pages/pembelian/tambah-pembelian.blade.php',
    'resources/views/pages/pembelian/edit-pembelian.blade.php',
    'resources/views/pages/vendorPgs/daftar-vendor.blade.php',
]

for path in files:
    with open(path, 'r', encoding='utf-8') as f:
        text = f.read()
    js_icons = re.findall(r'<(?:i|span)[^>]+(?:la-|ri-)[^>]+>', text)
    print(f'=== {path} ===')
    for ic in sorted(list(set(js_icons))):
        print('  ' + ic)

