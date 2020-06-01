<?php 
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
        <script type="text/javascript" src="js/products.js"></script>
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
        <article>
            <h2>Main Page</h2>

            <!-- Search Bar -->
            <div id="searchbar">
                <form>
                    <p>
                        <input type="text" placeholder="Search" name="search" id="searchVal"/>
                        <button type="submit" id="searchSub">Search</button>
                    </p>
                </form>
            </div>
            <!-- Products List -->
            <div id="main-view">
                <?php
                    include "products.php";
                ?>
            </div>
        </article>
        <footer>
            <p>By <a href="https://www.linkedin.com/in/gablugo/">Gabriela</p>
        </footer>
    </main>
</body>

</html>