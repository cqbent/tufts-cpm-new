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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tufts_cpm' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'syproot' );

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
define( 'AUTH_KEY',         'uv|]<%Ur95;lvXBaZMfeF17a;-9GIs&OcO&FeLq(.fwFo(tqg jXT0A 7nl#Z0k;' );
define( 'SECURE_AUTH_KEY',  '`keYk=|_rt*yqEv?qWu8d.((F$S@UQ#<-=5cO9l*h:+9w=u*<=HFPU}VI$?N(d`b' );
define( 'LOGGED_IN_KEY',    '1|a3DBO#{LXEF1L:+^vb5z#]H ;nEoqN57@Ctj;:[hd%(KVRt/]<B$u*|K+Ss$xj' );
define( 'NONCE_KEY',        '?:JSi~1E{FOL>0|nb0-F$N?n#Z4#wW@4:6G[U8Yk3flto|OZP)V1zPaSinDRcRn ' );
define( 'AUTH_SALT',        ' xQTb+.DRv2L1$y,)reR5C+BGMU[,l x`Xd 2:zs8XPF.MeCJx8R OFfxW&=qYP~' );
define( 'SECURE_AUTH_SALT', 'H3kaQt%^p|B+nwWE/hobzvfk L}:j!jczfg`H,?3z?z]~,DPLsIfUUyj?|NOvt6%' );
define( 'LOGGED_IN_SALT',   '%RVobjjx/%|lw<_VjV|1W|BzF~*$3Lx:48l]dNawq&ycw;5p}c%{U8n/TnBvBW)9' );
define( 'NONCE_SALT',       'Abc@$jK#Z:]TnUb~vWcd-{&N?@mc_.#HZ<J}lmtj]HT<nkn5W*J}OLfRg5QQNFn5' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
