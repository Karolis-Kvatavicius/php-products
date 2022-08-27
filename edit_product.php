<?php

session_start();
if (isset($_SESSION['username']) && $_SESSION['role'] == 1 && isset($_GET['name']) && isset($_GET['price']) && isset($_GET['description'])) {

    require_once 'config.php';

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string);
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {

        $sql = 'UPDATE products.products
                SET "name" = \'' . $_POST['name'] . '\',' .
            'description = \'' . $_POST['description'] . '\',' .
            'price = \'' . $_POST['price'] .
            '\' WHERE name=\'' . $_GET['name'] . '\';';
        $ret = pg_query($dbconn, $sql);
        if ($ret) {

            header('Location: ./index.php');
        } else {

            echo "Something Went Wrong";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>PHP PostgreSQL Registration & Login Example </title>
        <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>

        <!-- EDIT PRODUCT -->
        <div class="container">
            <a href="./index.php" class="card-link">To Products</a>
            <h2>Edit product </h2>
            <form method="post">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?= $_GET['name'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" value="<?= $_GET['description'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter price" name="price" value="<?= $_GET['price'] ?>" required>
                </div>

                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </body>
<?php
} else {
    header('Location: ./login.php');
}
?>

    </html>