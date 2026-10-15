<?php
/**
 * Homepage content — single source of truth for front-page.php copy.
 *
 * Every string is overridable from Appearance → Customize → Homepage.
 * Defaults mirror the live site's copy (treziseinsurance.com / v2).
 */

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Default copy for every editable homepage field.
 *
 * @return array<string,string>
 */
function trezise_home_defaults(): array
{
    return array(
        // Hero
        'hero_eyebrow'   => 'Independent Insurance Agency · Jacksonville, Texas',
        'hero_title'     => 'Your trusted insurance partner in East Texas.',
        'hero_subtitle'  => 'Over 27 years of combined experience helping individuals and families find the right Medicare and ACA coverage — with steady guidance from a local team that believes relationships matter.',
        'hero_cta1'      => 'Schedule a Free Consultation',
        'hero_cta2'      => 'Call (903) 284-2821',

        // Trust strip
        'stat1_num'      => '27+',
        'stat1_label'    => 'Combined years serving East Texas families',
        'stat2_num'      => 'Medicare',
        'stat2_label'    => 'Advantage, Supplement & Part D guidance',
        'stat3_num'      => 'ACA',
        'stat3_label'    => 'Marketplace plans & enrollment help',
        'stat4_num'      => 'Other Products',
        'stat4_label'    => 'Life, dental, burial, cancer, heart & stroke coverage',

        // Services
        'svc_kicker'     => 'Our insurance services',
        'svc_title'      => 'Coverage made simpler — start where you need the most help.',
        'svc_intro'      => 'Instead of overwhelming you with choices, we guide you into the few services most likely to fit your needs.',
        'svc1_title'     => 'Medicare Insurance',
        'svc1_desc'      => 'Expert guidance through Medicare options — Advantage plans, Supplement plans, and Part D prescription coverage.',
        // svc icons are fixed SVGs in front-page.php
        'svc2_title'     => 'Individual Health Plans',
        'svc2_desc'      => 'On- and off-Marketplace options — we help you compare plans, check subsidy eligibility, and find affordable coverage that meets your needs.',
        'svc3_title'     => 'Personalized Consultation',
        'svc3_desc'      => 'One-on-one guidance to understand your options and make informed decisions — at no cost to you.',
        'svc4_title'     => 'Ongoing Support',
        'svc4_desc'      => 'Continuous support so your coverage keeps fitting your life — annual reviews, claims help, and adjustments for life changes.',
        'svc_cta'        => 'Talk with an agent',

        // About preview
        'about_kicker'   => 'About Trezise Insurance',
        'about_title'    => 'Deep roots in Jacksonville.',
        'about_body1'    => 'Mark and Kristie Trezise serve the East Texas community with dedication and expertise — over 27 years of combined experience. As independent insurance brokers, they’ve built their reputation on personalized service and trusted guidance in Medicare and ACA solutions.',
        'about_body2'    => 'Our journey began in 2006 with Mark, and Kristie joined him in 2019. Since then, we’ve helped hundreds of East Texas families find coverage that fits their lives.',
        'about_quote'    => '“Mark and Kristie have been helping individuals and families navigate Medicare and Individual Health insurance with personal guidance and local care for over 27 years combined.”',
        'about_cta'      => 'Meet the Team',

        // Why Trezise
        'why_kicker'     => 'Why Trezise',
        'why_title'      => 'Why families choose Trezise Insurance.',
        'why_intro'      => 'We are independent brokers — we work for you, not the insurance companies. That means honest comparisons, plain-language answers, and a real person when you need one.',
        'why1_title'     => '27 Years of Combined Experience',
        'why1_desc'      => 'Mark began in 2006 and Kristie joined in 2019 — trusted by East Texas families ever since.',
        'why2_title'     => 'Local Expertise',
        'why2_desc'      => 'Deep understanding of East Texas healthcare needs and options.',
        'why3_title'     => 'Personalized Service',
        'why3_desc'      => 'We take time to understand your unique needs and find the perfect coverage.',
        'why4_title'     => 'No Extra Fees',
        'why4_desc'      => 'Our services are provided at no additional cost to you — we’re compensated by the carriers, never by you.',

        // FAQ preview
        'faq_kicker'     => 'Common questions',
        'faq_title'      => 'Answers before you even ask.',
        'faq1_q'         => 'Do your services cost me anything?',
        'faq1_a'         => 'No. As independent brokers we’re compensated by the insurance carriers — our guidance, plan comparisons, and enrollment help come at no additional cost to you.',
        'faq2_q'         => 'When can I enroll in or change a Medicare plan?',
        'faq2_a'         => 'Most people enroll during their Initial Enrollment Period around age 65, or during the Annual Enrollment Period each fall. Certain life events may qualify you for a Special Enrollment Period — we’ll help you find out.',
        'faq3_q'         => 'What’s the difference between Medicare Advantage and a Medicare Supplement?',
        'faq3_a'         => 'Medicare Advantage usually costs less to own and potentially more to use, while Medicare Supplements cost more to own and generally less to use. We can walk you through more differences — which one fits is defined by your specific medical needs.',
        'faq_more'       => 'See All FAQs',

        // CTA band
        'cta_kicker'     => 'Ready to talk?',
        'cta_title'      => 'Let’s find your perfect coverage.',
        'cta_body'       => 'Contact us today for a free consultation with our experienced insurance experts — no pressure, no obligation.',
        'cta_note'       => 'Licensed & local · Jacksonville, Texas',
    );
}

/**
 * Fetch a homepage field — theme_mod value or the default copy.
 */
function trezise_get(string $key): string
{
    $defaults = trezise_home_defaults();
    $fallback = isset($defaults[$key]) ? $defaults[$key] : '';

    return (string) get_theme_mod('trezise_' . $key, $fallback);
}

/**
 * Echo an escaped homepage field.
 */
function trezise_field(string $key): void
{
    echo esc_html(trezise_get($key));
}

/**
 * Resolve a link to a WP page by slug, falling back to an on-page anchor
 * until that page exists. Lets the nav auto-upgrade as pages are built.
 */
function trezise_link(string $slug, string $fallback_anchor): string
{
    $slug = trim($slug, '/');
    $page = get_page_by_path($slug);

    if (! $page) {
        // Slug missed — try matching a published page by name or title
        // so e.g. '/about/' still resolves an 'About Us' page.
        $pages = get_posts(array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 100,
        ));

        foreach ($pages as $candidate) {
            $title_slug = sanitize_title($candidate->post_title);
            if ($candidate->post_name === $slug || $title_slug === $slug || str_starts_with($title_slug, $slug . '-')) {
                $page = $candidate;
                break;
            }
        }
    }

    if ($page) {
        return get_permalink($page);
    }

    // Anchor fallbacks resolve on the front page; anything else
    // (mailto:, tel:, absolute URLs) is returned verbatim.
    if (str_starts_with($fallback_anchor, '#')) {
        return home_url('/') . $fallback_anchor;
    }

    return $fallback_anchor;
}
