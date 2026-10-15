<?php
/**
 * Footer — ported 1:1 from index.htm, plus wp_footer() and the mobile
 * call bar.
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<footer>
  <div class="tz-footer">
    <div>
      <img class="tz-footer-logo" src="<?php echo esc_url(TREZISE_URI); ?>/assets/images/logo.svg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
      <p class="tz-footer-tag"><?php esc_html_e('Independent guidance for Medicare, health, life, and supplemental coverage — from a local team that treats you like a neighbor.', 'trezise-insurance'); ?></p>
    </div>
    <div>
      <h4><?php esc_html_e('Quick Links', 'trezise-insurance'); ?></h4>
      <?php trezise_nav('footer', 'trezise_fallback_footer'); ?>
    </div>
    <div>
      <h4><?php esc_html_e('Contact', 'trezise-insurance'); ?></h4>
      <p>215 E Commerce St.<br>Jacksonville, Tx. 75766<br><a class="tz-footer-phone" href="tel:9032842821">(903) 284-2821</a></p>
    </div>
    <div>
      <h4><?php esc_html_e('Hours', 'trezise-insurance'); ?></h4>
      <ul class="tz-hours">
        <li><span><?php esc_html_e('Monday', 'trezise-insurance'); ?></span><span>9 AM &ndash; 5 PM</span></li>
        <li><span><?php esc_html_e('Tuesday', 'trezise-insurance'); ?></span><span>9 AM &ndash; 4 PM</span></li>
        <li><span><?php esc_html_e('Wednesday', 'trezise-insurance'); ?></span><span>9 AM &ndash; 5 PM</span></li>
        <li><span><?php esc_html_e('Thursday', 'trezise-insurance'); ?></span><span>9 AM &ndash; 5 PM</span></li>
        <li><span><?php esc_html_e('Friday', 'trezise-insurance'); ?></span><span>9 AM &ndash; 12 PM</span></li>
        <li><span><?php esc_html_e('Saturday', 'trezise-insurance'); ?></span><span><?php esc_html_e('By appointment', 'trezise-insurance'); ?></span></li>
        <li><span><?php esc_html_e('Sunday', 'trezise-insurance'); ?></span><span><?php esc_html_e('Closed', 'trezise-insurance'); ?></span></li>
      </ul>
    </div>
  </div>
  <div class="tz-footer-bottom"><div class="tz-wrap"><span>&copy; <?php echo esc_html(gmdate('Y')); ?> <?php bloginfo('name'); ?><span class="tz-legal-tail"> &middot; <?php esc_html_e('Licensed &amp; Local &middot; Jacksonville, Texas', 'trezise-insurance'); ?></span></span><span class="tz-credit"><?php esc_html_e('Made with', 'trezise-insurance'); ?> <span class="tz-heart" aria-hidden="true">&hearts;</span> <?php esc_html_e('by', 'trezise-insurance'); ?> <a href="http://www.Ez-IT-Solutions.com" target="_blank" rel="noopener">Ez IT Solutions</a></span></div></div>
</footer>
<a class="tz-mobile-call" href="tel:9032842821"><?php esc_html_e('Call Trezise Insurance', 'trezise-insurance'); ?></a>
<?php wp_footer(); ?>
</body>
</html>
