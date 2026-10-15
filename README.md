# Trezise Insurance — WordPress theme

Port of `index.htm` v3.0. Thin by design: markup + the design system.
Licensing, updates and marketplace come from the **Ez IT Core** plugin
(`../core/ezit-core`), backed by `license.ez-it-solutions.com`.

## Install

1. Zip this folder (or upload it) to `wp-content/themes/` — the directory
   name becomes the theme slug (`Trezise Insurance`).
2. Upload `core/ezit-core/` to `wp-content/plugins/` and activate it.
3. Appearance → Themes → activate **Trezise Insurance**.
4. Optional: Appearance → Menus — assign menus to *Header — left of tree*,
   *Header — right of tree*, *Mobile drawer*, *Footer — quick links*.
   Without them the original anchors render automatically.
5. Settings → Reading — no config needed; `front-page.php` is the
   homepage by default (works with latest-posts or a static front page).

## Licensing

1. In the license dashboard: **Products → New product** for
   `Trezise Insurance`; copy the generated `product_id` and `api_key`.
2. Paste both into `functions.php` (`TREZISE_PRODUCT_ID`, `TREZISE_API_KEY`).
3. Create a license in the dashboard, then on the site:
   **Ez IT → Licenses → Activate**.

After that, theme updates surface in **Dashboard → Updates** like any
WordPress theme, downloaded through the licensed endpoint.

## Structure

| File | Purpose |
|---|---|
| `style.css` | theme header only — design system is `assets/css/styles.css` |
| `functions.php` | setup, menus, enqueues, `register_product()` |
| `inc/` | nav walker (bare `<a>` output) + menu fallbacks |
| `header.php` / `footer.php` | utility bar, header, drawer, emblem layers, footer |
| `front-page.php` | the full landing page sections |
| `index/page/single/404/search/comments.php` | standard fallbacks |
| `assets/` | `css/styles.css`, `js/main.js`, `images/` (copied from site root) |

## Notes

- `screenshot.png` (1200×900) powers the Appearance → Themes tile.
- Homepage copy is editable via **Appearance → Customize → Trezise —
  Homepage** (`inc/customizer.php`); fields write theme mods and blank
  fields fall back to the defaults in `inc/home-content.php`.
- The scroll choreography (`--p`, `--hb`, `--vvo`, snap) is untouched —
  `assets/js/main.js` is identical to the shipped site.
