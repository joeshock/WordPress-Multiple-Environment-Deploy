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

function defineEnvironment(){
///////////////////////////////////////////////////////////////////////////////////////////////
// ENVIRONMENT DETECTION AND CONFIGURATION
///////////////////////////////////////////////////////////////////////////////////////////////
// Replace your database name, user and password definitions with this script
///////////////////////////////////////////////////////////////////////////////////////////////

	///////////////////////////////////////////////////////////////////////////////////////////////
	// Edit this information below to your liking
	///////////////////////////////////////////////////////////////////////////////////////////////
	
	// Environment variables - use base domain name including subdomain if applicable
	$local   = "localhost";
	$dev     = "dev.example.com";
	$staging = "staging.example.com";
	$preprod = "preprod.example.com";
	$prod    = "example.com";
	
	// Database variables
	$local_db   	= "myDatabaseForLocal";
	$local_user 	= "myUsernameForLocal";
	$local_pass 	= "myPasswordForLocal";

	$dev_db   		= "myDatabaseForDev";
	$dev_user 		= "myUsernameForDev";
	$dev_pass 		= "myPasswordForDev";

	$staging_db   	= "myDatabaseForStaging";
	$staging_user 	= "myUsernameForStaging";
	$staging_pass 	= "myPasswordForStaging";

	$preprod_db   	= "myDatabaseForPreProd";
	$preprod_user 	= "myUsernameForPreProd";
	$preprod_pass 	= "myPasswordForPreProd";

	$prod_db   		= "myDatabaseForProd";
	$prod_user 		= "myUsernameForProd";
	$prod_pass 		= "myPasswordForProd";
	
	$current_db   	= $local_db;
	$current_user 	= $local_user;
	$current_pass 	= $local_pass;

///////////////////////////////////////////////////////////////////////////////////////////////
// Should not need to alter anything below this line
///////////////////////////////////////////////////////////////////////////////////////////////

// Detect environment
$currentEnvironment = $_SERVER['HTTP_HOST'];
$prefix = "http://";

// Project path detection for environments utilizing two subdirectories
// i.e. example.com/clientname/projectname/
$path = explode( "/", (string)dirname(__FILE__) );
$pathCount = count($path);
$projectPath = "/" . $path[$pathCount-2] . "/" . $path[$pathCount-1];

// Detect server and configure environment

switch( $currentEnvironment ){

	// LOCAL
	case $local:
	$currentEnvironment .= $projectPath;
	$current_db = $local_db;
	$current_user = $local_user;
	$current_pass = $local_pass;
	break;

	// DEV
	case $dev:
	$currentEnvironment .= $projectPath;
	$current_db = $dev_db;
	$current_user = $dev_user;
	$current_pass = $dev_pass;
	break;

	// STAGING
	case $staging:
	case "www." . $staging:
	$currentEnvironment .= $projectPath;
	$current_db = $staging_db;
	$current_user = $staging_user;
	$current_pass = $staging_pass;
	break;

	// PRE-PROD
	case $preprod:
	$current_db = $preprod_db;
	$current_user = $preprod_user;
	$current_pass = $preprod_pass;
	break;
	
	// PROD
	case $prod:
	case "www." . $prod:
	$current_db = $prod_db;
	$current_user = $prod_user;
	$current_pass = $prod_pass;
	break;

	// DEFAULT TO LOCAL
	default:
	$current_db = $local_db;
	$current_user = $local_user;
	$current_pass = $local_pass;
	break;	
			
}
	
// Set WordPress HOME and SITEURL variables for Settings > General
define('WP_HOME', $prefix . $currentEnvironment);
define('WP_SITEURL', $prefix . $currentEnvironment);

// MySQL database name
define('DB_NAME', $current_db);
// MySQL database username
define('DB_USER', $current_user);
// MySQL database password
define('DB_PASSWORD', $current_pass);

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
}// end defineEnvironment() function


// Call defineEnvironment() function
defineEnvironment();

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
define('AUTH_KEY',         '');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    '');
define('NONCE_KEY',        '');
define('AUTH_SALT',        '');
define('SECURE_AUTH_SALT', '');
define('LOGGED_IN_SALT',   '');
define('NONCE_SALT',       '');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.

 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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