<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          ' g8;@s2 `B!:1EnzA=,@2*JfQ`i1/Y|jRG_0YSai,93#f_#EH6q/E:3;}H-Fg^T<' );
define( 'SECURE_AUTH_KEY',   'NtvHJ[UtSIBkQiIr(f=e72VYauxBSpjb1]vm>__?,4)^E@Ab(V7uxl$icwB9$`*[' );
define( 'LOGGED_IN_KEY',     '|UOE*Sdku,QfS%%J5uTjLyq-JJ$sgacZ|WVVi9ML.[THI/s@daQOiw,NnQM9<NY=' );
define( 'NONCE_KEY',         '`.6!duTavz3yDt-oB}&bGb[$O@3e^3w#xNT~EDJkbJAi.u~ qP6PtnM-FE/#j?Ig' );
define( 'AUTH_SALT',         'Go;4i*OiFI%+;IPJV[VMghOBH7[`W]x;f@C~aX3I9w^:Q@ zfTl:vYD[cF|>}msL' );
define( 'SECURE_AUTH_SALT',  'cBS^{/d32P^A[j:_s>^g!3$~wP?^-_z&(~E8mIA%p5z9<li=GHN9I/;;$OQEVnc$' );
define( 'LOGGED_IN_SALT',    'X9!B21)7~^Bi5}_)lQ_WJ;@zRXzMI }z vRm~Y*)=lMTRVGBp%6M2+namPl7yYj%' );
define( 'NONCE_SALT',        '+.!/@V1}!|Ht!cv1W%=BYEqPy*t{-}m:``PeEk0^H1%%Wq8,31RXOR5A`2Yf%ipe' );
define( 'WP_CACHE_KEY_SALT', 'Azk+8LRzmPva6AUb@H;bK;(o/o*d30M<;Sb6S_n;yAqVb%P=/]R6Rte` m]%HL}4' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
