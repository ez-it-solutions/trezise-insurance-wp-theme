<?php
/**
 * Header — utility bar, desktop header, mobile drawer, emblem layers.
 * Ported 1:1 from index.htm; menus resolve via trezise_nav() with the
 * original anchors as fallback.
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="icon" href="<?php echo esc_url(TREZISE_URI); ?>/assets/images/logo.ico" sizes="any">
<link rel="icon" href="<?php echo esc_url(TREZISE_URI); ?>/assets/images/logo.svg" type="image/svg+xml">
<link rel="preload" as="image" href="<?php echo esc_url(TREZISE_URI); ?>/assets/images/hero.png" fetchpriority="high">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="tz-utility"><div class="tz-utility-inner">
  <span class="tz-util-left"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg><?php esc_html_e('Independent guidance for Medicare, health & life coverage', 'trezise-insurance'); ?></span>
  <a class="tz-util-right" href="tel:9032842821"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><?php esc_html_e('Speak with a local agent:', 'trezise-insurance'); ?> <strong>(903) 284-2821</strong></a>
</div></div>
<?php
// Enrollment notice bar — managed via Ez IT → Settings → Alerts & banners
// (slot 'enroll'). ezit_slot() returns null when the bar is off or outside
// its schedule window; without Ez IT Core the theme's own defaults show.
$enroll = function_exists('ezit_slot') ? ezit_slot('enroll') : [
    'label' => 'Annual Enrollment Period', 'detail' => 'Oct 15 – Dec 7',
    'cta'   => 'Schedule a free plan review', 'url' => '/contact/#contact',
];
if ($enroll) :
    $e_url = isset($enroll['url']) && $enroll['url'] !== ''
        ? (str_starts_with((string) $enroll['url'], '/') ? home_url($enroll['url']) : $enroll['url'])
        : home_url('/contact/#contact');
?>
<div class="tz-enroll"><a href="<?php echo esc_url($e_url); ?>"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3.5" y="5" width="17" height="16" rx="2"/><path d="M3.5 10h17M8.5 2.5v5M15.5 2.5v5"/></svg><span class="tz-enroll-label"><?php echo esc_html($enroll['label'] ?? ''); ?> <strong><?php echo esc_html($enroll['detail'] ?? ''); ?></strong></span><span class="tz-enroll-cta"><?php echo esc_html($enroll['cta'] ?? ''); ?> &rarr;</span></a></div>
<?php endif; ?>
<header class="tz-header" id="siteHeader">
  <nav class="tz-nav" aria-label="<?php esc_attr_e('Primary navigation', 'trezise-insurance'); ?>">
    <div class="tz-brand-name"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Trezise', 'trezise-insurance'); ?> <span><?php esc_html_e('Insurance', 'trezise-insurance'); ?></span></a></div>
    <div class="tz-navlinks tz-left"><?php trezise_nav('header-left', 'trezise_fallback_header_left'); ?></div>
    <div class="tz-tree-slot">
      <div class="tz-tree-shadow" aria-hidden="true"></div>
      <a class="tz-header-tree" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Trezise Insurance home', 'trezise-insurance'); ?>"><img src="<?php echo esc_url(TREZISE_URI); ?>/assets/images/logo.svg" alt=""></a>
    </div>
    <span class="tz-rest-side tz-left"><?php esc_html_e('Independent Insurance Guidance', 'trezise-insurance'); ?></span>
    <span class="tz-rest-side tz-right"><?php esc_html_e('Jacksonville, Texas', 'trezise-insurance'); ?></span>
    <div class="tz-navlinks tz-right"><?php trezise_nav('header-right', 'trezise_fallback_header_right'); ?></div>
  </nav>
</header>
<button class="tz-menu-btn" id="menuBtn" type="button" aria-label="<?php esc_attr_e('Open menu', 'trezise-insurance'); ?>" aria-expanded="false"><span></span><span></span><span></span></button>
<div class="tz-drawer-veil" id="drawerVeil" aria-hidden="true"></div>
<aside class="tz-mobile-menu" id="mobileMenu" aria-label="<?php esc_attr_e('Menu', 'trezise-insurance'); ?>">
  <div class="tz-drawer-head">
    <span class="tz-drawer-brand"><?php bloginfo('name'); ?></span>
  </div>
  <nav class="tz-drawer-nav" aria-label="<?php esc_attr_e('Mobile navigation', 'trezise-insurance'); ?>">
    <?php trezise_nav('mobile', 'trezise_fallback_mobile'); ?>
  </nav>
  <div class="tz-drawer-mark">
    <img src="<?php echo esc_url(TREZISE_URI); ?>/assets/images/logo.svg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
    <p><?php esc_html_e('Independent guidance for Medicare, health, life, and supplemental coverage from a local team that treats you like a neighbor.', 'trezise-insurance'); ?></p>
  </div>
  <div class="tz-drawer-actions">
    <a class="tz-drawer-btn tz-ghost" href="tel:9032842821">(903) 284-2821</a>
    <a class="tz-drawer-btn tz-solid" href="<?php echo esc_url(home_url('/#contact')); ?>"><?php esc_html_e('Get a Free Consultation', 'trezise-insurance'); ?></a>
  </div>
</aside>
<?php if (is_front_page()) : // scroll emblem layers — homepage only ?>
<div class="tz-wordmark-veil" aria-hidden="true"></div>
<div class="tz-hero-wordmark" aria-hidden="true"><img src="<?php echo esc_url(TREZISE_URI); ?>/assets/images/logo.svg" alt=""></div>
<div class="tz-hero-roots" aria-hidden="true"><img src="<?php echo esc_url(TREZISE_URI); ?>/assets/images/logo.svg" alt=""></div>
<?php endif; ?>
