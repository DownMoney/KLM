<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'klm');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Wwea@hiadm3476!');

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
define('AUTH_KEY',         ':~u7VJ6ibynmab>:x5x&-J86#>w A}1RgAoO}w:8-)U;UdWntm9*xu^J#vsD(]0S');
define('SECURE_AUTH_KEY',  'y~0f:cEAsu1^y,s_0IAML7lS%_ofHM$fw77^A78p+-u{Pt[]I0S`4:1E#ADF:1UE');
define('LOGGED_IN_KEY',    'pt7:Xf6{L!- ,=LNqdD3UpSz+@vrn!ShW%>1>@|Ct/N+Grg9::%P@;o1FmM#-5s8');
define('NONCE_KEY',        '4Q-HJFk3zJVhcXX97W$WJ{G+KT,!93b<}+)-Rbd9xx;<V9*mJEHF7;aCfvk?:)Pv');
define('AUTH_SALT',        'BO><TonP<=?n~J?6+49ruZ[R<2+(-~eTpT&piL_3XDg@K]pX<x87NY(O^@b;rP`X');
define('SECURE_AUTH_SALT', '+]XjR-?2$Tq:XN`,RoIr$U5Pu6?1n-F#]+XEd`7<W:mh|QS>CqN4gps_0@.[Ic D');
define('LOGGED_IN_SALT',   'HUxjb7:-DsG)oWM<iq|R%Tm|JTk+T@1$fTt$ggf)toE`4#A2+`-G+%RJWMrK|r9+');
define('NONCE_SALT',       '{4EXKIJSpm%%qtT7sW`gTgDxjp8++Qv;q2|nQ1}:(!ix~WK~ln;21NQjDYDL3>bJ');

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
