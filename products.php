<?php
include 'include/db_credentials.php';

// Connect to db
$mysqli = new mysqli('127.0.0.1', $username, $password, $database, $port);
if ($mysqli->connect_error) {   // Error on connection mishap
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

// Display all products
$sql = "SELECT * FROM Product;";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pid = $row["pid"];
        $name = $row["name"];
        $desc = $row["description"];
        $price = $row["price"];

        // Just getting one picture because of front end
        $sql = "SELECT * FROM Image WHERE pid=".$pid." LIMIT 1;";
        $images = $mysqli->query($sql);
        while ($img = $images->fetch_assoc()) {
            $path = $img["url"];
        }

        item_specs($pid, $name, $path, $desc, $price);
    }
} else {
    echo "Oops, this is empty";
}

function item_specs($pid, $pname, $image, $description, $price){
    echo '
    <div>
        <div class="image"><img src="/'.$image.'" /></div>
        <div>
            <p>Name: '.$pname.'</p>
            <p>Description: '.$description.'</p>
            <p>Price: '.$price.'</p>
        </div>
    </div>
    ';
}

// Close db connection
$mysqli->close();
?>