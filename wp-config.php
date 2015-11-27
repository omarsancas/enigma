<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'enigmaro_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Dearprudence81828384$');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'IuVaV72EPNPXtWInudTnV2vaOe40Is9s0frXjrPI0jZ7d5y2HZmS1Ng9MjBmoJqu');
define('SECURE_AUTH_KEY',  'hjYFq9MT4gQux0d3KrjjCi6lYe8JE6FxYT2r0IZFImYHg4digf22LKOlSVaZVG9z');
define('LOGGED_IN_KEY',    'Sej3pK3o1HLid31IHEk9JcRduV2jos66fZAgt0VhoxowkFXMREqRryIIqjpNlMgH');
define('NONCE_KEY',        'OPnBeRHLGVMVUK78YiOmIxmKLxgCR7ApUInB3IXJvQYYWtanQVSHRrqQmWdsLQoE');
define('AUTH_SALT',        'u9WEcE5eOh19bPlPqN4ftOdgaYst3HSqcim7iMg777qvBlOkXrXBul1aCP0fMwWQ');
define('SECURE_AUTH_SALT', 'haoZv5ZEUYjhdPJcQHDSl2WPn11H0O4ZPk9DEotv8sc7ULZ0TU3nYwCcZJCMh4qZ');
define('LOGGED_IN_SALT',   'NH2Hr2Na1Ky1Mpdxv5VDaHSTMPp4GJo2raQwxCWubTGMCrdt6oMxSJDRFSHgtDdF');
define('NONCE_SALT',       'HfOCGIv71rS5jauYqRKqIb85rlXI8iLJTLMIRWp4F1Gmgat2gtiGzC4DJMZ0KaHO');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
