<?php
session_start();
if (isset($_SESSION['username'])) {
    print_r($_SESSION);
    require_once 'config.php';

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string);

    $sql = "select * from products.products";
    $ret = pg_query($dbconn, $sql);
    if ($ret) {
        // echo "Data Retrieved Successfully";
    } else {

        echo "Something Went Wrong";
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
            <div class="row">
                <h2 class="col text-center my-3">Our Products
                    <span>
                        <?php
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                        ?>
                            <a type="button" href="./create_product.php" class="btn btn-success">Create New Product</a>
                        <?php
                        }
                        ?>
                    </span>
                </h2>
            </div>
            <div class="row row-cols-4">
                <?php
                while ($row = pg_fetch_assoc($ret)) {
                    
                    include 'product.php';
                
                }
                ?>
            </div>
            <a type="button" href="./logout.php" class="btn btn-danger">Logout</a>
        </div>
    </body>
<?php
} else {
    header('Location: ./login.php');
}
?>

    </html>