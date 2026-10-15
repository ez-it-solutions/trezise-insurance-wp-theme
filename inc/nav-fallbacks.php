<?php
/**
 * Menu fallbacks — sensible defaults so a fresh install renders correctly
 * before any WP menu is assigned. Links resolve through trezise_link(),
 * which prefers the real page permalink once the page exists and falls
 * back to the front-page anchor until then.
 */

if (! defined('ABSPATH')) {
    exit;
}

function trezise_nav_current(string $slug): string
{
    $current = ('/' === $slug && is_front_page())
        || ('/' !== $slug && is_page(trim($slug, '/')));
    return $current ? ' class="tz-current"' : '';
}

function trezise_fallback_header_left(): void
{
    echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'trezise-insurance') . '</a>';
    echo '<a href="' . esc_url(trezise_link('/services/', '#services')) . '">' . esc_html__('Services', 'trezise-insurance') . '</a>';
}

function trezise_fallback_header_right(): void
{
    echo '<a href="' . esc_url(trezise_link('/about/', '#about')) . '">' . esc_html__('About Us', 'trezise-insurance') . '</a>';
    echo '<a href="' . esc_url(trezise_link('/contact/', '#contact')) . '">' . esc_html__('Contact', 'trezise-insurance') . '</a>';
}

function trezise_fallback_mobile(): void
{
    echo '<a href="' . esc_url(home_url('/')) . '"' . trezise_nav_current('/') . '>' . esc_html__('Home', 'trezise-insurance') . '</a>';
    echo '<a href="' . esc_url(trezise_link('/services/', '#services')) . '"' . trezise_nav_current('/services/') . '>' . esc_html__('Services', 'trezise-insurance') . '</a>';
    echo '<a href="' . esc_url(trezise_link('/about/', '#about')) . '"' . trezise_nav_current('/about/') . '>' . esc_html__('About Us', 'trezise-insurance') . '</a>';
    echo '<a href="' . esc_url(trezise_link('/faqs/', '#faqs')) . '"' . trezise_nav_current('/faqs/') . '>' . esc_html__('FAQs', 'trezise-insurance') . '</a>';
    echo '<a href="' . esc_url(trezise_link('/contact/', '#contact')) . '"' . trezise_nav_current('/contact/') . '>' . esc_html__('Contact', 'trezise-insurance') . '</a>';
}

function trezise_fallback_footer(): void
{
    echo '<p>'
       . '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'trezise-insurance') . '</a><br>'
       . '<a href="' . esc_url(trezise_link('/services/', '#services')) . '">' . esc_html__('Services', 'trezise-insurance') . '</a><br>'
       . '<a href="' . esc_url(trezise_link('/about/', '#about')) . '">' . esc_html__('About Us', 'trezise-insurance') . '</a><br>'
       . '<a href="' . esc_url(trezise_link('/faqs/', '#faqs')) . '">' . esc_html__('FAQs', 'trezise-insurance') . '</a><br>'
       . '<a href="' . esc_url(trezise_link('/contact/', '#contact')) . '">' . esc_html__('Contact', 'trezise-insurance') . '</a>'
       . '</p>';
}
