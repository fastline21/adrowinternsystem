<?php
    $_ENV = parse_ini_file('.env');
    define("DB_SERVER", $_ENV['DB_SERVER']);
    define("DB_USERNAME", $_ENV['DB_USERNAME']);
    define("DB_PASSWORD", $_ENV['DB_PASSWORD']);
    define("DB_DATABASE", $_ENV['DB_DATABASE']);
?>