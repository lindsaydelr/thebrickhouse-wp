<!DOCTYPE html>

<html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel='stylesheet' id='bootstrap-css' href='<?php echo get_stylesheet_directory_uri(); ?>/_old-assets/bootstrap.min.css?ver=5.5.3' type='text/css' media='all' />
    <script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/_old-assets/bootstrap.bundle.min.js?ver=5.5.3' id='bootstrap-js'></script>
    <link rel='stylesheet' id='brickhouse-kickstarter-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/_old-assets/index.css?ver=5.5.3' type='text/css' media='all' />

    <title>The Brick House Cooperative</title>

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

    <header class="main-header">
      <div class="container">
        <div class="row">
          <div class="col">
            <a href="https://thebrick.house/" class="custom-logo-link" rel="home" aria-current="page">
              <?php wp_get_attachment_image( '73' ); ?>
            </a>
            <h2 class="tagline text-right">A new cooperative for free and independent press</h2>
          </div>
        </div>
      </div>
    </header>

    <div class="container">

      <div class="row editable-content">
        <div class="col">
          <?php
          // Get homepage content.
          get_the_content();
          ?>
        </div>
      </div>

      <div class="row kickstarter-cta">
        <div class="col text-center">
            <div class="kickstarter-block">
                <h2>Find out more about us on our recent</h2>
                <a href="https://www.kickstarter.com/projects/1478924964/the-brick-house-cooperative">
                    <img class="img-fluid"  src="<?php echo get_stylesheet_directory_uri(); ?>/_old-assets/images/logo_kickstarter.png" alt="Join us on Kickstarter!">
                </a>
                <div><a class="button" href="https://www.kickstarter.com/projects/1478924964/the-brick-house-cooperative">Join Us!</a></div>
            </div>

            <div class="mailchimp-container">
                <div class="mailchimp-brickhouselogo">
                    <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/_old-assets/images/logo_emailbrickhouse.jpg" alt="Brick House Email!">
                </div>

                <div class="mailchimp-form">
                  <!-- Begin Mailchimp Signup Form -->
                  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                  <style type="text/css">

                      /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                        We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                  </style>
                  <div id="mc_embed_signup">
                  <form action="https://popula.us17.list-manage.com/subscribe/post?u=32a22cc8bacf327fb3bb5066e&amp;id=7757e9bd40" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                      <div id="mc_embed_signup_scroll">

                  <div class="mc-field-group">
                      <label for="mce-EMAIL"><h2>Get Periodic Email from the COOP</h2></label>
                      <div class="sameline">
                          <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address">


                          <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_32a22cc8bacf327fb3bb5066e_7757e9bd40" tabindex="-1" value=""></div>
                          <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                      </div>

                      <div id="mce-responses" class="clear">
                          <div class="response" id="mce-error-response" style="display:none"></div>
                          <div class="response" id="mce-success-response" style="display:none"></div>
                      </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                  </div>
                  </form>
                  </div>
                  <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                  <!--End mc_embed_signup-->
              </div>
            </div>

        </div>
      </div>

      <div class="row site-logos">
        <div class="col-6 col-sm-4 site-logo">
          <img src="https://thebrick.house/wp-content/uploads/2020/08/PopGlobe-500x500.png" alt="Popula" title="Online agora for an alt-global audience: humanist, egalitarian perspectives on news and culture, founded by Maria Bustillos." width="200" height="200" class="img-fluid">
        </div>

        <div class="col-6 col-sm-4 site-logo">
          <img src="https://thebrick.house/wp-content/uploads/2020/08/Sludge_no_border-500x500.png" alt="Sludge" title="Investigative journalism on money in politics and political corruption, co-founded by David Moore and Donald Shaw." width="200" height="200" class="img-fluid">
        </div>

        <div class="col-6 col-sm-4 site-logo">
          <img src="https://thebrick.house/wp-content/uploads/2020/08/hmm_daily.png" alt="Hmm Daily" title="" width="200" height="200" class="img-fluid">
        </div>

        <div class="col-6 col-sm-4 site-logo">
          <img src="https://thebrick.house/wp-content/uploads/2020/08/nomanislandcolor-500x500.png" alt="No Man is an Island" title="A new blog focused on the connections between everyday life and politics, writing on Taiwan and other places from editor Brian Hioe." width="200" height="200" class="img-fluid">
        </div>

        <div class="col-6 col-sm-4 site-logo">
          <img src="https://thebrick.house/wp-content/uploads/2020/08/olongocircle-500x500.png" alt="OlongoAfrica" title="A community of opinion, literature, travelogue, journalism, and topical writing from Kọ́lá Túbọ̀sún, a Nigerian writer and editor." width="200" height="200" class="img-fluid">
        </div>

        <div class="col-6 col-sm-4 site-logo">
          <img src="https://thebrick.house/wp-content/uploads/2020/08/awrytransparentexperiment-2-500x500.png" alt="Awry" title="A new hub for comics edited by Jason Adam Katzenstein, with An emphasis on new voices, critiques of power, and specific stories never before seen in cartoon form." width="200" height="200" class="img-fluid">
        </div>

        <div class="col-6 col-sm-4 site-logo">
          <img src="https://thebrick.house/wp-content/uploads/2020/08/FAQ_NYC_LOGO2-500x500.png" alt="FAQ NYC" title="A podcast that tries to make sense of New York City, brought to you by Professor Christina Greer, Harry Siegel, and Alexandria Lynn." width="200" height="200" class="img-fluid">
        </div>

        <div class="col-6 col-sm-4 site-logo">
          <img src="https://thebrick.house/wp-content/uploads/2020/08/preachy-logo-500x500.png" alt="Preachy" title="A new space to write and think critically about spirituality, religiosity, and modes of peace and introspection, from Mike Kanin and Sunny Sone." width="200" height="200" class="img-fluid">
        </div>

        <div class="col-6 col-sm-4 site-logo">
          <img src="https://thebrick.house/wp-content/uploads/2020/08/tastefulrude1.png" alt="Tasteful Rude" title="Drilling into the intersection of art, literature, celebrity, and politics, eschewing the white cishet male gaze in favor of every other gaze, by writer and arist Myriam Gurba." width="200" height="200" class="img-fluid">
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
