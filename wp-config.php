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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_testgit_db' );

/** Database username */
define( 'DB_USER', 'wp_testgit_user' );

/** Database password */
define( 'DB_PASSWORD', 'wp_testgit_pw' );

/** Database hostname */
define( 'DB_HOST', 'localhost:8889' );

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
define('AUTH_KEY',		 'oZQ/iZ!f(HluyC=^%-]§f>DRWLr5jl/n@0]-0x}&XpORe!u4lM.{}IeicU@Q?it§');
define('SECURE_AUTH_KEY',  ',8p1~>T@J:h^du(DG$?mYc?DJwg,_EqTc~l<SL1W)U§VW8,@GF)|Fp§X6zucM0gW');
define('LOGGED_IN_KEY',	'IlkTdo-{!W+2e!0OOh-(.anP^AcFiF,cWx/TClgv08uv=FM}-~F&=3T f6bm|p?Y');
define('NONCE_KEY',		'f)0=iDxb=§oA/O<%nfm6byhnqSZG,ZjPI66<<r.:O06>@)rKoXe1CKU0Q{0eSOMr');
define('AUTH_SALT',		'E+_+`:{fI=T!O~E)sxPEYpW;;l0@}~§rNgMh),|cBwNW0@b|Li3 QwS8mSqB@wEK');
define('SECURE_AUTH_SALT', 'gSH7AT e^KLAIKPk4R8{{FG!9rAOi D2uu;§p=Df=|q%`[YDT)%2;9WX~GY73m![');
define('LOGGED_IN_SALT',   '%Bp}^@iJly TbfVoebiv%$7W§f7:g,?28I=N26:Aq~jjV|UuSp_Xl+B:j+?>`K/+');
define('NONCE_SALT',	   'TZP}%{h}=zo @Wf5i}vN?Webtfz/|IV:@[Bd5Tl0_AQ.5v+W{Dqm&%B63/B`2?VR');

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
