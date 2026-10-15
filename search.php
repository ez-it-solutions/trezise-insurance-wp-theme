<?php
/** Search results template. */
if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="top">
  <section class="tz-section">
    <div class="tz-wrap">
      <div class="tz-intro">
        <div class="tz-kicker"><?php esc_html_e('Search results', 'trezise-insurance'); ?></div>
        <h2><?php printf(esc_html__('Results for “%s”', 'trezise-insurance'), esc_html(get_search_query())); ?></h2>
      </div>
      <?php if (have_posts()) : ?>
        <div class="tz-cards">
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('tz-card'); ?>>
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <?php the_excerpt(); ?>
            </article>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <p><?php esc_html_e('Nothing matched — try another term, or call and we’ll point you the right way.', 'trezise-insurance'); ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php
get_footer();
