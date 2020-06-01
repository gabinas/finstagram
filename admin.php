<?php
include 'include/db_credentials.php';

// Connect to db
$mysqli = new mysqli('127.0.0.1', $username, $password, $database, $port);
if ($mysqli->connect_error) {   // Error on connection mishap
    die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Finstagram</title>

        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800,600" rel="stylesheet"
            type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,300" rel="stylesheet" type="text/css" />
        <script src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
    </head>
<body>
    <aside>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="/">Main</a></li>
                    <li><a href="admin.php">Admin</a></li>
                </ul>
                </li>
                </ul>
            </nav>
        </div>
    </aside>

    <header>
        <h1><a href="/">Finstagram</a></h1>
    </header>
    <main>
        <h2>Admin Page</h2>
        <!-- Add New Products -->
        <h3>Add a new Product</h3>
        <div class="form">
            <form enctype="multipart/form-data" id="addForm" method="POST" action="">
                <div>
                    <label>Name:</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label>Description:</label>
                    <textarea name="description" cols="25" rows="5" placeholder="Write a description..."></textarea>
                </div>
                <div>
                    <label>Price:</label>
                    <input type="text" name="price" placeholder="$">
                </div>
                <div>
                    <label>Discount:</label>
                    <input type="text" name="discount" placeholder="%">
                </div>
                <div>
                    <label>Tags (separatted by comma):</label> 
                    <br>
                    <input type="text" name="tags">
                </div>
                <div>
                    <label>Inventory:</label>
                    <input type="text" name="inventory">
                </div>
                <div>
                    <label>Images (Up to 5):</label><br>
                    <input type="file" name="image1"><br>
                    <input type="file" name="image2"><br>
                    <input type="file" name="image3"><br>
                    <input type="file" name="image4"><br>
                    <input type="file" name="image5"><br>
                </div>
                <input type="submit" class="btnAdd" value="Add Item" name="addItem">
            </form>
        </div>
    </main>
    <footer>
        <p>By <a href="https://www.linkedin.com/in/gablugo/">Gabriela</a></p>
    </footer>
</body>
</html>

<?php
if (!isset($_POST['addItem'])) {
    return;
}

/** Get images paths */
$image1 = null;
$image2 = null;
$image3 = null;
$image4 = null;
$image5 = null;
if (isset($_POST['image1'])) {
    $image1 = $_POST['image1'];
}
if(isset($_FILES['image1'])){
    // Check if image file is a actual image or fake image
    $check1 = getimagesize($_FILES['image1']['tmp_name']);
}

if (isset($_POST['image2'])) {
    $image2 = $_POST['image2'];
}

if (isset($_POST['image3'])) {
    $image3 = $_POST['image3'];
}

if (isset($_POST['image4'])) {
    $image4 = $_POST['image4'];
}

if (isset($_POST['image5'])) {
    $image5 = $_POST['image5'];
}

/** Get name */
$name = null;
if(isset($_POST['name'])) {
	$name = $_POST['name'];
}

/** Get description **/
$description = null;
if(isset($_POST['description'])) {
	$description = $_POST['description'];
}

/** Get price **/
$price = null;
if(isset($_POST['price'])) {
	$price = $_POST['price'];
}

/** Get discount */
$discount = null;
if(isset($_POST['discount'])) {
    $discount = $_POST['discount'];
}

/** Get inventory **/
$inventory = null;
if(isset($_POST['inventory'])) {
	$inventory = $_POST['inventory'];
}

/** Get tags and validate them **/
$tags_str = null;
if(isset($_POST['tags'])) {
    $tags_str = $_POST['tags'];
    $tags = explode(", ", $tags_str);
}

// Validate input for database.bp
if (is_numeric($price) && !is_null($name) && is_numeric($inventory) && $inventory > 0 && $check1) {
    
    // Insert product into database. 
    $sql = $mysqli->prepare("INSERT INTO Product (name, price, description, discount, inventory) VALUES (?, ?, ?, ?, ?);");
    $sql->bind_param("sdsii",$name,$price,$description,$discount,$inventory);
    $sql->execute();
    $pid = $sql->insert_id;
    $sql->close();

    //Upload file into directory
    $info1 = pathinfo($_FILES['image1']['name']);
    $ext = $info1['extension'];
    $target_dir = "products/";
    $target_file = $target_dir.$pid."_01.".$ext;

    move_uploaded_file($_FILES['image1']['tmp_name'], $target_file);

    // Insert image into database.
    $sql = $mysqli->prepare("INSERT INTO Image (pid, url) VALUES (?, ?);");
    $sql->bind_param("is",$pid,$target_file);
    $sql->execute();
    $sql->close();

    // Insert tags into database.
    foreach ($tags as $val) {
        $sql = $mysqli->prepare("INSERT INTO Tag VALUES (?, ?);");
        $sql->bind_param("is",$pid,$val);
        $sql->execute();
        $sql->close();
    }

    echo("<script>alert(\"Product has been added!\")</script>");
} else {
    echo("<script>alert(\"Invalid values!\")</script>");
}

// Close db connection
$mysqli->close();
?>