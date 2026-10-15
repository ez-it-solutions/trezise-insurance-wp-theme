<?php
/**
 * Fallback template — generic loop for anything without a dedicated
 * template (blog index, archives, taxonomies).
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="top">
  <section class="tz-section">
    <div class="tz-wrap">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article <?php post_class('tz-card'); ?> style="margin-bottom:24px">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
          </article>
        <?php endwhile; ?>
        <div class="tz-actions"><?php the_posts_pagination(); ?></div>
      <?php else : ?>
        <div class="tz-intro">
          <div class="tz-kicker"><?php esc_html_e('Nothing here yet', 'trezise-insurance'); ?></div>
          <h2><?php esc_html_e('No posts found.', 'trezise-insurance'); ?></h2>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php
get_footer();
