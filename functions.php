<?php
/**
 * Trezise Insurance theme — setup, assets, menus, Ez IT Core registration.
 */

if (! defined('ABSPATH')) {
    exit;
}

define('TREZISE_VERSION', '1.0.0');
define('TREZISE_DIR', get_template_directory());
define('TREZISE_URI', get_template_directory_uri());

/**
 * Ez IT license-server product identity — create the product in the
 * license dashboard (Products → New product), then paste both values
 * here. Until then the theme runs fine; only licensing/updates wait.
 */
define('TREZISE_PRODUCT_ID', 'F43D2273');
define('TREZISE_API_KEY', 'a443f7ed5b12f284de38');

// License code issued for this site (http://www.treziseinsurance.com) — pre-fills
// the Ez IT → Licenses activation form. Each site/domain gets its own code.
define('TREZISE_LICENSE_CODE', '9D7B3777-6CDF-8143-59E8-4EE70AC4374A');

// ── Ez IT Core registration ─────────────────────────────────────────
if (function_exists('ezit_core')) {
    ezit_core()->register_product([
        'slug'         => get_stylesheet(), // folder name — updater keys off this
        'type'         => 'theme',
        'name'         => 'Trezise Insurance',
        'version'      => TREZISE_VERSION,
        'product_id'   => TREZISE_PRODUCT_ID,
        'api_key'      => TREZISE_API_KEY,
        'license_code' => TREZISE_LICENSE_CODE,
        'uc'           => [
            'accent' => '#5e7140', // --green-dark from the Trezise design system
            'bg'     => get_stylesheet_directory_uri() . '/assets/images/hero.png',
        ],
        // Banner slots core can manage — Ez IT → Settings → Alerts & banners.
        // Defaults mirror what header.php shipped with, so the bar looks
        // identical until someone edits it.
        'slots'        => [
            'enroll' => [
                'label'    => 'Enrollment notice bar',
                'defaults' => [
                    'label'  => 'Annual Enrollment Period',
                    'detail' => 'Oct 15 – Dec 7',
                    'cta'    => 'Schedule a free plan review',
                    'url'    => '/contact/#contact',
                ],
            ],
        ],
        // Site Studio field schema — callable so it resolves after
        // inc/customizer.php loads (registration runs before the
        // require_once lines below).
        'fields'       => 'trezise_studio_fields',
    ]);
}

// ── theme setup ─────────────────────────────────────────────────────
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', ['height' => 200, 'width' => 200, 'flex-height' => true, 'flex-width' => true]);

    register_nav_menus([
        'header-left'  => __('Header — left of tree', 'trezise-insurance'),
        'header-right' => __('Header — right of tree', 'trezise-insurance'),
        'mobile'       => __('Mobile drawer', 'trezise-insurance'),
        'footer'       => __('Footer — quick links', 'trezise-insurance'),
    ]);
});

// ── assets ──────────────────────────────────────────────────────────
add_action('wp_enqueue_scripts', function () {
    // filemtime versioning — every deploy changes ?ver so browsers/CDNs
    // can never serve a stale stylesheet or script
    wp_enqueue_style('trezise-styles', TREZISE_URI . '/assets/css/styles.css', [], (string) filemtime(TREZISE_DIR . '/assets/css/styles.css'));
    wp_enqueue_script('trezise-main', TREZISE_URI . '/assets/js/main.js', [], (string) filemtime(TREZISE_DIR . '/assets/js/main.js'), true);
});

// ── nav rendering ───────────────────────────────────────────────────
require_once TREZISE_DIR . '/inc/home-content.php';
require_once TREZISE_DIR . '/inc/customizer.php';
require_once TREZISE_DIR . '/inc/class-trezise-nav-walker.php';
require_once TREZISE_DIR . '/inc/nav-fallbacks.php';
require_once TREZISE_DIR . '/inc/contact-form.php';

/**
 * Render one of the flat anchor menus. Markup contract: bare <a> tags —
 * the CSS counts on .navlinks being a flex row of anchors, and the
 * scroll choreography keys off the two outer grid columns.
 */
function trezise_nav(string $location, string $fallback): void
{
    wp_nav_menu([
        'theme_location' => $location,
        'container'      => false,
        'items_wrap'     => '%3$s',
        'depth'          => 1,
        'walker'         => new Trezise_Nav_Walker(),
        'fallback_cb'    => $fallback,
    ]);
}
