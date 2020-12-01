<?php
/**
 * Page footer template.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;
?>


  </main>

  <footer class="page-footer">
    <div class="page-footer--section page-footer__nav">
      <div class="constrain">
        <div class="page-footer__nav__logo">
          <?php echo get_svg( 'brick-house-logo-banner', 'no-fill' ); ?>
        </div>
        <div class="page-footer__nav__links">
          <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
        </div>
      </div>
    </div>
    <div class="page-footer--section page-footer__publications">
      <div class="constrain">
        <div class="page-footer__publications__heading">Publications</div>
        <div class="page-footer__publications__list">
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
        </div>
      </div>
    </div>
    <div class="page-footer--section page-footer__fine-print">
      <div class="constrain">
        <p>A publication of <a href="<?php echo network_home_url(); ?>">The Brick House Cooperative</a>. All rights reserved. Copyright <?php echo date( 'Y' ); ?>.</p>
      </div>
    </div>
  </footer>

</div> <!-- .page-container -->

<?php wp_footer(); ?>

</body>
</html>
