<?php
/**
 * Contact form handler — the /contact/ form posts here through
 * admin-post.php. Validates the nonce + honeypot, mails the office,
 * and redirects back to the page with a status flag.
 */

if (! defined('ABSPATH')) {
    exit;
}

/**
 * The office mailbox — site sender AND default form recipient.
 * Yahoo SMTP rejects mail unless From or Reply-To matches the
 * authenticated mailbox, so this doubles as the From address.
 */
function trezise_contact_mailbox(): string
{
    $to = (string) get_theme_mod('trezise_contact_to', 'treziseinsurance@yahoo.com');
    return is_email($to) ? $to : 'treziseinsurance@yahoo.com';
}

/**
 * Where contact submissions are sent. Filterable — e.g.
 * add_filter('trezise_contact_to', fn() => 'agent@example.com');
 */
function trezise_contact_recipient(): string
{
    return (string) apply_filters('trezise_contact_to', trezise_contact_mailbox());
}

function trezise_handle_contact(): void
{
    $fallback = wp_get_referer() ?: home_url('/contact/');

    // Honeypot — bots fill hidden fields, humans never see it.
    if (! empty($_POST['tz_company'])) {
        wp_safe_redirect($fallback);
        exit;
    }

    if (! isset($_POST['trezise_contact_nonce']) || ! wp_verify_nonce($_POST['trezise_contact_nonce'], 'trezise_contact')) {
        wp_safe_redirect(add_query_arg('sent', '0', $fallback));
        exit;
    }

    $name    = isset($_POST['tz_name']) ? sanitize_text_field(wp_unslash($_POST['tz_name'])) : '';
    $email   = isset($_POST['tz_email']) ? sanitize_email(wp_unslash($_POST['tz_email'])) : '';
    $phone   = isset($_POST['tz_phone']) ? sanitize_text_field(wp_unslash($_POST['tz_phone'])) : '';
    $subject = isset($_POST['tz_subject']) ? sanitize_text_field(wp_unslash($_POST['tz_subject'])) : '';
    $message = isset($_POST['tz_message']) ? sanitize_textarea_field(wp_unslash($_POST['tz_message'])) : '';

    $valid = $name !== '' && $message !== '' && is_email($email);

    if ($valid) {
        $body = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\nSubject: {$subject}\n\n{$message}";
        $valid = wp_mail(
            trezise_contact_recipient(),
            'Website contact: ' . ($subject !== '' ? $subject : 'New message'),
            $body,
            array(
                // Yahoo requires From to match the authenticated mailbox
                'From: Trezise Insurance <' . trezise_contact_mailbox() . '>',
                'Reply-To: ' . $name . ' <' . $email . '>',
            )
        );
    }

    wp_safe_redirect(add_query_arg('sent', $valid ? '1' : '0', $fallback) . '#contact');
    exit;
}

add_action('admin_post_trezise_contact', 'trezise_handle_contact');
add_action('admin_post_nopriv_trezise_contact', 'trezise_handle_contact');
