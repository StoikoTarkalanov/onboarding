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
define( 'AUTH_KEY',         'Ipx,[g3(ZM1:+)b_)#KniIcus*7*aHL~ PV!&_k|Z_;i,1)jETqy+MT(Fc%U2q,=' );
define( 'SECURE_AUTH_KEY',  'P1KCOAJ{3BC:/F+`#(=NH,o4qg4xwHn..uvsifx3`vW]JAdGbx/c>.hJ)E@6To<&' );
define( 'LOGGED_IN_KEY',    ',s^.fosW}E]r}ow2Gj||=/9OHp/7>#}N12BXNBl.;As~IA`(n[PHhfrA++<9)3:X' );
define( 'NONCE_KEY',        '~9I|RO:a/_2R#g;|Q8-+OyDfW(.&!,@_GOi02kSZCGm@w>yVnu_t-Zh16OEV$#Fq' );
define( 'AUTH_SALT',        'pkd[7 _X8D:d:B4HDxmYwEy]I$S|/rZT0bTd!k^=>2y7=r!#d.]WBnMfFh_I8;?)' );
define( 'SECURE_AUTH_SALT', 'p.bTkGOLo8>l!.s^$8Sh4*M[uiy]O8dByG<voK/Xm2?oX}v3~u1vAWz-B22ZL.|h' );
define( 'LOGGED_IN_SALT',   '3C(K#9)&5j: f~b@&OvR$-^iXQT)3czGmW^y|PM JEK4u@[*Ufb:0SWe8:o]PY>M' );
define( 'NONCE_SALT',       ')^#wcFo:A6I6.0cI1gWj][f.z3[p7i8PjX$:M|4tC/3u`(R.bYY>FF!cFtmc/~@[' );

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

