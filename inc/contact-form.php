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
    $ajax = strtolower(sanitize_text_field($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '')) === 'xmlhttprequest';

    // One exit path — JSON for the fetch() submit, redirect fallback
    // for no-JS so the form still works everywhere. A failure $code is
    // appended for logged-in users only — visitors get the plain message.
    $respond = static function (bool $ok, string $code = '') use ($ajax): void {
        if ($ajax) {
            if ($ok) {
                wp_send_json_success(['message' => __('Thanks — your message is on its way. We’ll get back to you soon.', 'trezise-insurance')]);
            }
            $msg = __('Something didn’t go through. Please try again, or call us directly.', 'trezise-insurance');
            if ($code !== '' && is_user_logged_in()) {
                $msg .= ' [' . $code . ']';
            }
            wp_send_json_error(['message' => $msg]);
        }
        $fallback = wp_get_referer() ?: home_url('/contact/');
        $args = ['contact' => $ok ? 'sent' : 'failed'];
        if (! $ok && $code !== '' && is_user_logged_in()) {
            $args['why'] = $code;
        }
        wp_safe_redirect(add_query_arg($args, $fallback) . '#contact');
        exit;
    };

    // ── bot defenses ──────────────────────────────────────────────
    // 1) Honeypot — bots fill hidden fields, humans never see it.
    if (! empty($_POST['tz_company'])) {
        $respond(true); // fake success — don't teach the bot it failed
    }

    // 2) Signed render timestamp — the real anti-forgery gate. The HMAC
    //    can't be produced without wp_salt, and the >= 3s minimum defeats
    //    instant bot posts. (A nonce would break on cached pages serving
    //    a stale/session-mismatched token — the signature doesn't care.)
    $ts  = (int) ($_POST['tz_ts'] ?? 0);
    $sig = sanitize_text_field(wp_unslash($_POST['tz_sig'] ?? ''));
    $ok_sig = $ts > 0 && hash_equals(hash_hmac('sha256', (string) $ts, wp_salt('auth')), $sig);
    if (! $ok_sig || time() - $ts < 3 || $ts > time() + 300) {
        $respond(true); // racing/forged bot — fake success
    }

    // 3) Per-IP rate limit — 3 submissions/hour. Logged-in admins are
    //    exempt: the site owner testing their own form isn't a bot.
    $is_admin = is_user_logged_in() && current_user_can('manage_options');
    if (! $is_admin) {
        $key  = 'tz_cf_' . md5(sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? ''));
        $hits = (int) get_transient($key);
        if ($hits >= 3) {
            if ($ajax) {
                wp_send_json_error(['message' => __('Too many messages — please call us, or try again in a little while.', 'trezise-insurance')]);
            }
            wp_safe_redirect(add_query_arg('contact', 'failed', wp_get_referer() ?: home_url('/contact/')) . '#contact');
            exit;
        }
        set_transient($key, $hits + 1, HOUR_IN_SECONDS);
    }

    $name    = isset($_POST['tz_name']) ? sanitize_text_field(wp_unslash($_POST['tz_name'])) : '';
    $email   = isset($_POST['tz_email']) ? sanitize_email(wp_unslash($_POST['tz_email'])) : '';
    $phone   = isset($_POST['tz_phone']) ? sanitize_text_field(wp_unslash($_POST['tz_phone'])) : '';
    $subject = isset($_POST['tz_subject']) ? sanitize_text_field(wp_unslash($_POST['tz_subject'])) : '';
    $message = isset($_POST['tz_message']) ? sanitize_textarea_field(wp_unslash($_POST['tz_message'])) : '';

    if (! ($name !== '' && $message !== '' && is_email($email))) {
        $respond(false, 'invalid');
    }

    $body = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\nSubject: {$subject}\n\n{$message}";
    $ok = wp_mail(
        trezise_contact_recipient(),
        'Website contact: ' . ($subject !== '' ? $subject : 'New message'),
        $body,
        // Yahoo rejects the mail unless EVERY From/Reply-To header
        // matches the authenticated mailbox — so no Reply-To; the
        // visitor's address is already in the body above.
        array('From: Trezise Insurance <' . trezise_contact_mailbox() . '>')
    );

    $respond($ok, $ok ? '' : 'mail');
}

add_action('admin_post_trezise_contact', 'trezise_handle_contact');
add_action('admin_post_nopriv_trezise_contact', 'trezise_handle_contact');
