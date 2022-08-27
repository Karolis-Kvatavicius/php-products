<?php

session_start();
if (isset($_SESSION['username']) && $_SESSION['role'] == 1) {

    require_once 'config.php';

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string);
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {

        $sql = "insert into products.products(name,description,price)values('" . $_POST['name'] . "','" . $_POST['description'] . "','" . $_POST['price'] . "')";
        $ret = pg_query($dbconn, $sql);
        if ($ret) {

            echo "Data saved Successfully";
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    </head>

    <body>

        <!-- CREATE NEW PRODUCT -->
        <div class="container">
            <a href="./index.php" class="card-link">To Products</a>
            <h2>Create product </h2>
            <form method="post">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter price" name="price" required>
                </div>

                <input type="submit" name="submit" class="btn btn-primary mt-3" value="Submit">
            </form>
        </div>
    </body>
<?php
} else {
    header('Location: ./login.php');
}
?>

    </html>