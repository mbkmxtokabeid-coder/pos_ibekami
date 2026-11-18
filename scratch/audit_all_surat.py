# audit_all_surat.py
import re

files = [
    'resources/views/pages/SPB/daftar-spb.blade.php',
    'resources/views/pages/SPB/tambah-spb.blade.php',
    'resources/views/pages/SPB/edit-spb.blade.php',
    'resources/views/pages/SPK/daftar-spk.blade.php',
    'resources/views/pages/SPK/tambah-spk.blade.php',
    'resources/views/pages/SPK/edit-spk.blade.php',
    'resources/views/pages/SPK/lihat.blade.php',
    'resources/views/pages/SPJ/daftar-spj.blade.php',
    'resources/views/pages/SPJ/tambah-spj.blade.php',
    'resources/views/pages/SPJ/edit-spj.blade.php',
    'resources/views/pages/SPJ/lihat-spj.blade.php',
]

total_la = 0
for fpath in files:
    with open(fpath, encoding='utf-8') as f:
        content = f.read()
    la_matches = re.findall(r'la[srbd]?\s+la-[\w-]+', content)
    if la_matches:
        print(f"{fpath}: {len(la_matches)} LineAwesome icons found: {la_matches[:5]}")
        total_la += len(la_matches)
    else:
        print(f"{fpath}: 100% clean (Remix Icons only)")

print(f"\nTotal LineAwesome icons remaining: {total_la}")

