<?php
define( 'WP_CACHE', true );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'amrit' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         ')suA+8GF%K|K<Ws%+$Kn^t##df2$PMM_T<VFNq+#JX%bQl0&6#9O7or=0mV+7a@H' );
define( 'SECURE_AUTH_KEY',  '-K1R[L?rVHZ4AMT`;N3TtO#m}en[jr_gK %Lu!X3evM^f/0^`bW#h*UeDqicjbiH' );
define( 'LOGGED_IN_KEY',    'Ld3AC~.V+nm/v[+X2.IK*UM0lfe]TE7J{7!QCl}`~k eaS&(?xd; fnmGs:VUGsP' );
define( 'NONCE_KEY',        'ND&9#2^/]C=kUx WI)A)g1l:hrPyn|(F,GLHV#lr?g-vVRpJ2knAg83:!6DLIXV8' );
define( 'AUTH_SALT',        '@CL<^MS&3.jDP=-F+Cu8rviAFc.%9@HI3W2@QXRQDjPeq)Om=?G?1voa4+Fe_HPP' );
define( 'SECURE_AUTH_SALT', 'G;Q=CUv5rB71*Z%[ma&1;aFck:RxB$7J)w,8P]|F?[>rY}UenUixyXM/V2K>o^a{' );
define( 'LOGGED_IN_SALT',   '3Tfk&e `68V4#5B6{v I#b-2oIx,P`|P2%xBDwI:bTaBW~fS4cj^`rIt]9!H+Z])' );
define( 'NONCE_SALT',       '?8N!O8Htnp7pSA<1k:6 i/F>KPfOMXmIb,;lXyc|v~9F2,3;`HQ)uE!ZCZ7k+nK5' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
