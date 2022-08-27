<?php

session_start();
if (isset($_SESSION['username'])) {

    require_once 'config.php';

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string);

    $sql = "select * from products.products";
    $ret = pg_query($dbconn, $sql);
    if ($ret) {
        echo "Data Retrieved Successfully";
    } else {

        echo "Something Went Wrong";
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

        <!-- CREATE NEW PRODUCT -->
        <div class="container">
            <?php
            if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
            ?>
                <a href="./create_product.php" class="card-link">Create New Product</a>
            <?php
            }
            ?>
            <h2>Our Products</h2>

            <?php
            while ($row = pg_fetch_assoc($ret)) {
            ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['name'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $row['price'] . " $" ?></h6>
                        <p class="card-text"><?= $row['description'] ?></p>
                        <?php
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                        ?>
                            <a href="./edit_product.php?name=<?= $row['name'] ?>&price=<?= $row['price'] ?>&description=<?= $row['description'] ?>" class="card-link">Edit</a>
                            <a href="./delete_product.php?name=<?= $row['name'] ?>&delete=1" class="card-link">Delete</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
            <a href="./logout.php">Logout</a>
        </div>
    </body>
<?php
} else {
    header('Location: ./login.php');
}
?>

    </html>