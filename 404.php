<?php
/** 404 template. */
if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="top">
  <section class="tz-section tz-cta">
    <div class="tz-wrap">
      <div class="tz-cta-box">
        <div class="tz-kicker">404</div>
        <h2><?php esc_html_e('This page took a wrong turn.', 'trezise-insurance'); ?></h2>
        <p><?php esc_html_e('The page you’re looking for isn’t here — but a local agent is.', 'trezise-insurance'); ?></p>
        <div class="tz-actions"><a class="tz-btn tz-primary" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back to Home', 'trezise-insurance'); ?></a><a class="tz-btn tz-secondary" href="tel:9032842821"><?php esc_html_e('Call Us', 'trezise-insurance'); ?></a></div>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
