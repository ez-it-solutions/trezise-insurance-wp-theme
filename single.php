<?php
/** Single post template. */
if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="top">
  <section class="tz-section">
    <div class="tz-wrap">
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
          <div class="tz-intro"><h2><?php the_title(); ?></h2></div>
          <?php if (has_post_thumbnail()) : ?>
            <p><?php the_post_thumbnail('large'); ?></p>
          <?php endif; ?>
          <?php the_content(); ?>
          <?php
          if (comments_open() || get_comments_number()) {
              comments_template();
          }
          ?>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
</main>
<?php
get_footer();
