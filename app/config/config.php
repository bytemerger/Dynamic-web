<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 7/20/18
 * Time: 10:42 PM
 */

class config
    {
    /*ini_set( "display_errors", true );*/
        public function __construct()
        {
            //set default date and time
            date_default_timezone_set( "Africa/Lagos" );  // http://www.php.net/manual/en/timezones.php
            //define database connection variables
            define( "DB_DSN", "mysql:host=localhost;dbname=blog" );
            define( "DB_USERNAME", "franc" );
            define( "DB_PASSWORD", "come1234" );
            //set a default language
            define('LANGUAGE_CODE', 'en');
            define('IMAGE_PATH', '/app/helpers/img');
            define('MODEL', 'app'.DIRECTORY_SEPARATOR .'models'.DIRECTORY_SEPARATOR);
        }


    }
    ?>