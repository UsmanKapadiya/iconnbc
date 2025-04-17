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
 * 
 * 
 */
define( 'WP_HOME', 'http://localhost/iconnbc/' );
define( 'WP_SITEURL', 'http://localhost/iconnbc/' );


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'iconnbc_database_new');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define( 'FS_METHOD', 'direct' );


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'N[@l@r[M9TB`&LuiTDG;6AsDY>M}&`Ijf/<hha!v&XP&a_`8206JkWaC&o:K1.Q1');
define('SECURE_AUTH_KEY',  'niSbJIN^=!.IEca4 npk|p.x+>cP~&15!g?J&u~-2M?(n8X:OM$.ley*1:$;6e5|');
define('LOGGED_IN_KEY',    '4*aLDthMD5xj~1Y&EN<#VPCJ,].c2aZI23w[hsI6rIj J/lo,7IZ{?H4o~N08%|b');
define('NONCE_KEY',        ']s<hn1r|.Y)+p?>_,!zqsQqJ_jlqA5!]gD:&);B*M.%+gMRC1W^_d_z9`C7L#!sw');
define('AUTH_SALT',        '~.|6<a8cPlI}Lcc|X~oYaJYhkL@L+93kJ+=aZ;+47 Lttj#&ee?/,::FAw43Q!WG');
define('SECURE_AUTH_SALT', ')b>;d*q8p9QW[6?z2@>u{&X<S;;XdKiJR8?F}5u@bZf#}p}AQ/8n!).(C46<}3hu');
define('LOGGED_IN_SALT',   'Js,+(ElRz:DBVXZ~D #H{/6huw&ul>+3v*<tkX0eNUIZ>Q][WR2#[uPY%H*h}fJn');
define('NONCE_SALT',       'qaFhLq5sQRp=*/ow!e e4=V~AohtqPHk=tsQD7hw!uD|=j,d>mW/y=jPK|T1#2sF');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'iconnbc_';

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
