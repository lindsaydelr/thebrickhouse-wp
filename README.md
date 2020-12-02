# The Brick House

The WordPress theme for the Brick House network at [thebrick.house](https://thebrick.house).

## Table of Contents

- [Setup](#setup)
- [Development](#development)
- [Deployment with Git](#deployment-with-git)

## Setup

Here's how to get your local copy of the site up and running.

### Quick Overview

We create a local WordPress installation using Local WP, download this
repository that contains the theme files, enable the theme in WordPress, install
plugins, grab the latest staging/production database, and then get to work.

### Setup, Part 1: Install WordPress Locally

01. Download and install [Local WP](https://localwp.com/).

02. Open Local WP. Create a new site called 'The Brick House.' Keep the defaults and
    choose the 'Preferred' environment. That looks like this:

    Detailed settings:
    - Page 1: What's your site's name?
      - Name: **The Brick House**
      - Advanced Options:
        - Local site domain: **brickhouse.local**
        - Local site path: **~/Local Sites/the-brick-house/**
        - Create site from Blueprint: **No**
    - Page 2: Choose your environment: **Preferred**
    - Page 3: Setup WordPress:
      - WordPress Username: **admin**
      - WordPress Password: **admin**
      - WordPress Email: **[keep the default]**
      - Avanced Options:
        - Is this a WordPress multisite? **Yes - Subdirectory**

03. Once the site is created in Local WP, click on the 'SSL' tab and click
    'Trust' to enable SSL on the local installation.

05. Open your terminal app.

06. Change directory to the site's WordPress core directory:

    ```sh
    cd ~/Local\ Sites/the-brick-house/app/public/
    ```

07. Clone this repository into it.

    ```sh
    git clone git@github.com:matthewmcvickar/thebrickhouse-wp.git
    ```

    **NOTE:** This repo does not version any of the WordPress core files or
    uploads or plugins. Core files do not need to be versioned here, as they are
    handled by WP Engine. Uploads are not included to save space. Plugins are
    handled by a library called TGM Plugin Activation; see the file at
    `wp-content/themes/thebrickhouse/include/required-plugins.php` for details.

08. Make a few symlinks in the root of the site folder to make navigation
    easier.

    ```sh
    cd ~/Local\ Sites/the-brick-house/
    ln -s app/public/ repo
    ln -s app/public/wp-content/plugins/ plugins
    ln -s app/public/wp-content/themes/brickhouse/ theme
    ```

09. Activate the theme. Go to the
    [WordPress admin theme settings](https://brickhouse.local/wp-admin/themes.php)
    and log in (username `admin` and password `admin` unless you changed that
    during setup). Under 'The Brick House' in the theme list, click 'Activate.'

10. Once you activate the theme, you'll get a warning that some plugins are
    required. Click the 'Begin Installing Plugins' link in that warning. Select
    all of the plugins in the list, install them, then activate them.


### Setup, Part 2: Sync the Staging Database to Local

01. Add WP DB Migrate Pro license key on the [settings page](https://brickhouse.local/wp-admin/network/settings.php?page=wp-migrate-db-pro#settings). Ask Matthew McVickar
    (matthew@matthewmcvickar.com) for the license key if you don't have one.

02. Still on the Migrate DB screen, click on the 'Migrate' tab. From the
    list of options, select 'Pull.'

03. In a new tab, copy the Connection Info key from the [staging server's WP DB Migrate Pro settings](https://thebrick.house/wp-admin/tools.php?page=wp-migrate-db-pro#settings).

04. Go back to your local Migrate DB screen and paste the connection key.

05. Once connected, do an initial sync.

    Detailed settings:
    - Leave the 'Find & Replace' settings as is.
    - Tables: **leave the first option selected: Migrate all tables with prefix "wp_"**
    - Exclude post types: **leave unchecked**
    - Advanced Options: **check all checkboxes**
    - Backup the local database before replacing it: **leave unchecked**
    - Media Files: **leave unchecked**
    - Save Migration Profile: name it **Pull from Production**

06. Click 'Pull & Save' to sync for the first time.

07. You will be logged off after this initial sync. From now on, you'll log in
    using your WP login from the production/staging environments.


### Setup, Part 3: Use Production Images in Development

Now we'll make it so all requests to the `wp-content/uploads/` folder are
rewritten to query the production site so that you can see all the uploaded
images without having to download them.

01. At the base of your site installation, note the `conf/` folder. Create a new
    file at `conf/nginx/uploads-proxy.conf` with the following:

    ```
    location ~ ^/wp-content/uploads/(.*) {
      try_files $uri $uri/ @uploadsproxy;
    }

    location @uploadsproxy {
      resolver 8.8.8.8; # Use Google for DNS.
      resolver_timeout 60s;
      proxy_http_version 1.1;
      proxy_pass https://thebrick.house/wp-content/uploads/$1$is_args$args;
    }
    ```

    Save the file.

03. Then open `conf/nginx/site.conf`. Under the if/else statement labeled
    `WordPress Rules` (around line 31) add the following:

    ```
    #
    # Proxy requests to the upload directory to the production site
    #
    include uploads-proxy.conf;
    ```

    Save the file.

04. Go back to Local WP and restart the site. You now have images!


---


## Development

### How to Get Development Build Tools Running

1. Make sure you have [Node and NPM installed](https://docs.npmjs.com/getting-started/installing-node).

2. Navigate to the theme folder. (This uses the symlinks created in 'Setup, Part
   1'.)

   ```sh
   cd ~/Local\ Sites/the-brick-house/app/public/
   cd theme
   ```

3. Install dependencies:

    ```sh
    npm install
    ```

### Where Things Are (CSS, JS, and Images)

- Source files are kept in the `_src/` folder and compiled into the theme folder
  at `wp-content/themes/thebrickhouse/assets`.
- **JavaScript** is compiled by Webpack, which transpiles and bundles the code
  from `_src/js/` into `assets/js/main.js`.
- **CSS** is written in SASS syntax. It stored in `_src/css/` and compiled
   to `assets/css/`.
- **Images** are optimized from `_src/images/` and copied to
  `assets/images/`.
- **⚠️ NOTE:** The `assets/images/` folder is the destination for optimized
  images. **It will be deleted every time development scripts are run** in
  order to clear out old files. Don't put files directly into the
  `assets/images/` folder!


### How to Watch Files and Compile Assets While Developing the Website

Gulp is used to handle development tasks.

First, navigate into the theme folder:

   ```sh
   cd ~/Local\ Sites/the-brick-house/app/public/
   cd theme
   ```

To start the asset compilation, run the script that builds and watches for
changes in the CSS/JS/images folders:

  ```sh
  npm run dev
  ```

  (This runs the `gulp dev` command.)

  OR

  ```sh
  npm start
  ```

  (This is a shortcut for `npm run dev`.)


---


## Deployment with Git

The site can be deployed to the staging or production environments on WP Engine
via Git.

Follow [WP Engine's Git deployment instructions](https://wpengine.com/support/git/)
to get yourself set up to push to WP Engine with Git. In particular, do these
steps:

1. [Generate an SSH key.](https://wpengine.com/support/git/#Generate_SSH_Key)

2. [Create or update your SSH config.](https://wpengine.com/support/git/#Create_SSH_Config)

3. [Add your SSH key to the WP Engine portal.](https://wpengine.com/support/git/#Add_SSH_Key_to_User_Portal)

4. [Confirm Git access.](https://wpengine.com/support/git/#Confirm_Git_Access)

Once you've confirmed you have Git access, you can add the remotes to Git.

5. [Add Git remotes.](https://wpengine.com/support/git/#Add_Git_Remotes) I
   suggest the following, as the NPM scripts used to deploy assume these remote
   names:

    ```sh
    git remote add staging git@git.wpengine.com:production/stagebrickhous
    git remote add production git@git.wpengine.com:production/thebrickhous
    ```

    (It looks confusing, but they both have `git@git.wpengine.com:production/`
    on purpose.)

### Push to Staging

This script will compile minified assets, bump the cache-busting version number,
make a deployment commit, push it to GitHub, and then deploy it to the staging
environment. (Make sure to run this from within the repo.)

```sh
npm run deploy-staging
```

### Push to Production

This script will compile minified assets, bump the cache-busting version number,
make a deployment commit, push it to GitHub, and then deploy it to the production
environment. (Make sure to run this from within the repo.)

```sh
npm run deploy-production
```
