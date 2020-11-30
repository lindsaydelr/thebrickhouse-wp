<?php
/**
 * Basic template.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


get_header();
?>

<?php
// List all publications.
?>

<div class="constrain">

  <?php
  // Get featured posts.
  $featured_post_IDs = get_field( 'homepage_featured_posts', 'option' );
  if ( ! empty( $featured_post_IDs ) ):
  ?>
    <div class="homepage-section">
      <h2 class="homepage-section__title full-bleed--mobile">The Latest</h2>
      <div class="featured-posts">

        <?php
        $featured_posts = get_posts( array(
          'post_type' => INTERNAL_AND_EXTERNAL_POST_TYPES,
          'post__in'  => $featured_post_IDs,
        ) );

        // First post is the hero.
        $hero_post = $featured_posts[0];

        // The rest are everything but the hero.
        $other_featured_posts = array_slice( $featured_posts, 1 );
        ?>
        <div class="featured-posts__hero">
          <?php
          // First story is hero-size, the rest are regular size.
          $post = $hero_post;
          setup_postdata( $post );

          get_template_part( 'template-parts/post-preview', null, array(
            'thumbnail_size'     => 'hero',
            'post_preview_style' => 'hero',
          ) );

          wp_reset_postdata();
          ?>
        </div>
        <div class="featured-posts__the-rest">
          <?php
          foreach ( $other_featured_posts as $post ) {
            setup_postdata( $post );

            get_template_part( 'template-parts/post-preview', null, array(
              'post_preview_style' => 'sidebar',
              'show_image'         => false
            ) );

            wp_reset_postdata();
          }
          ?>
        </div>

        <?php
        rewind_posts();
        ?>

      </div>
    </div>
  <?php endif; ?>

  <div class="mailing-list-cta">
    <h2 class="mailing-list-cta__heading">Sign Up for Our Mailing List!</h2>
    <div class="mailing-list-cta__description">We promise to be nice.</div>
    <div class="mailing-list-cta__form">
      <form class="mailing-list-form">
        <input type="email" class="mailing-list-form__email-field" placeholder="your email address">
        <input type="submit" class="mailing-list-form__submit-button" value="Do it!">
      </form>
    </div>
  </div>

  <div class="main-and-sidebar">

    <div class="main">
      <div class="post-list">
        <?php
        if ( have_posts() ):
          while ( have_posts() ): the_post();
            get_template_part( 'template-parts/post-preview', null, array() );
          endwhile;
        endif;
        ?>
      </div>
    </div>

    <div class="sidebar">
      <div class="homepage-section">
        <h2 class="homepage-section__title full-bleed--mobile">The Wolf-proof Media Collective</h2>
        <div class="homepage-section__content">
          <?php the_field( 'homepage_introductory_statement', 'options' ); ?>
        </div>
      </div>

      <div class="homepage-section">
        <h2 class="homepage-section__title full-bleed--mobile">Our Publications</h2>
        <div class="publications-list">
          <?php
          $publications = get_publications();
          foreach ( $publications as $publication ):
          ?>
            <div class="publications-list__item">
              <a class="publications-list__link" href="<?php echo $publication['url']; ?>"></a>
              <div class="publications-list__logo"><?php echo wp_get_attachment_image( $publication['logo_attachment_ID'], 'small' ); ?></div>
              <div class="publications-list__title-and-description">
                <div class="publications-list__title"><?php echo $publication['title']; ?></div>
                <div class="publications-list__description"><?php echo $publication['description']; ?></div>
              </div>
            </div>
          <?php
          endforeach;
          ?>
        </div>
      </div>
    </div>

  </div>

  <div class="homepage-section">
    <h2 class="homepage-section__title full-bleed--mobile">Founding Editors</h2>
    <div class="editors-list">
      <?php
      $editors = get_field( 'editors', 'options' );
      foreach ( $editors as $editor ):
      ?>
        <div class="editors-list__item">
          <h3 class="editors-list__name font--match-style">
            <?php if ( $editor['editor_link'] ): ?>
              <a href="<?php echo $editor['editor_link']; ?>" rel="noopener" target="_blank"><?php echo $editor['editor_name']; ?></a>
            <?php else: ?>
              <?php echo $editor['editor_name']; ?>
            <?php endif; ?>
          </h3>
          <div class="editors-list__publication">(<?php echo get_publication_link( $editor['editor_publication'] ); ?>)</div>
          <div class="editors-list__bio"><?php echo $editor['editor_bio']; ?></div>
        </div>
      <?php
      endforeach;
      ?>
    </div>
  </div>

</div>

<?php
get_footer();
