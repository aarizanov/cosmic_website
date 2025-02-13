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
define('DB_NAME', 'cosmic_db');

/** MySQL database username */
define('DB_USER', 'cosmicdb');

/** MySQL database password */
define('DB_PASSWORD', 'hzYS#thB=sQ687E!');

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
define('AUTH_KEY',         'QuNQmtQ~!>EiF7T%uoBlHP9qA/1o~_|o7G.3x{)XARK<%EA<5:GQ;ZI@nD`b%5[1');
define('SECURE_AUTH_KEY',  'd{% fQXj#m&}=WRA|9 M~?n2l~`wQH4PVL5[N65j^`?Ss&>]L.W%jiIIR>7Ri9G@');
define('LOGGED_IN_KEY',    '>[B?vp[lbI2qzD,11AyAf;ZN^L2z;L|?SXY?ulSI$D: YnuoQdl<orC=&#L0xLfZ');
define('NONCE_KEY',        'xL!-0CE.7iE{8G&L7p5)6Y0;jaE>*$#Or1g{c;lNr[cM**oKQQX%E]0[dRm^wdXL');
define('AUTH_SALT',        'Tv)lsiG|BX-ZA3pq,JYkD29Mtw7)%xG.RkYoGJ%DP=YW6,m|y$B5:KTla|GWA;bk');
define('SECURE_AUTH_SALT', '/u+oZe`#FAA85re9+yD`3RK1_(RVmhA5JJ3/pCsCU~Aa3#m2 me~ ._Y(.-hi_er');
define('LOGGED_IN_SALT',   'ZC!E9FzOZ(OajrCU~S6YIIz_J&fc+m^)eH))*h(47eV8l^2M}N0R;k>kMQFB&,VB');
define('NONCE_SALT',       'ssqr(kl2bWSa@9^=>_XX$VmmS(~Qu/o),e<yBtoc9}VU%>{LF;Tq:&x+,a<am{eP');

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

