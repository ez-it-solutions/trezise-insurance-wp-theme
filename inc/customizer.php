<?php
/**
 * Customizer — "Homepage" panel exposing every front-page field
 * registered in trezise_home_defaults() for backend editing.
 */

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Section layout: customizer section => label => field keys.
 * Field types: keys ending _desc/_a/_body/_quote/_intro/_subtitle get textareas.
 */
function trezise_home_sections(): array
{
    return array(
        'hero'     => array('Hero', array('hero_eyebrow', 'hero_title', 'hero_subtitle', 'hero_cta1', 'hero_cta2')),
        'trust'    => array('Trust Strip', array('stat1_num', 'stat1_label', 'stat2_num', 'stat2_label', 'stat3_num', 'stat3_label', 'stat4_num', 'stat4_label')),
        'services' => array('Services', array('svc_kicker', 'svc_title', 'svc_intro', 'svc1_title', 'svc1_desc', 'svc2_title', 'svc2_desc', 'svc3_title', 'svc3_desc', 'svc4_title', 'svc4_desc', 'svc_cta')),
        'about'    => array('About Preview', array('about_kicker', 'about_title', 'about_body1', 'about_body2', 'about_quote', 'about_cta')),
        'why'      => array('Why Trezise', array('why_kicker', 'why_title', 'why_intro', 'why1_title', 'why1_desc', 'why2_title', 'why2_desc', 'why3_title', 'why3_desc', 'why4_title', 'why4_desc')),
        'faq'      => array('FAQ Preview', array('faq_kicker', 'faq_title', 'faq1_q', 'faq1_a', 'faq2_q', 'faq2_a', 'faq3_q', 'faq3_a', 'faq_more')),
        'cta'      => array('CTA Band', array('cta_kicker', 'cta_title', 'cta_body', 'cta_note')),
    );
}

/**
 * Human-friendly control label for a field key.
 */
function trezise_field_label(string $key): string
{
    return ucwords(str_replace('_', ' ', $key));
}

/**
 * Long-form copy gets a textarea — shared by the Customizer and the
 * Studio schema so a new key needs no type flag.
 */
function trezise_field_type(string $key): string
{
    return preg_match('/_(desc|a[0-9]?|body[0-9]?|quote|intro|subtitle)$/', $key)
        ? 'textarea'
        : 'text';
}

/**
 * Site Studio schema — the same section map the Customizer renders,
 * exposed to Ez IT Core so Settings → Site Studio edits the identical
 * theme mods (trezise_<key>).
 */
function trezise_studio_fields(): array
{
    $sections = array();
    foreach (trezise_home_sections() as $id => $config) {
        list($label, $keys) = $config;
        $fields = array();
        foreach ($keys as $key) {
            $fields[$key] = array(
                'label' => trezise_field_label($key),
                'type'  => trezise_field_type($key),
            );
        }
        $sections[$id] = array('label' => $label, 'fields' => $fields);
    }

    return array(
        'title'      => 'Homepage content',
        'mod_prefix' => 'trezise_',
        'sections'   => $sections,
        'defaults'   => trezise_home_defaults(),
    );
}

add_action('customize_register', function (WP_Customize_Manager $wp): void {
    $defaults = trezise_home_defaults();

    $wp->add_panel('trezise_home', array(
        'title'       => __('Trezise — Homepage', 'trezise-insurance'),
        'description' => __('Edit the copy for each section of the front page. Leave a field blank to restore its default text.', 'trezise-insurance'),
        'priority'    => 30,
    ));

    // Footer credit — same theme mods Ez IT Core manages (ezit_credit_*),
    // so this section and Ez IT → Themes edit one shared setting.
    $wp->add_section('trezise_credit', array(
        'title'       => __('Footer Credit', 'trezise-insurance'),
        'priority'    => 160,
        'description' => __('Toggle the "Made with ♥ by Ez IT Solutions" credit, or change the credited name.', 'trezise-insurance'),
    ));
    $wp->add_setting('ezit_credit_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp->add_control('ezit_credit_enabled', array(
        'label'   => __('Show the footer credit', 'trezise-insurance'),
        'section' => 'trezise_credit',
        'type'    => 'checkbox',
    ));
    $wp->add_setting('ezit_credit_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp->add_control('ezit_credit_text', array(
        'label'       => __('Credit text', 'trezise-insurance'),
        'description' => __('Leave blank for "Ez IT Solutions".', 'trezise-insurance'),
        'section'     => 'trezise_credit',
        'type'        => 'text',
    ));

    foreach (trezise_home_sections() as $section_id => $config) {
        list($label, $keys) = $config;

        $wp->add_section('trezise_home_' . $section_id, array(
            'title' => $label,
            'panel' => 'trezise_home',
        ));

        foreach ($keys as $key) {
            $setting = 'trezise_' . $key;
            $is_long = trezise_field_type($key) === 'textarea';

            $wp->add_setting($setting, array(
                'default'           => isset($defaults[$key]) ? $defaults[$key] : '',
                'sanitize_callback' => 'sanitize_textarea_field',
            ));

            $wp->add_control($setting, array(
                'label'   => trezise_field_label($key),
                'section' => 'trezise_home_' . $section_id,
                'type'    => $is_long ? 'textarea' : 'text',
            ));
        }
    }
});
