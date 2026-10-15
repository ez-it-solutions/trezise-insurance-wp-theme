<?php
/**
 * About page — auto-applies to the page with slug "about".
 * Mirrors v2: hero with team photo, story, team cards, core values,
 * community band, CTA.
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="top">
  <section class="tz-page-hero">
    <div class="tz-page-hero-inner">
      <div class="tz-eyebrow"><?php esc_html_e('Our Story', 'trezise-insurance'); ?></div>
      <h1><?php esc_html_e('Your East Texas Insurance Partners', 'trezise-insurance'); ?></h1>
      <p><?php esc_html_e('With over 27 years of combined experience, we&rsquo;ve helped East Texas families navigate Medicare and ACA coverage — with the kind of personal guidance only neighbors can give.', 'trezise-insurance'); ?></p>
    </div>
  </section>

  <section class="tz-section tz-local">
    <div class="tz-wrap tz-local-grid">
      <div class="tz-photo-col">
        <div class="tz-local-photo" aria-hidden="true"></div>
        <p class="tz-founders"><?php esc_html_e('“Mark and Kristie have been helping individuals and families navigate Medicare and Individual Health insurance with personal guidance and local care for over 27 years combined.”', 'trezise-insurance'); ?></p>
      </div>
      <div>
        <div class="tz-kicker"><?php esc_html_e('Since 2006', 'trezise-insurance'); ?></div>
        <h2><?php esc_html_e('Deep roots in Jacksonville.', 'trezise-insurance'); ?></h2>
        <p><?php esc_html_e('Our journey began in 2006, when Mark Trezise recognized the need for personal insurance guidance in East Texas — and Kristie joined him in 2019. As independent insurance brokers, we built our reputation on personalized service and trusted guidance in Medicare and ACA solutions.', 'trezise-insurance'); ?></p>
        <p><?php esc_html_e('Today, hundreds of families across the region count on us to explain their options clearly, compare plans honestly, and stand beside them year after year — because insurance should feel personal, not processed.', 'trezise-insurance'); ?></p>
      </div>
    </div>
  </section>

  <section class="tz-section" style="background:var(--cream)">
    <div class="tz-wrap">
      <div class="tz-intro">
        <div class="tz-kicker"><?php esc_html_e('Meet Our Experts', 'trezise-insurance'); ?></div>
        <h2><?php esc_html_e('The People Behind Your Coverage', 'trezise-insurance'); ?></h2>
      </div>
      <div class="tz-cards tz-two">
        <article class="tz-card tz-member">
          <div class="tz-avatar" aria-hidden="true">MT</div>
          <h3><?php esc_html_e('Mark Trezise', 'trezise-insurance'); ?></h3>
          <p class="tz-role"><?php esc_html_e('Co-Owner & Licensed Insurance Agent', 'trezise-insurance'); ?></p>
          <p><?php esc_html_e('Mark specializes in Medicare with over two decades of experience. His focus is client education — making sure you understand every option before you choose.', 'trezise-insurance'); ?></p>
          <p class="tz-member-contact"><a href="tel:9032842821">(903) 284-2821</a> · <a href="mailto:treziseinsurance@yahoo.com">treziseinsurance@yahoo.com</a></p>
        </article>
        <article class="tz-card tz-member">
          <div class="tz-avatar" aria-hidden="true">KT</div>
          <h3><?php esc_html_e('Kristie Trezise', 'trezise-insurance'); ?></h3>
          <p class="tz-role"><?php esc_html_e('Co-Owner & Licensed Insurance Agent', 'trezise-insurance'); ?></p>
          <p><?php esc_html_e('Kristie brings deep expertise in the Affordable Care Act and the healthcare marketplace, helping families find affordable coverage that actually fits.', 'trezise-insurance'); ?></p>
          <p class="tz-member-contact"><a href="tel:9032842821">(903) 284-2821</a> · <a href="mailto:treziseinsurance@yahoo.com">treziseinsurance@yahoo.com</a></p>
        </article>
      </div>
    </div>
  </section>

  <section class="tz-section">
    <div class="tz-wrap">
      <div class="tz-intro">
        <div class="tz-kicker"><?php esc_html_e('What Guides Us', 'trezise-insurance'); ?></div>
        <h2><?php esc_html_e('Our Core Values', 'trezise-insurance'); ?></h2>
      </div>
      <div class="tz-cards tz-four">
        <article class="tz-card"><div class="tz-icon"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3.6l2.6 5.3 5.8.8-4.2 4.1 1 5.8-5.2-2.7-5.2 2.7 1-5.8L3.6 9.7l5.8-.8L12 3.6z"/></svg></div><h3><?php esc_html_e('Excellence', 'trezise-insurance'); ?></h3><p><?php esc_html_e('Exceptional service and solutions, every interaction.', 'trezise-insurance'); ?></p></article>
        <article class="tz-card"><div class="tz-icon"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s-6.6-5.5-6.6-10.2A6.6 6.6 0 0 1 12 4.2a6.6 6.6 0 0 1 6.6 6.6C18.6 15.5 12 21 12 21z"/><circle cx="12" cy="10.8" r="2.2"/></svg></div><h3><?php esc_html_e('Community', 'trezise-insurance'); ?></h3><p><?php esc_html_e('Proudly serving East Texas as neighbors, not just agents.', 'trezise-insurance'); ?></p></article>
        <article class="tz-card"><div class="tz-icon"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3.2l7 2.8v5.2c0 4.6-3 8.6-7 9.8-4-1.2-7-5.2-7-9.8V6l7-2.8z"/><path d="M9 11.8l2 2 4-4.2"/></svg></div><h3><?php esc_html_e('Trust', 'trezise-insurance'); ?></h3><p><?php esc_html_e('Transparency and honest guidance in everything we do.', 'trezise-insurance'); ?></p></article>
        <article class="tz-card"><div class="tz-icon"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20.2s-7.4-4.6-9.4-9.2C1.2 7.7 3.6 4.4 7.1 4.4c2.1 0 3.5 1.1 4.9 2.9 1.4-1.8 2.8-2.9 4.9-2.9 3.5 0 5.9 3.3 4.5 6.6-2 4.6-9.4 9.2-9.4 9.2z"/></svg></div><h3><?php esc_html_e('Care', 'trezise-insurance'); ?></h3><p><?php esc_html_e('Your well-being and healthcare needs come first.', 'trezise-insurance'); ?></p></article>
      </div>
    </div>
  </section>

  <section class="tz-band">
    <div class="tz-wrap tz-band-inner">
      <div class="tz-kicker" style="color:#e4ecd1"><?php esc_html_e('Local Since 2006', 'trezise-insurance'); ?></div>
      <h2><?php esc_html_e('Proudly Part of the Jacksonville Community', 'trezise-insurance'); ?></h2>
      <p><?php esc_html_e('We live here, shop here, and raise our families here. The people we help aren&rsquo;t policy numbers — they&rsquo;re our neighbors.', 'trezise-insurance'); ?></p>
      <a class="tz-btn tz-light" href="<?php echo esc_url(trezise_link('/contact/', 'tel:9032842821')); ?>"><?php esc_html_e('Ready to Get Started?', 'trezise-insurance'); ?></a>
    </div>
  </section>
</main>
<?php
get_footer();
