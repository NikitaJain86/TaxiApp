<?php
/**
 * Installs the PHP Login & User Management database
 *
 * LICENSE:
 *
 * This source file is subject to the licensing terms that
 * is available through the world-wide-web at the following URI:
 * http://codecanyon.net/wiki/support/legal-terms/licensing-terms/.
 *
 * @author       BLiveInHack <bliveinhack@gmail.com>
 * @copyright    Copyright © 2014 icanstudioz.com
 * @license      http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 * @link         http://codecanyon.net/item/8817787
 */
include_once("header.php");

$install = new Install();

class Install {

    private $error;
    private $link;
    private $options = array();
    public static $dbh;

    function __construct() {

        $this->checkInstall($hideError = true);

        if (!empty($_POST)) :

            foreach ($_POST as $key => $value)
                $this->options[$key] = $value;

            $this->validate();

        endif;

        if (!empty($this->error))
            echo $this->error;
    }

    // Run any ol' query passed into this function
    public function query($query, $params = array()) {

        $stmt = self::$dbh->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }

    // Check for all form fields to be filled out
    private function validate() {


        if (empty($this->options['dbHost']) || empty($this->options['dbUser']) || empty($this->options['dbName']) || empty($this->options['api_key']))
            $this->error = '<div class="alert alert-error">' . _('Fill out all the details please') . '</div>';


        // Check the database connection
        $this->dbLink();
        //$this->installCertificates();
    }

    // See if I can connect to the mysql server
    private function dbLink() {

        if (!empty($this->error))
            return false;

        try {
            self::$dbh = new PDO("mysql:host=" . $this->options['dbHost'] . ";dbname=" . $this->options['dbName'], $this->options['dbUser'], $this->options['dbPass']);
            self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->error = '<div class="alert alert-error">' . _('Database error: ') . $e->getMessage() . '</div>';
        }

        $this->existingTables();
    }

    // Check for an existing install
    private function existingTables() {

        if (empty($this->error)) :

            $this->insertSQL();
            $this->writeFile();
            $this->checkInstall();

        endif;
    }

    // Begin inserting our SQL goodies
    private function insertSQL() {

        if (empty($this->error)) {

            $this->query("SET NAMES utf8;");

            $this->query("CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `api_key` varchar(500) DEFAULT NULL,
  `google_api_key` varchar(250) DEFAULT NULL,
  `driver_rate` varchar(5) DEFAULT NULL,
  `paypal_id` varchar(250) DEFAULT NULL,
  `paypal_password` varchar(250) DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `paypal_account` enum('sandbox','live') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2");
	
	$this->query("INSERT INTO `admin` (`username`, `password`, `api_key`, `google_api_key`, `driver_rate`, `paypal_id`, `paypal_password`, `signature`,`paypal_account`)values('admin',md5('admin'),'" . $this->options['api_key'] . "','" . $this->options['google_api_key'] . "',10,'','','','sandbox')");

            $this->query("CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `user_type` varchar(10) DEFAULT NULL,
  `key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=latin1;");

$this->query("CREATE TABLE IF NOT EXISTS `payment_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) DEFAULT NULL,
  `amount` varchar(5) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");

            $this->query("CREATE TABLE IF NOT EXISTS `rides` (
  `ride_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `driver_id` int(10) DEFAULT NULL,
  `pickup_adress` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `drop_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `pikup_location` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `drop_locatoin` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `distance` varchar(50) DEFAULT NULL,
  `status` enum('PENDING','ACCEPTED','COMPLETED','CANCELLED') DEFAULT NULL,
  `payment_status` varchar(15) DEFAULT NULL,
  `pay_driver` tinyint(1) DEFAULT '0',
  `payment_mode` varchar(25) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ride_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;");

            $this->query("CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `value` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;");

 $this->query("INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'FARE', '5'),
(2, 'UNIT', '$'),
(3, 'SMTP_HOST', ''),
(4, 'SMTP_PORT', ''),
(5, 'SMTP_USER', ''),
(6, 'SMTP_PASS', ''),
(7, 'FROM', '')");

            
            $this->query("CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `mtype` varchar(2) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `gcm_token` varchar(250) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `utype` int(2) NOT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `vehicle_no` varchar(20) DEFAULT NULL,
  `license` varchar(50) DEFAULT NULL,
  `insurance` varchar(50) DEFAULT NULL,
  `permit` varchar(50) DEFAULT NULL,
  `registration` varchar(50) DEFAULT NULL,
  `vehicle_info` varchar(250) DEFAULT NULL,
  `random` varchar(150) DEFAULT NULL,
  `paypal_id` varchar(100) DEFAULT NULL,
  `is_online` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;");

           
        } else
            $this->error = 'Your tables already exist! I won\'t insert anything.';
    }

    private function writeFile() {

        if ($this->error == '') {

            /** Write config.php if it doesn't exist */
            //$fp = @fopen("../api/config.php", "w");

            $fp_c = @fopen("../application/config/config.php", "w");
            $fp_database = @fopen("../application/config/database.php", "w");
            $fp_access = @fopen("../.htaccess", "w");


            if (!$fp_access) :
                echo '<div class="alert alert-warning">' . _('Could not create <code>/classes/config.php</code>, please confirm you have permission to create the file.') . '</div>';
                return false;
            endif;
            
            if (!$fp_c) :
                echo '<div class="alert alert-warning">' . _('Could not create <code>/classes/config.php</code>, please confirm you have permission to create the file.') . '</div>';
                return false;
            endif;

            if (!$fp_database) :
                echo '<div class="alert alert-warning">' . _('Could not create <code>/classes/config.php</code>, please confirm you have permission to create the file.') . '</div>';
                return false;
            endif;


            fwrite($fp_access, 'RewriteEngine on
RewriteCond $1 !^(index\.php|public|\.txt) 
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?$1');


            fwrite($fp_database, '<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");
/*
  | -------------------------------------------------------------------
  | DATABASE CONNECTIVITY SETTINGS
  | -------------------------------------------------------------------
  | This file will contain the settings needed to access your database.
  |
  | For complete instructions please consult the "Database Connection"
  | page of the User Guide.
  |
  | -------------------------------------------------------------------
  | EXPLANATION OF VARIABLES
  | -------------------------------------------------------------------
  |
  |	["hostname"] The hostname of your database server.
  |	["username"] The username used to connect to the database
  |	["password"] The password used to connect to the database
  |	["database"] The name of the database you want to connect to
  |	["dbdriver"] The database type. ie: mysql.  Currently supported:
  mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
  |	["dbprefix"] You can add an optional prefix, which will be added
  |				 to the table name when using the  Active Record class
  |	["pconnect"] TRUE/FALSE - Whether to use a persistent connection
  |	["db_debug"] TRUE/FALSE - Whether database errors should be displayed.
  |	["cache_on"] TRUE/FALSE - Enables/disables query caching
  |	["cachedir"] The path to the folder where cache files should be stored
  |	["char_set"] The character set used in communicating with the database
  |	["dbcollat"] The character collation used in communicating with the database
  |				 NOTE: For MySQL and MySQLi databases, this setting is only used
  | 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
  |				 (and in table creation queries made with DB Forge).
  | 				 There is an incompatibility in PHP with mysql_real_escape_string() which
  | 				 can make your site vulnerable to SQL injection if you are using a
  | 				 multi-byte character set and are running versions lower than these.
  | 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
  |	["swap_pre"] A default table prefix that should be swapped with the dbprefix
  |	["autoinit"] Whether or not to automatically initialize the database.
  |	["stricton"] TRUE/FALSE - forces "Strict Mode" connections
  |							- good for ensuring strict SQL while developing
  |
  | The $active_group variable lets you choose which connection group to
  | make active.  By default there is only one group (the "default" group).
  |
  | The $active_record variables lets you determine whether or not to load
  | the active record class
 */

$active_group = "default";
$active_record = TRUE;

$db["default"]["hostname"] = "' . $this->options['dbHost'] . '";
$db["default"]["username"] = "' . $this->options['dbUser'] . '";
$db["default"]["password"] = "' . $this->options['dbPass'] . '";
$db["default"]["database"] = "' . $this->options['dbName'] . '";
$db["default"]["dbdriver"] = "mysql";
$db["default"]["dbprefix"] = "";
$db["default"]["pconnect"] = TRUE;
$db["default"]["db_debug"] = TRUE;
$db["default"]["cache_on"] = FALSE;
$db["default"]["cachedir"] = "";
$db["default"]["char_set"] = "utf8";
$db["default"]["dbcollat"] = "utf8_general_ci";
$db["default"]["swap_pre"] = "";
$db["default"]["autoinit"] = TRUE;
$db["default"]["stricton"] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */?>');



            fwrite($fp_c, '<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

$config["base_url"] = "' . $this->options['base_url'] . '";

$config["google_api_key"] = "' . $this->options['api_key'] . '";

$config["index_page"] = "index.php";

$config["uri_protocol"] = "AUTO";

$config["url_suffix"] = "";

$config["language"] = "english";

$config["charset"] = "UTF-8";

$config["enable_hooks"] = FALSE;

$config["subclass_prefix"] = "MY_";

$config["permitted_uri_chars"] = "a-z 0-9~%.:_\-";


$config["allow_get_array"] = TRUE;
$config["enable_query_strings"] = FALSE;
$config["controller_trigger"] = "c";
$config["function_trigger"] = "m";
$config["directory_trigger"] = "d"; // experimental not currently in use

$config["log_threshold"] = 0;

$config["log_path"] = "";

$config["log_date_format"] = "Y-m-d H:i:s";

$config["cache_path"] = "";

$config["encryption_key"] = "iosnews";

$config["sess_cookie_name"] = "ci_session";
$config["sess_expiration"] = 7200;
$config["sess_expire_on_close"] = FALSE;
$config["sess_encrypt_cookie"] = FALSE;
$config["sess_use_database"] = FALSE;
$config["sess_table_name"] = "ci_sessions";
$config["sess_match_ip"] = FALSE;
$config["sess_match_useragent"] = TRUE;
$config["sess_time_to_update"] = 300;

$config["cookie_prefix"] = "";
$config["cookie_domain"] = "";
$config["cookie_path"] = "/";
$config["cookie_secure"] = FALSE;

$config["global_xss_filtering"] = FALSE;

$config["csrf_protection"] = FALSE;
$config["csrf_token_name"] = "csrf_test_name";
$config["csrf_cookie_name"] = "csrf_cookie_name";
$config["csrf_expire"] = 7200;

$config["compress_output"] = FALSE;

$config["time_reference"] = "local";

$config["rewrite_short_tags"] = FALSE;

$config["proxy_ips"] = "";
 ?>');

           // fclose($fp);
        }
    }

    private function checkInstall($hideError = false) {

        if (file_exists('../application/config/config.php')) :
            ?>
            <div class="row">
                <div class="span6 offset5" style="margin-top: 20%">
                    <div class="alert alert-success"><?php echo ('Hooray ! Installation is all done :)'); ?></div>
                    <div style="clear: both"></div>
                    <p><span class='label label-important'><?php echo ('Important'); ?></span> <?php echo ('Please delete or rename the install folder to prevent intrustion'); ?></p>
                </div>
                <div class="span6 offset5">
                    <h5><?php echo ('What to do now?'); ?></h5>
                    <p><?php echo ('Check out your'); ?> <a href="../index.php"><?php echo ('Dashbord'); ?></a> <?php echo ('page.'); ?></p>
                    <p><?php echo ('Username :- admin <br/> password :- admin'); ?> </p>
                </div>
            </div> <?php
            exit();
        else :
            if (!$hideError)
                $this->error = '<div class="alert alert-error">' . _('Installation is not complete.') . '</div>';
        endif;
    }

}
?>
<div class="row-fluid">
    <div class="span6 offset4">
        <form class="form-horizontal" method="post" action="index.php" enctype='multipart/form-data'>

            <fieldset>
                <legend><?php echo ('Database Info'); ?></legend>
                <div class="control-group">
                    <label class="control-label" for="dbHost"><?php echo ('Host'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="dbHost" name="dbHost" value="<?php if (isset($_POST['dbHost'])) echo $_POST['dbHost']; ?>" placeholder="localhost">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dbName"><?php echo ('Database name'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="dbName" name="dbName" value="<?php if (isset($_POST['dbName'])) echo $_POST['dbName']; ?>" placeholder="<?php echo ('database_name'); ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dbUser"><?php echo ('Username'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="dbUser" name="dbUser" value="<?php if (isset($_POST['dbUser'])) echo $_POST['dbUser']; ?>" placeholder="<?php echo ('db username'); ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dbPass"><?php echo ('Password'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="dbPass" name="dbPass" value="<?php if (isset($_POST['dbPass'])) echo $_POST['dbPass']; ?>" placeholder="<?php echo ('db password'); ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dbPass"><?php echo ('Base Url'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="base_url" name="base_url" value="<?php if (isset($_POST['base_url'])) echo $_POST['base_url']; ?>" placeholder="<?php echo ('Base Url(http://www.icanstudioz.com/taxiapp/)'); ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="dbPass"><?php echo ('Firebase(FCM) Api Key'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="base_url" name="api_key" value="<?php if (isset($_POST['api_key'])) echo $_POST['api_key']; ?>" placeholder="Firebase Api Key">
                    </div>
                </div>
				
				<div class="control-group">
                    <label class="control-label" for="dbPass"><?php echo ('Google Map Api Key'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="base_url" name="google_api_key" value="<?php if (isset($_POST['google_api_key'])) echo $_POST['google_api_key']; ?>" placeholder="Google Map Api Key">
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="dbPass"><?php echo ('How to get FCM Api Key'); ?></label>
                    <div class="controls row-fluid">
                    	refer this link <a href="http://www.icanstudioz.com/envantoassests/taxi/doc/index.html#!/firebase" >http://www.icanstudioz.com/envantoassests/taxi/doc/index.html#!/firebase</a>
                    </div>
                </div>
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo ('Install'); ?></button>
            </div>

        </form>

    </div>
</div>

<?php include_once("footer.php"); ?>