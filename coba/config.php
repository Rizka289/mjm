<?php
 
$DSN = array(
    'phptype'  => 'mysqli',
    'username' => 'cvajm',
    'password' => 'qwe-123-123',
    'hostspec' => 'localhost',
    'database' => 'cvajm'
);

require_once "ez_sql_loader.php";
#include_once "kumkum.php";
 
$db = new ezSQL_mysqli($DSN['username'],$DSN['password'],$DSN['database'],$DSN['hostspec']);

#$conn=mysql_connect($DSN['hostspec'],$DSN['username'],$DSN['password']) or die ('Unable to connect to database.');
#mysql_select_db($DSN['database'])or die('Database cannot be found');

#$ddusa = new Kumkum($db);

date_default_timezone_set('Asia/Jakarta');



?>
