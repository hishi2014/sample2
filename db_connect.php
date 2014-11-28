<?php
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    $dbh = new PDO('mysql:host=localhost;dbname=test3;unix_socket=/tmp/mysql.sock', "root", "perorin5",$options);
?>