<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
    include 'include/db_credentials.php';

    $mysqli = new mysqli('127.0.0.1', $username, $password, $database, $port);
    echo("<h1>Connecting to database.</h1><p>");

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    echo '<p>Server '.$mysqli->server_info.'</p>';

    $fileName = "./data/data_sql.ddl";
    $file = file_get_contents($fileName, true);
    $file = mb_convert_encoding($file, 'UTF-8', mb_detect_encoding($file, 'UTF-8, ISO-8859-1', true));
    $lines = explode(";", $file);
    echo '<ol>';
    foreach ($lines as $line){
        $line = trim($line);
        if ($line != ""){
            echo("<li>".$line . ";</li><br/>");
            $mysqli->query($line);
        }
    }
    echo '</ol>';
    $mysqli->close();

    echo("</p><h2>Database loading complete!</h2>");
?>
</body>
</html>
