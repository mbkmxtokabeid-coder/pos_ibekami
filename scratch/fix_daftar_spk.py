# fix_daftar_spk.py
import re

with open('resources/views/pages/SPK/daftar-spk.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

# 1. Update light mode color variables
old_light_vars = """    body.theme-light,
    html.theme-light,
    html[data-layout-mode="light"] {
      --ibk-bg: #F8FAFC;
      --ibk-surface: #FFFFFF;
      --ibk-surface-hover: #FFF7ED;
      --ibk-card-bg: #FFFFFF;
      --ibk-card-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
      --ibk-border: #E2E8F0;
      --ibk-border-subtle: #F1F5F9;
      --ibk-text: #0F172A;
      --ibk-text-muted: #64748B;
      --ibk-text-dim: #94A3B8;

      --ibk-brand: #EA580C;
      --ibk-brand-deep: #C2410C;
      --ibk-brand-soft: #FFF7ED;
      --ibk-brand-border: #FED7AA;
      --ibk-brand-text: #EA580C;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      --ibk-success: #059669;
      --ibk-success-soft: #ECFDF5;
      --ibk-success-border: #A7F3D0;
      --ibk-danger: #DC2626;
      --ibk-danger-soft: #FEF2F2;
      --ibk-danger-border: #FECACA;

      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #CBD5E1;
      --ibk-input-text: #0F172A;
      --ibk-input-placeholder: #94A3B8;
      --ibk-popover-bg: #FFFFFF;

      --ibk-th-bg: #F8FAFC;
      --ibk-th-text: #64748B;
      --ibk-td-border: #E2E8F0;
    }"""

new_light_vars = """    body.theme-light,
    html.theme-light,
    html[data-layout-mode="light"] {
      /* Mode Terang — Warm Stone & Craft Palette (Matched to Daftar Vendor & Dashboard) */
      --ibk-bg: #F7F6F2;
      --ibk-surface: #FFFFFF;
      --ibk-surface-hover: #FAF7F2;
      --ibk-card-bg: #FFFFFF;
      --ibk-card-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
      --ibk-border: #EAE4DC;
      --ibk-border-subtle: #F5EFEB;
      --ibk-text: #0F172A;
      --ibk-text-muted: #64748B;
      --ibk-text-dim: #94A3B8;

      --ibk-brand: #EA580C;
      --ibk-brand-deep: #C2410C;
      --ibk-brand-soft: #FFF7ED;
      --ibk-brand-border: #FED7AA;
      --ibk-brand-text: #EA580C;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      --ibk-success: #059669;
      --ibk-success-soft: #ECFDF5;
      --ibk-success-border: #A7F3D0;
      --ibk-danger: #DC2626;
      --ibk-danger-soft: #FEF2F2;
      --ibk-danger-border: #FECACA;

      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #DDD6CE;
      --ibk-input-text: #0F172A;
      --ibk-input-placeholder: #94A3B8;
      --ibk-popover-bg: #FFFFFF;

      /* Warm Stone Table Header identical to Daftar Vendor */
      --ibk-th-bg: #F3EFE6;
      --ibk-th-text: #64748B;
      --ibk-td-border: #EAE4DC;
    }"""

if old_light_vars in text:
    text = text.replace(old_light_vars, new_light_vars)
    print("Replaced light vars in daftar-spk")
else:
    print("Notice: old_light_vars not matched exactly, replacing regex")
    text = re.sub(r'body\.theme-light.*?--ibk-td-border:\s*#E2E8F0;\s*}', new_light_vars.strip(), text, flags=re.DOTALL)

# 2. Fix the missing icon: ri-hourglass-line -> ri-time-line
text = text.replace('ri-hourglass-line', 'ri-time-line')

# 3. Update themeToggleBtn script to notify updateSpkChartTheme
old_script = """    if (themeToggleBtn) {
      themeToggleBtn.addEventListener('click', function () {
        var isCurrentlyLight = document.body.classList.contains('theme-light');
        var nextIsLight = !isCurrentlyLight;
        applyTheme(nextIsLight);
        localStorage.setItem('tokabe_theme', nextIsLight ? 'light' : 'dark');
      });
    }"""

new_script = """    if (themeToggleBtn) {
      themeToggleBtn.addEventListener('click', function () {
        var isCurrentlyLight = document.body.classList.contains('theme-light');
        var nextIsLight = !isCurrentlyLight;
        applyTheme(nextIsLight);
        localStorage.setItem('tokabe_theme', nextIsLight ? 'light' : 'dark');
        if (typeof window.updateSpkChartTheme === 'function') {
          window.updateSpkChartTheme(nextIsLight);
        }
      });
    }"""

text = text.replace(old_script, new_script)

with open('resources/views/pages/SPK/daftar-spk.blade.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Updated resources/views/pages/SPK/daftar-spk.blade.php")

