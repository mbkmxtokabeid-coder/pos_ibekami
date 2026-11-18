import re

def update_daftar_pembelian():
    path = 'resources/views/pages/pembelian/daftar-pembelian.blade.php'
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Update icon-box-amber styling
    content = re.sub(
        r'\.icon-box-amber\s*\{[^}]+\}',
        '''.icon-box-amber {
      background-color: var(--ibk-brand-soft);
      color: var(--ibk-brand);
      border: 1px solid var(--ibk-brand-border);
    }''',
        content
    )

    # 2. Update KPI 4 icon box to use icon-box-emerald instead of icon-box-amber when >= 0
    content = content.replace(
        "{{ ($sisaKas ?? 0) >= 0 ? 'icon-box-amber' : 'icon-box-rose' }}",
        "{{ ($sisaKas ?? 0) >= 0 ? 'icon-box-emerald' : 'icon-box-rose' }}"
    )

    # 3. Standardize header button icon
    content = content.replace(
        '<i class="las la-plus fs-16"></i>',
        '<i class="ri-add-line fs-16" aria-hidden="true"></i>'
    )

    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
    print("Updated daftar-pembelian.blade.php")

def update_tambah_pembelian():
    path = 'resources/views/pages/pembelian/tambah-pembelian.blade.php'
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()

    # Standardize icons
    content = content.replace('<i class="las la-plus fs-16" aria-hidden="true"></i>', '<i class="ri-add-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-trash fs-18" aria-hidden="true"></i>', '<i class="ri-delete-bin-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-save fs-18" aria-hidden="true"></i>', '<i class="ri-save-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-times fs-16" aria-hidden="true"></i>', '<i class="ri-close-line fs-16" aria-hidden="true"></i>')
    content = content.replace('las la-trash fs-18', 'ri-delete-bin-line fs-16')

    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
    print("Updated tambah-pembelian.blade.php")

def update_edit_pembelian():
    path = 'resources/views/pages/pembelian/edit-pembelian.blade.php'
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()

    # Standardize icons
    content = content.replace('<i class="las la-plus fs-16" aria-hidden="true"></i>', '<i class="ri-add-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-trash fs-18" aria-hidden="true"></i>', '<i class="ri-delete-bin-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-trash-alt fs-16"></i>', '<i class="ri-delete-bin-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-save fs-18" aria-hidden="true"></i>', '<i class="ri-save-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-times fs-16" aria-hidden="true"></i>', '<i class="ri-close-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-times"></i>', '<i class="ri-close-line fs-16" aria-hidden="true"></i>')
    content = content.replace('las la-trash fs-18', 'ri-delete-bin-line fs-16')

    # Update modal variables to warm stone
    content = content.replace('--ibk-modal-bg: #16161A;', '--ibk-modal-bg: #181412;')
    content = content.replace('--ibk-modal-border: #27272A;', '--ibk-modal-border: var(--ibk-border);')

    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
    print("Updated edit-pembelian.blade.php")

def update_daftar_vendor():
    path = 'resources/views/pages/vendorPgs/daftar-vendor.blade.php'
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Update icon-box-amber definition
    content = re.sub(
        r'\.icon-box-amber\s*\{[^}]+\}',
        '''.icon-box-amber {
      background-color: var(--ibk-brand-soft);
      color: var(--ibk-brand);
      border: 1px solid var(--ibk-brand-border);
    }''',
        content
    )

    # 2. Update KPI 4 (Sisa Duit Kas) in daftar-vendor
    content = content.replace(
        '<span class="badge py-0 px-1.5 fs-10 fw-semibold" style="background: var(--ibk-info-soft); color: var(--ibk-info); border: 1px solid var(--ibk-info-border);">Tersedia</span>',
        '<span class="badge py-0.5 px-2 fs-10 fw-semibold" style="background: var(--ibk-success-soft); color: var(--ibk-success); border: 1px solid var(--ibk-success-border);">Tersedia</span>'
    )
    content = content.replace(
        "style=\"color: {{ ($sisaKas ?? 0) >= 0 ? 'var(--ibk-info)' : 'var(--ibk-danger)' }};\"",
        "style=\"color: {{ ($sisaKas ?? 0) >= 0 ? 'var(--ibk-success)' : 'var(--ibk-danger)' }};\""
    )
    content = content.replace(
        "<div class=\"kpi-icon-box {{ ($sisaKas ?? 0) >= 0 ? 'icon-box-amber' : 'icon-box-rose' }}\">",
        "<div class=\"kpi-icon-box {{ ($sisaKas ?? 0) >= 0 ? 'icon-box-emerald' : 'icon-box-rose' }}\">"
    )

    # 3. Standardize icons in daftar-vendor
    content = content.replace('<i class="las la-plus fs-16"></i>', '<i class="ri-add-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-plus-circle fs-16"></i>', '<i class="ri-add-circle-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-save fs-16"></i>', '<i class="ri-save-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-times"></i>', '<i class="ri-close-line fs-16" aria-hidden="true"></i>')
    content = content.replace('<i class="las la-ellipsis-h fs-16"></i>', '<i class="ri-more-fill fs-16" aria-hidden="true"></i>')

    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
    print("Updated daftar-vendor.blade.php")

if __name__ == '__main__':
    update_daftar_pembelian()
    update_tambah_pembelian()
    update_edit_pembelian()
    update_daftar_vendor()

