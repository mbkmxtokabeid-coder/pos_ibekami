# check_template.py
with open('resources/views/layout/template.blade.php', encoding='utf-8') as f:
    text = f.read()

idx = text.find("yield('content')")
if idx != -1:
    print(text[idx-300:idx+300])

