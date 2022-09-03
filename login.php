<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['username'])) {
    require_once 'config.php';
    // phpinfo();
    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string);
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {

        $hashpassword = md5($_POST['pwd']);
        $sql = "select * from products.users where username = '" . pg_escape_string($_POST['username']) . "' and password ='" . $hashpassword . "'";
        $data = pg_query($dbconn, $sql);
        $login_check = pg_num_rows($data);
        if ($login_check > 0) {
            session_start();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['role'] = pg_fetch_assoc($data)['role'];
            header('Location: ./index.php');
        } else {

            echo "Invalid Details";
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
        <div class="container">
            <div class="mt-3">
                <a href="./register.php" class="card-link">Don't have an account? Register here.</a>
            </div>
            <h2 class="my-3">Login Here </h2>
            <form method="post">


                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control mb-3" id="username" placeholder="Enter Username" name="username">
                </div>


                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control " id="pwd" placeholder="Enter password" name="pwd">
                </div>

                <input type="submit" name="submit" class="btn btn-primary mt-3" value="Submit">
            </form>
        </div>
    </body>
<?php
} else {
    header('Location: ./index.php');
}
?>

    </html>