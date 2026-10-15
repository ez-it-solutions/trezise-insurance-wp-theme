<?php
/**
 * Template Name: Demo — v3 Concept
 *
 * The original index.htm concept markup, preserved as a design reference.
 * Assign this template to a page in wp-admin to view it.
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
      <div class="tz-eyebrow"><?php esc_html_e('Jacksonville, Texas', 'trezise-insurance'); ?><span class="tz-tail"> &bull; <?php esc_html_e('Independent Insurance Guidance', 'trezise-insurance'); ?></span></div>
      <h1><?php esc_html_e('Insurance should feel clear, personal, and a little less complicated.', 'trezise-insurance'); ?></h1>
      <p><?php esc_html_e('We help individuals and families understand their options for Medicare, health, life, and supplemental coverage — with steady guidance from a local team that believes relationships matter.', 'trezise-insurance'); ?></p>
      <div class="tz-actions">
        <a class="tz-btn tz-primary" href="tel:9032842821"><?php esc_html_e('Call Trezise Insurance', 'trezise-insurance'); ?></a>
        <a class="tz-btn tz-secondary" href="#coverage"><?php esc_html_e('Explore Coverage', 'trezise-insurance'); ?></a>
      </div>
      <div class="tz-trustline"><span><?php esc_html_e('Local and approachable', 'trezise-insurance'); ?></span><span><?php esc_html_e('Customer service above sales', 'trezise-insurance'); ?></span><span><?php esc_html_e('Clear explanations for every step', 'trezise-insurance'); ?></span></div>
    </div>
  </section>

  <section class="tz-section" id="coverage">
    <div class="tz-wrap">
      <div class="tz-intro">
        <div class="tz-kicker"><?php esc_html_e('Coverage made simpler', 'trezise-insurance'); ?></div>
        <h2><?php esc_html_e('Choose the area where you need the most help.', 'trezise-insurance'); ?></h2>
        <p><?php esc_html_e('Instead of overwhelming visitors with too many choices, the homepage should guide them into the few services they are most likely to need.', 'trezise-insurance'); ?></p>
      </div>
      <div class="tz-cards">
        <article class="tz-card"><div class="tz-icon">M</div><h3><?php esc_html_e('Medicare', 'trezise-insurance'); ?></h3><p><?php esc_html_e('Guidance through Medicare options, supplements, prescription plans, and the questions that often come with enrollment.', 'trezise-insurance'); ?></p><a href="#contact"><?php esc_html_e('Talk with an agent', 'trezise-insurance'); ?> &rarr;</a></article>
        <article class="tz-card"><div class="tz-icon">H</div><h3><?php esc_html_e('Health &amp; Life', 'trezise-insurance'); ?></h3><p><?php esc_html_e('Support for health plans, life insurance, and coverage decisions that protect both today’s needs and future plans.', 'trezise-insurance'); ?></p><a href="#contact"><?php esc_html_e('Start the conversation', 'trezise-insurance'); ?> &rarr;</a></article>
        <article class="tz-card"><div class="tz-icon">S</div><h3><?php esc_html_e('Supplemental Coverage', 'trezise-insurance'); ?></h3><p><?php esc_html_e('Flexible coverage options to help fill gaps and add peace of mind for unexpected costs and changing needs.', 'trezise-insurance'); ?></p><a href="#contact"><?php esc_html_e('See how it fits', 'trezise-insurance'); ?> &rarr;</a></article>
      </div>
    </div>
  </section>

  <section class="tz-section tz-help" id="about">
    <div class="tz-wrap">
      <div>
        <div class="tz-kicker" style="color:#e4ecd1"><?php esc_html_e('A calmer experience', 'trezise-insurance'); ?></div>
        <h2><?php esc_html_e('Designed for an older audience that values clarity and trust.', 'trezise-insurance'); ?></h2>
        <p><?php esc_html_e('This concept intentionally uses larger type, stronger contrast, simple choices, and a clear path to a real person — all while keeping the tree-and-roots brand at the center.', 'trezise-insurance'); ?></p>
      </div>
      <div class="tz-steps">
        <div class="tz-step"><div class="tz-num">1</div><div><strong><?php esc_html_e('See the main options', 'trezise-insurance'); ?></strong><span><?php esc_html_e('Visitors immediately understand the core services without hunting through cluttered menus.', 'trezise-insurance'); ?></span></div></div>
        <div class="tz-step"><div class="tz-num">2</div><div><strong><?php esc_html_e('Get a clear explanation', 'trezise-insurance'); ?></strong><span><?php esc_html_e('Helpful copy focuses on plain language and steady guidance rather than sales-heavy jargon.', 'trezise-insurance'); ?></span></div></div>
        <div class="tz-step"><div class="tz-num">3</div><div><strong><?php esc_html_e('Call a local agent', 'trezise-insurance'); ?></strong><span><?php esc_html_e('Every page keeps the phone number prominent, because the easiest next step is often a conversation.', 'trezise-insurance'); ?></span></div></div>
      </div>
    </div>
  </section>

  <section class="tz-section tz-local">
    <div class="tz-wrap tz-local-grid">
      <div class="tz-photo-col">
        <div class="tz-local-photo" aria-hidden="true"></div>
        <p class="tz-founders"><?php esc_html_e('“Mark and Kristie have been helping individuals and families navigate Medicare and Individual Health insurance with personal guidance and local care for over 27 years combined.”', 'trezise-insurance'); ?></p>
      </div>
      <div>
        <div class="tz-kicker"><?php esc_html_e('Deep roots in Jacksonville', 'trezise-insurance'); ?></div>
        <h2><?php esc_html_e('The logo can do more than decorate the page.', 'trezise-insurance'); ?></h2>
        <p><?php esc_html_e('In this direction, the large hero logo introduces the brand with the full tree and roots. As the visitor scrolls, the roots stay behind and the identity condenses into a clean header mark with a softer animated transition.', 'trezise-insurance'); ?></p>
        <div class="tz-facts">
          <div class="tz-fact"><strong><?php esc_html_e('Large primary logo', 'trezise-insurance'); ?></strong><span><?php esc_html_e('Centered and prominent at the top of the homepage.', 'trezise-insurance'); ?></span></div>
          <div class="tz-fact"><strong><?php esc_html_e('Compact tree mark', 'trezise-insurance'); ?></strong><span><?php esc_html_e('Scrolled state focuses on the canopy and trunk rather than the full roots.', 'trezise-insurance'); ?></span></div>
          <div class="tz-fact"><strong><?php esc_html_e('Far-left brand text', 'trezise-insurance'); ?></strong><span><?php esc_html_e('The company name fades into view only after scrolling.', 'trezise-insurance'); ?></span></div>
          <div class="tz-fact"><strong><?php esc_html_e('Simple navigation', 'trezise-insurance'); ?></strong><span><?php esc_html_e('Easy to scan for visitors who need clarity first.', 'trezise-insurance'); ?></span></div>
        </div>
      </div>
    </div>
  </section>

  <section class="tz-section tz-cta" id="contact">
    <div class="tz-wrap">
      <div class="tz-cta-box">
        <div class="tz-kicker"><?php esc_html_e('Ready to talk?', 'trezise-insurance'); ?></div>
        <h2><?php esc_html_e('Let’s make it easy for visitors to reach out.', 'trezise-insurance'); ?></h2>
        <p style="max-width:720px;margin:0 auto 10px;color:var(--muted);font-size:20px"><?php esc_html_e('This demo keeps the call-to-action simple and visible. The real build could also add a short contact form, office details, and a stronger team section.', 'trezise-insurance'); ?></p>
        <a class="tz-phone" href="tel:9032842821">(903) 284-2821</a>
        <div class="tz-actions" style="margin-top:12px"><a class="tz-btn tz-primary" href="tel:9032842821"><?php esc_html_e('Call Now', 'trezise-insurance'); ?></a><a class="tz-btn tz-secondary" href="#top"><?php esc_html_e('Back to Top', 'trezise-insurance'); ?></a></div>
        <p class="tz-fine"><?php esc_html_e('Concept demo for planning purposes only.', 'trezise-insurance'); ?></p>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
