<?php

// site parameters
define("SITE_NAME", "ZAEB URL");
define("SITE_URL", "http://".$_SERVER['HTTP_HOST']."/cut-your-url-GLO-PHP");

// databse parameters
define("DB_HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASS", '');
define("DB_NAME", 'home_cut_url_glo');

// parameters generator
define("URL_CHARS","qwertyuiopasdfghjklzxcvbnm0123456789-");

session_start();