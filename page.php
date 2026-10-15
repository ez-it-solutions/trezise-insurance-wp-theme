<?php
/** Single page template. */
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
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
</main>
<?php
get_footer();
