# inspect_spj.py
import re

with open('resources/views/pages/SPJ/daftar-spj.blade.php', encoding='utf-8') as f:
    text = f.read()

print('Sections:', re.findall(r'@section\([\'"](.*?)[\'"]\)', text))
print('Blade vars:', sorted(list(set(re.findall(r'\$([a-zA-Z0-9_]+)', text)))))

