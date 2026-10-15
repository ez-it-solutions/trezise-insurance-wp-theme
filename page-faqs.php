<?php
/**
 * FAQs page — auto-applies to the page with slug "faqs".
 * Mirrors v2: page hero, topic filter pills, categorized accordion
 * list, "still have questions" band. Filtering is handled in main.js.
 */

if (! defined('ABSPATH')) {
    exit;
}

$faqs = array(
    array('medicare',     __('When should I start looking at Medicare options?', 'trezise-insurance'), __('Ideally 3–6 months before your 65th birthday or before you retire. That gives us time to compare plans without rushing your Initial Enrollment Period.', 'trezise-insurance')),
    array('medicare',     __('Can you help me compare Medicare plans?', 'trezise-insurance'), __('Yes — that&rsquo;s the heart of what we do. We compare Advantage, Supplement, and Part D options side by side and explain the real differences in cost and coverage.', 'trezise-insurance')),
    array('medicare',     __('When can I enroll in or change a Medicare plan?', 'trezise-insurance'), __('Most people enroll during their Initial Enrollment Period around age 65, or during the Annual Enrollment Period each fall. Certain life events may qualify you for a Special Enrollment Period — we&rsquo;ll help you find out.', 'trezise-insurance')),
    array('aca',          __('Do you help with ACA plans too?', 'trezise-insurance'), __('Absolutely. We help individuals and families compare Marketplace plans, check tax-credit eligibility, and enroll — at no cost to you.', 'trezise-insurance')),
    array('aca',          __('Do I need an appointment?', 'trezise-insurance'), __('Appointments are appreciated so we can give you our full attention, but we&rsquo;re happy to take walk-ins and phone calls during business hours.', 'trezise-insurance')),
    array('supplements',  __('What types of Medicare supplement plans do you offer?', 'trezise-insurance'), __('We work with multiple carriers and compare the Medigap plans available in our area — including the popular Plan G and Plan N — to find the best fit and rate for you.', 'trezise-insurance')),
    array('supplements',  __('Can I keep my current doctors with a Medicare supplement?', 'trezise-insurance'), __('In most cases, yes. Medigap plans work with any doctor who accepts Medicare — no networks. We&rsquo;ll confirm your doctors before you enroll.', 'trezise-insurance')),
    array('general',      __('Do your services cost me anything?', 'trezise-insurance'), __('No. As independent brokers we&rsquo;re compensated by the insurance carriers — our guidance, comparisons, and enrollment help come at no additional cost to you.', 'trezise-insurance')),
    array('general',      __('Can I meet with someone in person?', 'trezise-insurance'), __('Yes — our office is on East Commerce Street in downtown Jacksonville. We also meet by phone — whatever is easiest for you.', 'trezise-insurance')),
    array('general',      __('What should I bring to my consultation?', 'trezise-insurance'), __('Bring your current insurance cards, a list of your medications and doctors, and any questions you have. We&rsquo;ll take it from there.', 'trezise-insurance')),
);

$topics = array(
    'all'         => __('All Topics', 'trezise-insurance'),
    'medicare'    => __('Medicare', 'trezise-insurance'),
    'aca'         => __('ACA Coverage', 'trezise-insurance'),
    'supplements' => __('Supplements', 'trezise-insurance'),
    'general'     => __('General', 'trezise-insurance'),
);

get_header();
?>
<main id="top">
  <section class="tz-page-hero">
    <div class="tz-page-hero-inner">
      <div class="tz-eyebrow"><?php esc_html_e('Got Questions?', 'trezise-insurance'); ?></div>
      <h1><?php esc_html_e('Frequently Asked Questions', 'trezise-insurance'); ?></h1>
      <p><?php esc_html_e('Find quick answers to the questions we hear most often. Don&rsquo;t see yours? Just call us.', 'trezise-insurance'); ?></p>
      <div class="tz-pills" id="faqPills">
        <?php foreach ($topics as $slug => $label) : ?>
          <button type="button" class="tz-pill<?php echo 'all' === $slug ? ' tz-active' : ''; ?>" data-topic="<?php echo esc_attr($slug); ?>"><?php echo esc_html($label); ?></button>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="tz-section">
    <div class="tz-wrap">
      <div class="tz-faq" id="faqList">
        <?php foreach ($faqs as $faq) : ?>
          <details class="tz-faq-item" data-topic="<?php echo esc_attr($faq[0]); ?>">
            <summary><span class="tz-badge tz-badge-<?php echo esc_attr($faq[0]); ?>"><?php echo esc_html($topics[$faq[0]]); ?></span><span class="tz-faq-q"><?php echo wp_kses_post($faq[1]); ?></span></summary>
            <p><?php echo wp_kses_post($faq[2]); ?></p>
          </details>
        <?php endforeach; ?>
      </div>
      <p class="tz-faq-empty" id="faqEmpty" hidden><?php esc_html_e('No questions in this topic yet — call us and we&rsquo;ll answer it directly.', 'trezise-insurance'); ?></p>
    </div>
  </section>

  <section class="tz-band">
    <div class="tz-wrap tz-band-inner">
      <h2><?php esc_html_e('Still Have Questions?', 'trezise-insurance'); ?></h2>
      <p><?php esc_html_e('We&rsquo;re happy to answer any question — big or small. Reach out and we&rsquo;ll get back to you quickly.', 'trezise-insurance'); ?></p>
      <a class="tz-btn tz-light" href="<?php echo esc_url(trezise_link('/contact/', 'tel:9032842821')); ?>"><?php esc_html_e('Contact Us', 'trezise-insurance'); ?></a>
    </div>
  </section>
</main>
<?php
get_footer();
