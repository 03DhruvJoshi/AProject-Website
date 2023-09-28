<?php
/*$db_host = 'localhost';
$db_name = 'portfolio_3';
$username = 'root';
$password = '';*/

$db_host = 'localhost';
$db_name = 'u_220212269_db';
$username = 'u-220212269';
$password = '1UkQmKQjiQlrVVY';

try {
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);

} catch (PDOException $ex) {
    echo ("<p class='errorbox'>Failed to connect to the database.</p><br>");
    echo ($ex->getMessage());
    exit;
}
?>