# fix_lihat_views.py
for path in ['resources/views/pages/SPK/lihat.blade.php', 'resources/views/pages/SPJ/lihat-spj.blade.php']:
    with open(path, 'r', encoding='utf-8') as f:
        text = f.read()

    # Add --ibk-th-bg to :root and theme-light
    if '--ibk-th-bg' not in text:
        text = text.replace(
            '--ibk-danger-border: rgba(239, 68, 68, 0.28);',
            '--ibk-danger-border: rgba(239, 68, 68, 0.28);\n    --ibk-th-bg: #181412;\n    --ibk-th-text: #A1A1AA;'
        )
        text = text.replace(
            '--ibk-danger-border: #FECACA;',
            '--ibk-danger-border: #FECACA;\n    --ibk-th-bg: #F3EFE6;\n    --ibk-th-text: #64748B;'
        )
    
    text = text.replace('background: rgba(255, 255, 255, 0.015);', 'background: var(--ibk-th-bg) !important;\n    color: var(--ibk-th-text) !important;')

    with open(path, 'w', encoding='utf-8') as f:
        f.write(text)
    print(f"Updated {path}")

