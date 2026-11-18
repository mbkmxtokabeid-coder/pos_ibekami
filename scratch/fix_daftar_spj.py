# fix_daftar_spj.py
with open('resources/views/pages/SPJ/daftar-spj.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

# 1. Add table tokens in :root
root_old = """      --ibk-input-bg: rgba(255, 255, 255, 0.04);
      --ibk-input-border: rgba(255, 255, 255, 0.12);
      --ibk-input-text: #FAFAFA;
      --ibk-popover-bg: #181412;
    }"""

root_new = """      --ibk-input-bg: rgba(255, 255, 255, 0.04);
      --ibk-input-border: rgba(255, 255, 255, 0.12);
      --ibk-input-text: #FAFAFA;
      --ibk-popover-bg: #181412;

      /* Table Variables */
      --ibk-th-bg: #14110F;
      --ibk-th-text: #A1A1AA;
      --ibk-td-border: rgba(255, 255, 255, 0.08);
    }"""

text = text.replace(root_old, root_new)

# 2. Add table tokens in body.theme-light
light_old = """      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #CBD5E1;
      --ibk-input-text: #0F172A;
      --ibk-popover-bg: #FFFFFF;
    }"""

light_new = """      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #DDD6CE;
      --ibk-input-text: #0F172A;
      --ibk-popover-bg: #FFFFFF;

      /* Warm Stone Table Header (Matched to Daftar Vendor) */
      --ibk-th-bg: #F3EFE6;
      --ibk-th-text: #64748B;
      --ibk-td-border: #EAE4DC;
    }"""

text = text.replace(light_old, light_new)

# 3. Update .tokabe-table thead th to use var(--ibk-th-bg)
th_old = """    .tokabe-table thead th {
      background: var(--ibk-surface) !important;
      color: var(--ibk-text-dim) !important;
      font-size: 11.5px !important;
      font-weight: 600 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.05em !important;
      padding: 12px 14px !important;
      border-bottom: 1px solid var(--ibk-border) !important;
      border-top: none !important;
      white-space: nowrap !important;
    }"""

th_new = """    .tokabe-table thead th {
      background: var(--ibk-th-bg) !important;
      color: var(--ibk-th-text, var(--ibk-text-dim)) !important;
      font-size: 11.5px !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.05em !important;
      padding: 12px 16px !important;
      border-bottom: 1px solid var(--ibk-td-border, var(--ibk-border)) !important;
      border-top: none !important;
      white-space: nowrap !important;
    }
    .tokabe-table tbody td {
      border-bottom: 1px solid var(--ibk-td-border, var(--ibk-border-subtle)) !important;
    }"""

text = text.replace(th_old, th_new)

# 4. Enhance DataTables styles for clean layout
dt_old = """    /* DataTables Custom Controls */
    .dataTables_wrapper {
      padding: 14px 16px;
      color: var(--ibk-text-muted) !important;
    }
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
      margin-bottom: 12px;
    }
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 6px !important;
      padding: 4px 8px !important;
      font-size: 13px !important;
      outline: none !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
      border-color: var(--ibk-brand) !important;
    }"""

dt_new = """    /* DataTables Custom Controls (Clean & Aligned) */
    .dataTables_wrapper {
      padding: 16px 20px;
      color: var(--ibk-text-muted) !important;
    }
    .dataTables_wrapper .dataTables_length {
      float: left !important;
      margin-bottom: 14px !important;
    }
    .dataTables_wrapper .dataTables_filter {
      float: right !important;
      margin-bottom: 14px !important;
    }
    .dataTables_wrapper .dataTables_length select {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 4px 24px 4px 10px !important;
      font-size: 13px !important;
      height: 36px !important;
      outline: none !important;
      cursor: pointer;
    }
    .dataTables_wrapper .dataTables_filter input {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 6px 14px !important;
      margin-left: 8px !important;
      font-size: 13px !important;
      height: 36px !important;
      outline: none !important;
      width: 220px !important;
      transition: all 0.15s ease;
    }
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15) !important;
    }
    .dataTables_wrapper::after {
      content: "";
      display: table;
      clear: both;
    }"""

text = text.replace(dt_old, dt_new)

with open('resources/views/pages/SPJ/daftar-spj.blade.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Updated resources/views/pages/SPJ/daftar-spj.blade.php")

