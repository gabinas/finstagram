<?php
include 'include/db_credentials.php';

// Connect to db
$mysqli = new mysqli('127.0.0.1', $username, $password, $database, $port);
if ($mysqli->connect_error) {   // Error on connection mishap
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = 'SElECT DISTINCT * FROM Product
        WHERE Product.pid IN
        (SELECT Product.pid 
            FROM Product JOIN Tag ON Product.pid=Tag.pid
            WHERE
                Product.name LIKE "%'.$search.'%" OR
                Product.description LIKE "%'.$search.'%" OR
                Tag.tag LIKE "%'.$search.'%");';
    $res = $mysqli->query($sql);

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
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
        echo ("<h3>Ooops, there is nothing here.</h3>");
    }
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