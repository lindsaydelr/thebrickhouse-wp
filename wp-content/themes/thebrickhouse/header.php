<?php
/**
 * Page header template.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;

?><!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, viewport-fit=cover">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="icon" sizes="192x192" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicons/favicon.png?v=<?php echo CACHEBUST; ?>">
  <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicons/apple-touch-icon.png?v=<?php echo CACHEBUST; ?>">
  <link rel="mask-icon" color="<?php echo THEME_COLOR; ?>" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicons/safari-pinned-tab.svg?v=<?php echo CACHEBUST; ?>">
  <meta name="theme-color" content="<?php echo THEME_COLOR; ?>">
  <meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?>">
  <meta name="application-name" content="<?php bloginfo( 'name' ); ?>">

  <?php if ( is_production() ): ?>
    <!-- Analytics, etc.? -->
  <?php endif; ?>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Faustina:ital,wght@0,400;0,700;1,400&family=Oswald:wght@600&display=swap" rel="stylesheet">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <div class="page-container">

    <header class="page-header" role="banner">
      <div class="constrain">

        <a class="screen-reader-shortcut" href="#content" tabindex="0">Skip to Content</a>

        <button class="page-header__open-nav-trigger display--mobile-only" id="mobile-nav-open-button" type="button" aria-haspopup="true" aria-expanded="false" aria-controls="header-nav" aria-label="open nav">
          <?php echo get_svg( 'menu' ); ?>
        </button>

        <div class="page-header__logo">
          <a href="<?php echo bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?> homepage">
            <?php echo get_svg( 'brick-house-logo-banner', 'no-fill' ); ?>
          </a>
        </div>

        <div class="page-header__nav" id="header-nav">
          <button class="page-header__close-nav-trigger display--mobile-only" id="mobile-nav-close-button" type="button" aria-haspopup="true" aria-expanded="false" aria-controls="header-nav" aria-label="close nav">
            <?php echo get_svg( 'close' ); ?>
          </button>
          <div class="page-header__nav__logo display--mobile-only">
            <a href="<?php echo bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?> homepage">
              <?php echo get_svg( 'brick-house-logo-banner', 'no-fill' ); ?>
            </a>
          </div>
          <nav class="page-header__nav__menu" role="navigation" aria-label="Main Navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'header' ) ); ?>
            <div class="page-header__publications-nav" id="header-publications-nav">
              <div class="page-header__publications-nav__heading">Publications</div>
              <div class="page-header__publications-nav__list">
                <button class="page-header__publications-nav__close-nav-trigger display--tablet-only" id="publications-nav-close-button" type="button" aria-haspopup="true" aria-expanded="false" aria-controls="header-publications-nav" aria-label="close publications list">
                  <?php echo get_svg( 'close' ); ?>
                </button>
                <ul>
                  <?php
                  $publications = get_publications();
                  foreach ( $publications as $publication ):
                  ?>
                    <li><a href="<?php echo $publication['url']; ?>"><?php echo $publication['title']; ?></a></li>
                  <?php
                  endforeach;
                  ?>
                </ul>
              </ul>
            </div>
          </nav>
        </div>

        <button class="PicoRule page-header__subscribe-button">Join</button>

      </div>
    </header>

    <main class="page-content" id="content" role="main">
