#!/usr/bin/env python3
"""Replace the template nav menus with the Mobilier Addict menu."""
import re
import glob
import os

SITE = "https://mobilier-addict.com"

MENU_ITEMS = [
    ("Accueil", f"{SITE}/menu"),
    ("Matelas", f"{SITE}/menu/matelas"),
    ("Oreillers et taies", f"{SITE}/menu/oreillers-et-taies"),
    ("Drap et Couettes", f"{SITE}/menu/drap-et-couettes"),
    ("Mobiliers &amp; Accessoires", f"{SITE}/menu/mobilier-accessoire"),
    ("Électroménager", f"{SITE}/menu/electromenager"),
]

CATEGORY_ITEMS = MENU_ITEMS[1:]  # product categories only (no Accueil)

UL_OPEN = re.compile(r'^(?P<indent>[ \t]*)<ul class="main-menu list-unstyled[^"]*">', re.M)


def find_ul_end(text, start):
    """Return index just after the </ul> matching the <ul at `start`."""
    depth = 0
    for m in re.finditer(r'<ul[\s>]|</ul>', text[start:]):
        tok = m.group(0)
        depth += -1 if tok == '</ul>' else 1
        if depth == 0:
            return start + m.end()
    raise ValueError("no matching </ul>")


def build_menu(ul_tag, indent, items, link_extra=""):
    lines = [f'{indent}{ul_tag}']
    for i, (label, url) in enumerate(items):
        active_li = ' active' if i == 0 else ''
        active_a = ' active' if (i == 0 and 'justify-content-center' not in ul_tag) else ''
        lines.append(f'{indent}  <li class="menu-list-item nav-item{active_li}">')
        lines.append(f'{indent}    <a class="nav-link{link_extra}{active_a}" href="{url}"> {label} </a>')
        lines.append(f'{indent}  </li>')
    lines.append(f'{indent}</ul>')
    return '\n'.join(lines)


changed_files = []
for path in sorted(glob.glob('*.html')):
    with open(path, encoding='utf-8') as f:
        text = f.read()

    matches = list(UL_OPEN.finditer(text))
    if not matches:
        continue

    # Process from last match to first so offsets stay valid
    count = 0
    for idx in range(len(matches) - 1, -1, -1):
        m = matches[idx]
        ul_tag = m.group(0)[len(m.group('indent')):]
        indent = m.group('indent')
        end = find_ul_end(text, m.start(0))

        is_category_tab = (path == 'index-electronics.html' and idx == 2)
        items = CATEGORY_ITEMS if is_category_tab else MENU_ITEMS
        extra = ' text_16' if is_category_tab else ''

        new_block = build_menu(ul_tag, indent, items, extra)
        text = text[:m.start(0)] + new_block + text[end:]
        count += 1

    with open(path, 'w', encoding='utf-8') as f:
        f.write(text)
    changed_files.append(f"{path}: {count} menu(s)")
    print(f"{path}: {count} menu(s) replaced")

print(f"\nDone: {len(changed_files)} files")
