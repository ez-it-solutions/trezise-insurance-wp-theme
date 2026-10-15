<?php
/**
 * Front page — production homepage modeled on the v2 site structure:
 * hero, trust strip, services, about preview, why-us, FAQ preview, CTA.
 * All copy resolves through trezise_get() so it stays editable from
 * Appearance → Customize → Trezise — Homepage.
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="top">
  <section class="tz-hero">
    <div class="tz-hero-inner">
      <div class="tz-brandmark-wrap" id="heroBrandWrap"><img class="tz-brandmark" src="<?php echo esc_url(TREZISE_URI); ?>/assets/images/logo.svg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"></div>
      <div class="tz-eyebrow"><?php trezise_field('hero_eyebrow'); ?></div>
      <h1><?php trezise_field('hero_title'); ?></h1>
      <p><?php trezise_field('hero_subtitle'); ?></p>
      <div class="tz-actions">
        <a class="tz-btn tz-primary" href="#contact"><?php trezise_field('hero_cta1'); ?></a>
        <a class="tz-btn tz-secondary" href="tel:9032842821"><?php trezise_field('hero_cta2'); ?></a>
      </div>
    </div>
  </section>

  <section class="tz-trust" aria-label="<?php esc_attr_e('Why Trezise at a glance', 'trezise-insurance'); ?>">
    <div class="tz-wrap">
      <div class="tz-trust-grid">
        <?php
        $tz_trust_icons = array(
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.2 2.4"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20.2s-7.4-4.6-9.4-9.2C1.2 7.7 3.6 4.4 7.1 4.4c2.1 0 3.5 1.1 4.9 2.9 1.4-1.8 2.8-2.9 4.9-2.9 3.5 0 5.9 3.3 4.5 6.6-2 4.6-9.4 9.2-9.4 9.2z"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 4.5h6M9 4.5a2.6 2.6 0 0 1 6 0M9 4.5v2h6v-2"/><rect x="5.5" y="4.5" width="13" height="16.5" rx="2"/><path d="M9.2 11h5.6M9.2 14.5h5.6M9.2 18h3.4"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v1.5"/><path d="M12 4.5c-5 0-8.5 3.6-8.5 8h17c0-4.4-3.5-8-8.5-8z"/><path d="M12 12.5v6.2a2.3 2.3 0 0 0 4.6 0"/></svg>',
        );
        for ($i = 1; $i <= 4; $i++) : ?>
          <div class="tz-trust-item"><span class="tz-trust-icon"><?php echo $tz_trust_icons[$i - 1]; ?></span><strong><?php trezise_field('stat' . $i . '_num'); ?></strong><span><?php trezise_field('stat' . $i . '_label'); ?></span></div>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <section class="tz-section tz-services-photo" id="services">
    <div class="tz-wrap">
      <div class="tz-intro">
        <div class="tz-kicker"><?php trezise_field('svc_kicker'); ?></div>
        <h2><?php trezise_field('svc_title'); ?></h2>
        <p><?php trezise_field('svc_intro'); ?></p>
      </div>
      <div class="tz-cards tz-four">
        <?php
        $tz_svc_icons = array(
            '<svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3.2l7 2.8v5.2c0 4.6-3 8.6-7 9.8-4-1.2-7-5.2-7-9.8V6l7-2.8z"/><path d="M12 9v6M9 12h6"/></svg>',
            '<svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 4.5h6M9 4.5a2.6 2.6 0 0 1 6 0M9 4.5v2h6v-2"/><rect x="5.5" y="4.5" width="13" height="16.5" rx="2"/><path d="M9.2 13.4l1.9 1.9 3.7-3.8"/></svg>',
            '<svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.5 11.6a8.4 8.4 0 0 1-8.3 8.4c-1.6 0-3.1-.45-4.4-1.2L3.5 20l1.3-4.4a8.4 8.4 0 1 1 15.7-4z"/><path d="M8.4 11.6h.01M12.2 11.6h.01M16 11.6h.01"/></svg>',
            '<svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 12a8 8 0 1 1-2.34-5.66"/><path d="M20 3.8v5h-5"/></svg>',
        );
        for ($i = 1; $i <= 4; $i++) : ?>
          <article class="tz-card">
            <div class="tz-icon"><?php echo $tz_svc_icons[$i - 1]; ?></div>
            <h3><?php trezise_field('svc' . $i . '_title'); ?></h3>
            <p><?php trezise_field('svc' . $i . '_desc'); ?></p>
          </article>
        <?php endfor; ?>
      </div>
      <div class="tz-actions" style="margin-top:32px">
        <a class="tz-btn tz-secondary" href="<?php echo esc_url(trezise_link('/contact/', 'tel:9032842821')); ?>"><?php trezise_field('svc_cta'); ?> &rarr;</a>
      </div>
    </div>
  </section>

  <section class="tz-section tz-local" id="about">
    <div class="tz-wrap tz-local-grid">
      <div class="tz-photo-col">
        <div class="tz-local-photo" aria-hidden="true"></div>
        <p class="tz-founders"><?php trezise_field('about_quote'); ?></p>
      </div>
      <div>
        <div class="tz-kicker"><?php trezise_field('about_kicker'); ?></div>
        <h2><?php trezise_field('about_title'); ?></h2>
        <p><?php trezise_field('about_body1'); ?></p>
        <p><?php trezise_field('about_body2'); ?></p>
        <div class="tz-actions" style="justify-content:flex-start;margin-top:18px">
          <a class="tz-btn tz-primary" href="<?php echo esc_url(trezise_link('/about/', '#contact')); ?>"><?php trezise_field('about_cta'); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="tz-section tz-help" id="why">
    <div class="tz-wrap">
      <div>
        <div class="tz-kicker" style="color:#e4ecd1"><?php trezise_field('why_kicker'); ?></div>
        <h2><?php trezise_field('why_title'); ?></h2>
        <p><?php trezise_field('why_intro'); ?></p>
      </div>
      <div class="tz-acc">
        <?php for ($i = 1; $i <= 4; $i++) : ?>
          <details class="tz-acc-item">
            <summary><?php trezise_field('why' . $i . '_title'); ?></summary>
            <p><?php trezise_field('why' . $i . '_desc'); ?></p>
          </details>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <section class="tz-section" id="faqs">
    <div class="tz-wrap">
      <div class="tz-intro">
        <div class="tz-kicker"><?php trezise_field('faq_kicker'); ?></div>
        <h2><?php trezise_field('faq_title'); ?></h2>
      </div>
      <div class="tz-faq">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
          <details class="tz-faq-item">
            <summary><?php trezise_field('faq' . $i . '_q'); ?></summary>
            <p><?php trezise_field('faq' . $i . '_a'); ?></p>
          </details>
        <?php endfor; ?>
      </div>
      <div class="tz-actions" style="margin-top:26px">
        <a class="tz-btn tz-secondary" href="<?php echo esc_url(trezise_link('/faqs/', '#faqs')); ?>"><?php trezise_field('faq_more'); ?></a>
      </div>
    </div>
  </section>

  <section class="tz-section tz-cta" id="contact">
    <div class="tz-wrap">
      <div class="tz-cta-box">
        <div class="tz-kicker"><?php trezise_field('cta_kicker'); ?></div>
        <h2><?php trezise_field('cta_title'); ?></h2>
        <p style="max-width:720px;margin:0 auto 10px;color:var(--muted);font-size:20px"><?php trezise_field('cta_body'); ?></p>
        <a class="tz-phone" href="tel:9032842821">(903) 284-2821</a>
        <div class="tz-actions" style="margin-top:12px">
          <a class="tz-btn tz-primary" href="tel:9032842821"><?php esc_html_e('Call Now', 'trezise-insurance'); ?></a>
          <a class="tz-btn tz-secondary" href="<?php echo esc_url(trezise_link('/contact/', 'mailto:contact@treziseinsurance.com')); ?>"><?php esc_html_e('Email Us', 'trezise-insurance'); ?></a>
        </div>
        <p class="tz-fine"><?php trezise_field('cta_note'); ?></p>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
