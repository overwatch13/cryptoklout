<?php

//hybrid OAuth Tutorial, //http://hayageek.com/login-with-facebook-twitter-google-php/
$config = array("base_url" => ROOT . "/hybridauth-master/examples/example_06/index.php",  
        "providers" => array ( 
            "Google" => array ( 
                "enabled" => true,
                "keys"    => array ( "id" => "242654526823-p8s85j7pippbnoh2sir7lcfop5n47e3m.apps.googleusercontent.com", "secret" => "x7E75fSwffnGSMeK1YtUmmp6" ), 
 
            ),
            /*"Facebook" => array ( 
                "enabled" => true,
                "keys"    => array ( "id" => "367992747007959", "secret" => "8c6c0d727ac0755f12dd323074fe4318" ), // "id" => "FACEBOOK_DEVELOER_KEY", "secret" => "FACEBOOK_SECRET"
                "scope" => "email, user_about_me, user_birthday, user_hometown"  //optional.              
            ),
 
            "Twitter" => array ( 
                "enabled" => true,
                "keys"    => array ( "key" => "TWITTER_DEVELOPER_KEY", "secret" => "TWITTER_SECRET" ) 
            ),*/
        ),
        // if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
        "debug_mode" => true,
        "debug_file" => "debug.log",
    );