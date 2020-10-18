<?php
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'nRIZ36ra@b,$71eS5o9Zl8hJ$i|$}QPN^}ICNv[d<wxXtNGYI4obgt3uVy8o77BG' );
define( 'SECURE_AUTH_KEY',  ':8CR]VZzsb_iD8[r&NgVE$BhMGU^`x~<PMOU1s2zi4;t,KTCr_t6.eaiaqDw?7o=' );
define( 'LOGGED_IN_KEY',    'lJ0>f$j6&q>.jd-o+?*d|eYRbD>sIG@[^.]QMfd[]~Z)L}:KreB.e525mx75=jC-' );
define( 'NONCE_KEY',        'zZx{;oB)ie6~%,9_,*59MPQ~NXESgTX.z1>MJ~$@#lF;j%vE-9FA,n<eEB5Q*L0O' );
define( 'AUTH_SALT',        'rd*|a7*d;H<c|BxfaOXMkSELoUn+jv|UO@lr1b0{02N biH<bH)_Dn9.Iq#U&o9P' );
define( 'SECURE_AUTH_SALT', 'QQ0`c[wX/-6Df-zxR[,)n4Ez.R6^:G*{Tevv?;e25Gf9I~RSC9l:I4p$yxb%qv&1' );
define( 'LOGGED_IN_SALT',   '44*S$:oilN?52QLC*]u:vi-EpM!{Ujjstf9b{(5WK}iT@UJ(iAP9IL~;9oJs1 )6' );
define( 'NONCE_SALT',       'PH:PB5UX>?V<xc^$,QyS_Ni1q,7^|DW|DNy1N{^a[o@Pf.Ba3Tn^Xt%KKdiW=P 0' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
