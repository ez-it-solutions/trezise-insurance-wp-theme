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
 * Contact form recipients — comma/semicolon-separated list from the
 * trezise_contact_to theme mod (Ez IT → Settings → Site Studio →
 * Contact, or Customizer → Contact Form). Filterable via
 * 'trezise_contact_to'.
 *
 * @return string[] sanitized email list, at least one entry.
 */
function trezise_contact_recipients(): array
{
    $raw  = (string) get_theme_mod('trezise_contact_to', 'treziseinsurance@yahoo.com');
    $list = array_values(array_filter(array_map('sanitize_email', preg_split('/[\s,;]+/', $raw))));
    if ($list === []) {
        $list = ['treziseinsurance@yahoo.com'];
    }
    return (array) apply_filters('trezise_contact_to', $list);
}

/**
 * The sending mailbox — Yahoo SMTP rejects mail unless every From /
 * Reply-To matches the authenticated mailbox, so the From address is
 * always the FIRST configured recipient.
 */
function trezise_contact_mailbox(): string
{
    return trezise_contact_recipients()[0];
}

/** Customizer sanitize callback — keeps a clean comma-separated list. */
function trezise_sanitize_email_list($raw): string
{
    $list = array_filter(array_map('sanitize_email', preg_split('/[\s,;]+/', (string) $raw)));
    return implode(', ', $list);
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
    // Honeypot — real users never fill this. Bots get a fake success
    // so nothing tips them off, but the attempt is still logged.
    if (! empty($_POST['tz_company'])) {
        if (class_exists('EzIT_Mail_Log')) {
            EzIT_Mail_Log::note('blocked', '', 'Contact form', 'Honeypot filled');
        }
        $respond(true);
    }

    // 2) Signed render timestamp — the real anti-forgery gate. The HMAC
    //    can't be produced without wp_salt, and the >= 3s minimum defeats
    //    instant bot posts. (A nonce would break on cached pages serving
    //    a stale/session-mismatched token — the signature doesn't care.)
    $ts  = (int) ($_POST['tz_ts'] ?? 0);
    $sig = sanitize_text_field(wp_unslash($_POST['tz_sig'] ?? ''));
    $ok_sig = $ts > 0 && hash_equals(hash_hmac('sha256', (string) $ts, wp_salt('auth')), $sig);
    if (! $ok_sig || time() - $ts < 3 || $ts > time() + 300) {
        if (class_exists('EzIT_Mail_Log')) {
            EzIT_Mail_Log::note('blocked', '', 'Contact form',
                $ts === 0 ? 'Missing tz_ts/tz_sig — cached page or forged post'
                          : (! $ok_sig ? 'Bad signature' : (time() - $ts < 3 ? 'Under 3s fill time' : 'Future timestamp')));
        }
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

    $heading = 'Website contact: ' . ($subject !== '' ? $subject : 'New message');

    // Branded HTML mail — theme palette: paper card on cream, green
    // rule, brown heading. Tables + inline styles only; email clients
    // strip <style> blocks and flexbox.
    $logo    = get_stylesheet_directory_uri() . '/assets/images/logo.svg';
    $site    = esc_url(home_url());
    $esc_msg = nl2br(esc_html($message));
    $esc_heading = esc_html($heading);
    $esc_name    = esc_html($name);
    $esc_email   = esc_html($email);
    $esc_phone   = esc_html($phone !== '' ? $phone : '—');
    $esc_subject = esc_html($subject !== '' ? $subject : 'General Question');

    $body = <<<HTML
<!DOCTYPE html>
<html><body style="margin:0;padding:0;background:#f7f2e8">
  <div style="padding:32px 16px;font-family:Arial,Helvetica,sans-serif">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0"><tr><td align="center">
      <table role="presentation" width="560" cellpadding="0" cellspacing="0"
             style="max-width:560px;width:100%;background:#fffdf8;border:1px solid #ddd4c5;border-radius:14px;overflow:hidden">
        <tr><td style="background:#5e7140;height:6px;font-size:0;line-height:0">&nbsp;</td></tr>
        <tr><td align="center" style="padding:28px 32px 6px">
          <img src="{$logo}" alt="Trezise Insurance" width="120"
               style="display:block;width:120px;height:auto;margin:0 auto">
          <div style="font-size:12px;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:#5e7140;margin-top:10px">
            Trezise Insurance
          </div>
        </td></tr>
        <tr><td align="center" style="padding:14px 32px 4px">
          <h1 style="margin:0;font:500 24px/1.3 Georgia,'Times New Roman',serif;color:#603913">{$heading}</h1>
        </td></tr>
        <tr><td style="padding:18px 32px 4px">
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                 style="border-top:1px solid #ddd4c5;font-size:14.5px;color:#2f2a24">
            <tr><td style="padding:10px 0;border-bottom:1px solid #eee6d6;width:82px;vertical-align:top">
              <span style="font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#5e7140">Name</span>
            </td><td style="padding:10px 0;border-bottom:1px solid #eee6d6;font-weight:700">{$esc_name}</td></tr>
            <tr><td style="padding:10px 0;border-bottom:1px solid #eee6d6;vertical-align:top">
              <span style="font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#5e7140">Email</span>
            </td><td style="padding:10px 0;border-bottom:1px solid #eee6d6">
              <a href="mailto:{$esc_email}" style="color:#5e7140;font-weight:700">{$esc_email}</a>
            </td></tr>
            <tr><td style="padding:10px 0;border-bottom:1px solid #eee6d6;vertical-align:top">
              <span style="font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#5e7140">Phone</span>
            </td><td style="padding:10px 0;border-bottom:1px solid #eee6d6">{$esc_phone}</td></tr>
            <tr><td style="padding:10px 0;vertical-align:top">
              <span style="font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#5e7140">Topic</span>
            </td><td style="padding:10px 0">{$esc_subject}</td></tr>
          </table>
        </td></tr>
        <tr><td style="padding:6px 32px 8px">
          <div style="background:#f7f2e8;border:1px solid #ddd4c5;border-radius:10px;padding:16px 18px;
                      font:15px/1.6 Georgia,'Times New Roman',serif;color:#2f2a24">{$esc_msg}</div>
        </td></tr>
        <tr><td align="center" style="padding:20px 32px 26px;font-size:12px;color:#686158">
          Sent from the contact form on <a href="{$site}" style="color:#5e7140;font-weight:700">{$site}</a>
        </td></tr>
      </table>
    </td></tr></table>
  </div>
</body></html>
HTML;

    $ok = wp_mail(
        trezise_contact_recipients(),
        $heading,
        $body,
        // Yahoo rejects the mail unless EVERY From/Reply-To header
        // matches the authenticated mailbox — so no Reply-To; the
        // visitor's address is in the body.
        array(
            'From: Trezise Insurance <' . trezise_contact_mailbox() . '>',
            'Content-Type: text/html; charset=UTF-8',
        )
    );

    $respond($ok, $ok ? '' : 'mail');
}

add_action('admin_post_trezise_contact', 'trezise_handle_contact');
add_action('admin_post_nopriv_trezise_contact', 'trezise_handle_contact');
