<?php
/**
 * Contact page — auto-applies to the page with slug "contact".
 * Mirrors v2: hero with contact chips, message form + info sidebar,
 * "prefer to call" band. Form posts through admin-post.php and mails
 * the office — see inc/contact-form.php.
 */

if (! defined('ABSPATH')) {
    exit;
}

$sent = isset($_GET['contact']) ? sanitize_key($_GET['contact']) : '';

get_header();
?>
<main id="top">
  <section class="tz-page-hero">
    <div class="tz-page-hero-inner">
      <div class="tz-eyebrow"><?php esc_html_e('Get In Touch', 'trezise-insurance'); ?></div>
      <h1><?php esc_html_e('Let&rsquo;s Talk About Your Coverage', 'trezise-insurance'); ?></h1>
      <p><?php esc_html_e('Reach out to Mark and Kristie — we&rsquo;re here to help you find the right protection for your family.', 'trezise-insurance'); ?></p>
      <div class="tz-chips">
        <a class="tz-chip" href="tel:9032842821">(903) 284-2821</a>
        <a class="tz-chip" href="mailto:contact@treziseinsurance.com">contact@treziseinsurance.com</a>
        <span class="tz-chip">215 E Commerce St, Jacksonville, TX 75766</span>
      </div>
    </div>
  </section>

  <section class="tz-section" id="contact">
    <div class="tz-wrap tz-contact-grid">
      <div>
        <div class="tz-kicker"><?php esc_html_e('Send Us a Message', 'trezise-insurance'); ?></div>
        <h2><?php esc_html_e('How can we help you?', 'trezise-insurance'); ?></h2>

        <?php if ('sent' === $sent) : ?>
          <p class="tz-form-note tz-ok"><?php esc_html_e('Thanks — your message is on its way. We&rsquo;ll get back to you soon.', 'trezise-insurance'); ?></p>
        <?php elseif ('failed' === $sent) : ?>
          <p class="tz-form-note tz-err"><?php esc_html_e('Something didn&rsquo;t go through. Please try again, or call us directly.', 'trezise-insurance'); ?></p>
        <?php endif; ?>

        <form class="tz-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
          <input type="hidden" name="action" value="trezise_contact">
          <?php wp_nonce_field('trezise_contact', 'trezise_contact_nonce'); ?>
          <div class="tz-form-row">
            <div class="tz-field">
              <label for="tz-name"><?php esc_html_e('Full Name', 'trezise-insurance'); ?></label>
              <input id="tz-name" name="tz_name" type="text" required autocomplete="name">
            </div>
            <div class="tz-field">
              <label for="tz-email"><?php esc_html_e('Email Address', 'trezise-insurance'); ?></label>
              <input id="tz-email" name="tz_email" type="email" required autocomplete="email">
            </div>
          </div>
          <div class="tz-form-row">
            <div class="tz-field">
              <label for="tz-phone"><?php esc_html_e('Phone Number', 'trezise-insurance'); ?></label>
              <input id="tz-phone" name="tz_phone" type="tel" inputmode="tel" autocomplete="tel" maxlength="20" placeholder="(555) 555-5555">
            </div>
            <div class="tz-field">
              <label for="tz-subject"><?php esc_html_e('Subject', 'trezise-insurance'); ?></label>
              <select id="tz-subject" name="tz_subject">
                <option><?php esc_html_e('Medicare Question', 'trezise-insurance'); ?></option>
                <option><?php esc_html_e('ACA / Marketplace Coverage', 'trezise-insurance'); ?></option>
                <option><?php esc_html_e('Plan Review', 'trezise-insurance'); ?></option>
                <option><?php esc_html_e('General Question', 'trezise-insurance'); ?></option>
              </select>
            </div>
          </div>
          <div class="tz-field">
            <label for="tz-message"><?php esc_html_e('Your Message', 'trezise-insurance'); ?></label>
            <textarea id="tz-message" name="tz_message" rows="5" required></textarea>
          </div>
          <p class="tz-hp" aria-hidden="true"><label>Leave this empty <input type="text" name="tz_company" tabindex="-1" autocomplete="off"></label></p>
          <button class="tz-btn tz-primary" type="submit"><?php esc_html_e('Send Message', 'trezise-insurance'); ?></button>
        </form>
      </div>

      <aside class="tz-info">
        <h3><?php esc_html_e('Our Contact Information', 'trezise-insurance'); ?></h3>
        <ul class="tz-info-list">
          <li><strong><?php esc_html_e('Phone', 'trezise-insurance'); ?></strong><a href="tel:9032842821">(903) 284-2821</a></li>
          <li><strong><?php esc_html_e('Email', 'trezise-insurance'); ?></strong><a href="mailto:treziseinsurance@yahoo.com">treziseinsurance@yahoo.com</a></li>
          <li><strong><?php esc_html_e('Office', 'trezise-insurance'); ?></strong><span>215 E Commerce St<br>Jacksonville, TX 75766</span></li>
          <li><strong><?php esc_html_e('Hours', 'trezise-insurance'); ?></strong><span><?php esc_html_e('Mon, Wed & Thu: 9 AM – 5 PM', 'trezise-insurance'); ?><br><?php esc_html_e('Tue: 9 AM – 4 PM · Fri: 9 AM – 12 PM', 'trezise-insurance'); ?><br><?php esc_html_e('Sat: By appointment · Sun: Closed', 'trezise-insurance'); ?></span></li>
        </ul>
      </aside>
    </div>
  </section>

  <section class="tz-section" style="background:var(--cream)">
    <div class="tz-wrap">
      <div class="tz-intro" style="margin-bottom:34px">
        <h2 style="margin-top:0"><?php esc_html_e('Visit Our Jacksonville Office', 'trezise-insurance'); ?></h2>
      </div>
      <div class="tz-map">
        <iframe
          src="https://maps.google.com/maps?q=215%20E%20Commerce%20St%2C%20Jacksonville%2C%20TX%2075766&z=16&output=embed"
          width="600" height="420" style="border:0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          title="<?php esc_attr_e('Map to Trezise Insurance, 215 E Commerce St, Jacksonville, TX 75766', 'trezise-insurance'); ?>"
          allowfullscreen></iframe>
        <p class="tz-map-caption"><?php esc_html_e('215 E Commerce St., Jacksonville, TX 75766', 'trezise-insurance'); ?></p>
      </div>
    </div>
  </section>

  <section class="tz-band">
    <div class="tz-wrap tz-band-inner">
      <h2><?php esc_html_e('Prefer to Call?', 'trezise-insurance'); ?></h2>
      <p><?php esc_html_e('We&rsquo;re in the office most weekdays — see our hours above — and happy to meet in person.', 'trezise-insurance'); ?></p>
      <a class="tz-btn tz-light" href="tel:9032842821">(903) 284-2821</a>
    </div>
  </section>
</main>
<?php
get_footer();
