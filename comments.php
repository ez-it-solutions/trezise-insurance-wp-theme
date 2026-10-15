<?php
/** Comments template — stock markup, styled by the section system. */
if (! defined('ABSPATH')) {
    exit;
}
if (post_password_required()) {
    return;
}
?>
<div class="tz-facts" style="margin-top:32px">
  <?php if (have_comments()) : ?>
    <h3><?php comments_number(); ?></h3>
    <ol><?php wp_list_comments(); ?></ol>
    <?php the_comments_navigation(); ?>
  <?php endif; ?>
  <?php comment_form(); ?>
</div>
