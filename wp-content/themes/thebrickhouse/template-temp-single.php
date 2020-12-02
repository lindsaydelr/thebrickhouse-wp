<?php
/**
 * Template Name: Temporary Single Page
 */
?><!DOCTYPE html>

<html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel='stylesheet' id='bootstrap-css' href='<?php echo get_stylesheet_directory_uri(); ?>/_old-assets/bootstrap.min.css?ver=5.5.3' type='text/css' media='all' />
    <script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/_old-assets/bootstrap.bundle.min.js?ver=5.5.3' id='bootstrap-js'></script>
    <link rel='stylesheet' id='brickhouse-kickstarter-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/_old-assets/index.css?ver=5.5.3' type='text/css' media='all' />

    <title><?php the_title(); ?> &mdash; The Brick House Cooperative</title>

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

    <header class="main-header">
      <div class="container">
        <div class="row">
          <div class="col">
            <a href="https://thebrick.house/" class="custom-logo-link" rel="home" aria-current="page">
              <?php echo wp_get_attachment_image( '73', array( '690', '122' ) ); ?>
            </a>
            <h2 class="tagline text-right">A new cooperative for free and independent press</h2>
          </div>
        </div>
      </div>
    </header>

    <div class="container main-content">

      <div class="row">
        <div class="col">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
          <?php endwhile; else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
          <?php endif; ?>
        </div>
      </div>

      <div class="row cta-links">
          <p class="cta-link-2">
            <a href="https://thebrick.house/contact-us/">
              Contact us
            </a>
          </p>
          <p class="cta-link-3">
            <a href="https://thebrick.house/who-we-are/">
              Who are we???
            </a>
          </p>
          <p class="cta-link-1">
            <a href="https://thebrick.house/press-about-our-mission/">
              Press
            </a>
          </p>
      </div>

    </div>

    <?php wp_footer(); ?>

  </body>

</html>
