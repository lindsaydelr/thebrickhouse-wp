<?php
/**
 * 404 error template.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


get_header();
?>

<article>

  <div class="constrain text--center">
    <h1 class="page-title">404</h1>
    <h2>Page Not Found</h2>
    <p>Sorry, but the page you are looking for could not be found.</p>
    <p><a href="<?php echo bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?> homepage">Go back to homepage</a></p>
  </div>

</article>

<?php
get_footer();
