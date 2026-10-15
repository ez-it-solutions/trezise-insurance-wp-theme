<?php
/**
 * Services page — auto-applies to the page with slug "services".
 * Layout mirrors the v2 services page: page hero, intro, alternating
 * service rows with checklists, dark CTA band.
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="top">
  <section class="tz-page-hero">
    <div class="tz-page-hero-inner">
      <div class="tz-eyebrow"><?php esc_html_e('How We Help', 'trezise-insurance'); ?></div>
      <h1><?php esc_html_e('Insurance Services Tailored for East Texans', 'trezise-insurance'); ?></h1>
      <p><?php esc_html_e('From Medicare to ACA coverage, we guide you through every option — with clarity, care, and no pressure.', 'trezise-insurance'); ?></p>
      <div class="tz-actions">
        <a class="tz-btn tz-primary" href="#services"><?php esc_html_e('Explore Our Services', 'trezise-insurance'); ?></a>
        <a class="tz-btn tz-secondary" href="tel:9032842821"><?php esc_html_e('Call (903) 284-2821', 'trezise-insurance'); ?></a>
      </div>
    </div>
  </section>

  <section class="tz-section" id="services">
    <div class="tz-wrap">
      <div class="tz-intro">
        <div class="tz-kicker"><?php esc_html_e('Our Services', 'trezise-insurance'); ?></div>
        <h2><?php esc_html_e('Comprehensive Coverage Guidance', 'trezise-insurance'); ?></h2>
        <p><?php esc_html_e('Instead of overwhelming you with choices, we guide you into the services most likely to fit your needs.', 'trezise-insurance'); ?></p>
      </div>

      <div class="tz-split">
        <div class="tz-split-text">
          <div class="tz-split-head">
            <div class="tz-icon"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3.2l7 2.8v5.2c0 4.6-3 8.6-7 9.8-4-1.2-7-5.2-7-9.8V6l7-2.8z"/><path d="M12 9v6M9 12h6"/></svg></div>
            <h3><?php esc_html_e('Medicare Insurance', 'trezise-insurance'); ?></h3>
          </div>
          <p><?php esc_html_e('Turning 65 or already enrolled? We walk you through Original Medicare, Medicare Advantage, Medicare supplements, and Part D drug plans so you can choose with confidence.', 'trezise-insurance'); ?></p>
          <ul class="tz-check">
            <li><?php esc_html_e('Medicare Advantage plan comparisons', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Medicare Supplement (Medigap) guidance', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Part D prescription drug plans', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Enrollment periods & applications', 'trezise-insurance'); ?></li>
          </ul>
          <a class="tz-btn tz-primary" href="<?php echo esc_url(trezise_link('/contact/', '#contact')); ?>"><?php esc_html_e('Get Medicare Guidance', 'trezise-insurance'); ?> &rarr;</a>
        </div>
        <div class="tz-photo tz-photo-a" aria-hidden="true"></div>
      </div>

      <div class="tz-split tz-split-rev">
        <div class="tz-split-text">
          <div class="tz-split-head">
            <div class="tz-icon"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 4.5h6M9 4.5a2.6 2.6 0 0 1 6 0M9 4.5v2h6v-2"/><rect x="5.5" y="4.5" width="13" height="16.5" rx="2"/><path d="M9.2 11h5.6M9.2 14.5h5.6M9.2 18h3.4"/></svg></div>
            <h3><?php esc_html_e('Individual Health Plans', 'trezise-insurance'); ?></h3>
          </div>
          <p><?php esc_html_e('If you&rsquo;re not yet Medicare-eligible, we&rsquo;ll help you find an affordable individual plan — on or off the Marketplace — that fits your income, family size, and health needs.', 'trezise-insurance'); ?></p>
          <ul class="tz-check">
            <li><?php esc_html_e('On- & off-Marketplace plan comparisons', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Tax credit & subsidy assistance', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Special Enrollment Period help', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Income-based coverage options', 'trezise-insurance'); ?></li>
          </ul>
          <a class="tz-btn tz-primary" href="<?php echo esc_url(trezise_link('/contact/', '#contact')); ?>"><?php esc_html_e('Get Health Plan Help', 'trezise-insurance'); ?> &rarr;</a>
        </div>
        <div class="tz-photo tz-photo-b" aria-hidden="true"></div>
      </div>

      <div class="tz-split">
        <div class="tz-split-text">
          <div class="tz-split-head">
            <div class="tz-icon"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5c-1.3 0-2.6-.3-3.7-.8L4 20.5l1.3-4.2A8.5 8.5 0 1 1 21 11.5z"/></svg></div>
            <h3><?php esc_html_e('Personalized Consultation', 'trezise-insurance'); ?></h3>
          </div>
          <p><?php esc_html_e('Not sure where to start? We&rsquo;ll sit down with you — in person or by phone — to understand your situation and map out the options that actually fit.', 'trezise-insurance'); ?></p>
          <ul class="tz-check">
            <li><?php esc_html_e('Needs assessment', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Coverage gap analysis', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Cost & benefits comparisons', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Plain-language explanations', 'trezise-insurance'); ?></li>
          </ul>
          <a class="tz-btn tz-primary" href="<?php echo esc_url(trezise_link('/contact/', '#contact')); ?>"><?php esc_html_e('Schedule a Consultation', 'trezise-insurance'); ?> &rarr;</a>
        </div>
        <div class="tz-photo tz-photo-c" aria-hidden="true"></div>
      </div>

      <div class="tz-split tz-split-rev">
        <div class="tz-split-text">
          <div class="tz-split-head">
            <div class="tz-icon"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12a9 9 0 0 1 15.5-6.2L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-15.5 6.2L3 16"/><path d="M3 21v-5h5"/></svg></div>
            <h3><?php esc_html_e('Ongoing Support', 'trezise-insurance'); ?></h3>
          </div>
          <p><?php esc_html_e('Insurance isn&rsquo;t a one-time decision. We review your coverage every year and adjust as your health needs and life circumstances change.', 'trezise-insurance'); ?></p>
          <ul class="tz-check">
            <li><?php esc_html_e('Annual plan reviews', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Claims assistance', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Policy updates & life-change adjustments', 'trezise-insurance'); ?></li>
            <li><?php esc_html_e('Answers whenever you need them', 'trezise-insurance'); ?></li>
          </ul>
          <a class="tz-btn tz-primary" href="<?php echo esc_url(trezise_link('/contact/', '#contact')); ?>"><?php esc_html_e('Talk to an Agent', 'trezise-insurance'); ?> &rarr;</a>
        </div>
        <div class="tz-photo tz-photo-d" aria-hidden="true"></div>
      </div>
    </div>
  </section>

  <section class="tz-band">
    <div class="tz-wrap tz-band-inner">
      <h2><?php esc_html_e('Not Sure Where to Start?', 'trezise-insurance'); ?></h2>
      <p><?php esc_html_e('A free, no-pressure consultation with Mark or Kristie is the best first step. We&rsquo;ll listen first — then guide.', 'trezise-insurance'); ?></p>
      <a class="tz-btn tz-light" href="<?php echo esc_url(trezise_link('/contact/', 'tel:9032842821')); ?>"><?php esc_html_e('Schedule a Free Consultation', 'trezise-insurance'); ?></a>
    </div>
  </section>
</main>
<?php
get_footer();
