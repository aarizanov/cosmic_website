<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cosmic_development');

/** MySQL database username */
define('DB_USER', 'cosmicdb');

/** MySQL database password */
define('DB_PASSWORD', 'A^C#jhg#$%762vL8@pK');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'V|+/k^kG2w-y,mu>}|EQ;-]D/fSNdUSQ|5(U~FjHxaRjTj|s$~/U6[H#cI^ >DBp');
define('SECURE_AUTH_KEY',  '=ko,gnC&C:+@dX/lX4hj8_*?j^{7e+%$D(j7]HD_-JHHo7^LQ*>lN*`~o#F&>]y!');
define('LOGGED_IN_KEY',    'FXoAdWd.%0Jy^--+?_^F`}_8hKG*C1h[t(Jnej])w4I|q0qk1#-}+lG*Ji=|=1o}');
define('NONCE_KEY',        ')S|},-6D&`skMe1bKYc.$pTL_hXuRN>u.8,[6/&~qtq-`L*[Xg]:8+vS#x0Wy?<^');
define('AUTH_SALT',        'igUV)}-RYcb7JPE4wFQogz_ql)eWxi/3lyy+].6/)Fi~-tc8nD;s6:SRxwn17aE<');
define('SECURE_AUTH_SALT', 'zl$/gxj{(V%O2f|53T4~fqMwr4(<0c**!wxRCGr?|}~#0yT8 SGU-E_rTnoz5t{f');
define('LOGGED_IN_SALT',   'D[)^hCGA`5z:_ZAC,Eih.<Khhl$ejP(0F>rfdJXd-IKUiFe}9B:Y.ip$`HfiZ3Sz');
define('NONCE_SALT',       'rt0uem^];fC1<F8RF{^HONz-9U|reLIzxkm$c| x}}A]Qg2K@VH%,Q%V>N:1CX_f');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
#define('WP_DEBUG', false);
define('WP_MEMORY_LIMIT', '256M');
define('FS_METHOD', 'direct');

define('WP_DEBUG', true);
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );


define('WP_HOME', 'https://www.cosmicdevelopment.com/');
define('WP_SITEURL', 'https://www.cosmicdevelopment.com/');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

