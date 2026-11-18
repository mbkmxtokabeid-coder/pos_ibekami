# sync_all_surat_colors.py
import re, os

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

for fpath in files:
    with open(fpath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Ensure light mode tokens match warm stone #F7F6F2 & #F3EFE6
    content = content.replace('--ibk-bg: #F8FAFC;', '--ibk-bg: #F7F6F2;')
    content = content.replace('--ibk-surface-hover: #FFF7ED;', '--ibk-surface-hover: #FAF7F2;')
    content = content.replace('--ibk-border: #E2E8F0;', '--ibk-border: #EAE4DC;')
    content = content.replace('--ibk-border-subtle: #F1F5F9;', '--ibk-border-subtle: #F5EFEB;')
    content = content.replace('--ibk-th-bg: #F8FAFC;', '--ibk-th-bg: #F3EFE6;')
    content = content.replace('--ibk-td-border: #E2E8F0;', '--ibk-td-border: #EAE4DC;')
    content = content.replace('--ibk-input-border: #CBD5E1;', '--ibk-input-border: #DDD6CE;')

    with open(fpath, 'w', encoding='utf-8') as f:
        f.write(content)
    print(f"Synchronized base tokens in: {fpath}")

