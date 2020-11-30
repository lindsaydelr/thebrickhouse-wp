<?php
/**
 * Template for a post thumbnail/preview, one in a list of posts.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


// Get args.
$args = wp_parse_args( $args, array(
  'post_preview_style' => 'default',
  'thumbnail_size'     => 'post-thumbnail',
  'show_image'         => true,
) );

// Get post details.
if ( is_external_post() ) {
  $post_details = cached__get_external_post_details();

  $publication = get_post_publication();
  $url         = $post_details['url'];
  $title       = $post_details['title'];
  $description = $post_details['description'];
  $thumbnail   = '<img src="' . $post_details['thumbnail_url'] . '" loading="lazy">';
  $author      = get_coauthors();
  $date        = date( get_option('date_format'), strtotime( $post_details['date'] ) );

  // Get date in pieces.
  $date_month = date( 'M', strtotime( $post_details['date'] ) );
  $date_day   = date( 'd', strtotime( $post_details['date'] ) );
  $date_year  = date( 'Y', strtotime( $post_details['date'] ) );
}
else {
  $publication = get_post_publication();
  $url         = get_the_permalink();
  $title       = get_the_title();
  $description = get_the_excerpt();
  $thumbnail   = get_the_post_thumbnail( $post, $args['thumbnail_size'] );
  $author      = get_coauthors();
  $date        = get_the_date();

  // Get date in pieces.
  $date_month = get_the_date( 'M' );
  $date_day   = get_the_date( 'd' );
  $date_year  = get_the_date( 'Y' );
}

/*
  Fancy date HTML, which we're not using:
  <div class="fancy-date">
    <div class="fancy-date__month"><?php echo $date_month; ?></div>
    <div class="fancy-date__day"><?php echo $date_day; ?></div>
    <div class="fancy-date__year"><?php echo $date_year; ?></div>
  </div>
*/
?>

<div class="post-preview post-preview--<?php echo $args['post_preview_style']; ?>">

  <div class="post-preview__publication-logo">
    <?php echo wp_get_attachment_image( $publication['logo_id'], 'small' ) ?>
  </div>

  <h3 class="post-preview__title">
    <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
  </h3>

  <div class="post-preview__author">
    <span class="post-preview__author-prefix">by</span>
    <?php coauthors_posts_links(); ?>
  </div>

  <div class="post-preview__description">
    <p><?php echo $description; ?></p>
  </div>

  <?php if ( $args['show_image'] ): ?>
    <div class="post-preview__thumbnail">
      <a href="<?php echo $url; ?>">
        <?php echo $thumbnail; ?>
      </a>
    </div>
  <?php endif; ?>

  <div class="post-preview__footer">
    <div class="post-preview__publication">
      <span class="post-preview__publication-prefix">From</span>
      <a class="post-preview__publication-title" href="<?php echo $publication['url']; ?>"><?php echo $publication['title']; ?></a>
    </div>
    <div class="post-preview__date">
      <span class="post-preview__date-prefix">On</span>
      <span class="post-preview__date-value"><?php echo $date; ?></span>
    </div>
  </div>

</div>
