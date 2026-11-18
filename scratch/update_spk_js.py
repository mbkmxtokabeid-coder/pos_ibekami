with open('public/js/halaman/spk.js', 'r', encoding='utf-8') as f:
    c = f.read()

c = c.replace("colors: ['#38BDF8', '#818CF8', '#34D399']", "colors: ['#F59E0B', '#EA580C', '#10B981']")
c = c.replace("borderColor: '#28354A'", "borderColor: 'rgba(255, 255, 255, 0.08)'")

with open('public/js/halaman/spk.js', 'w', encoding='utf-8') as f:
    f.write(c)
print('Updated spk.js chart colors')

