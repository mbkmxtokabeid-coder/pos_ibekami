import re

def inspect_file(path):
    print("========================================")
    print("FILE:", path)
    with open(path, 'r', encoding='utf-8') as f:
        text = f.read()
    
    kpis = re.findall(r'class="kpi-title"[^>]*>(.*?)<', text)
    if not kpis:
        kpis = re.findall(r'class="[^"]*kpi[^"]*"[^>]*>(.*?)<', text)
    print("KPIs:", kpis)

    ths = re.findall(r'<th[^>]*>(.*?)</th>', text, re.DOTALL)
    ths_clean = [re.sub(r'<[^>]+>', '', t).strip() for t in ths]
    print("Headers:", ths_clean)

    actions = re.findall(r'href="([^"]+)"', text)
    routes = [a for a in actions if 'route' in a or 'url' in a or '/' in a]
    print("Sample routes/actions (first 5):", routes[:5])

for p in [
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
]:
    inspect_file(p)

