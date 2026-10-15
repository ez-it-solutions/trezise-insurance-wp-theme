<?php
/**
 * Trezise_Nav_Walker — emits bare <a> elements, no <ul>/<li> chrome.
 * The header/drawer layouts are flex rows of anchors; list markup
 * would break the grid choreography.
 */

if (! defined('ABSPATH')) {
    exit;
}

class Trezise_Nav_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null): void
    {
        // flat menus only — depth is capped at 1 in trezise_nav()
    }

    public function end_lvl(&$output, $depth = 0, $args = null): void
    {
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0): void
    {
        // mark current ourselves — WP's $item->current flag is unreliable
        // here (custom links, anchor links, front-page children). The
        // item is current when its path IS the request path; home-path
        // items only count on the front page, and fragment links never
        // claim a whole page.
        $req    = trailingslashit((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
        $home   = trailingslashit((string) wp_parse_url(home_url('/'), PHP_URL_PATH));
        $target = trailingslashit((string) wp_parse_url($item->url, PHP_URL_PATH));
        $frag   = wp_parse_url($item->url, PHP_URL_FRAGMENT);
        $current = ($target === $home)
            ? (is_front_page() && ! $frag)
            : ($req === $target);
        $classes = $current ? ' class="tz-current"' : '';
        $output .= sprintf(
            '<a href="%s"%s>%s</a>',
            esc_url($item->url),
            $classes,
            esc_html($item->title)
        );
    }

    public function end_el(&$output, $item, $depth = 0, $args = null): void
    {
        // anchors self-close — nothing to emit
    }
}
