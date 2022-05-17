
<?php

define('DBHOST', 'localhost');
define('DBNAME', 'misfar');
define('DBUSER', 'root');
define('DBPASS', 'root');

//Create connection
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

// Check for error connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>


