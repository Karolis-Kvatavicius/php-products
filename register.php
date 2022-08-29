<?php
session_start();
if (!isset($_SESSION['username'])) {

    require_once 'config.php';

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string);
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {

        $sql = "insert into products.users(username,password)values('" . $_POST['username'] . "','" . md5($_POST['pwd']) . "')";
        $ret = pg_query($dbconn, $sql);
        if ($ret) {
            header('Location: ./login.php');
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
        <div class="container">
            <a href="./login.php" class="card-link">Have an account? Login here.</a>
            <h2 class="my-3">Register Here </h2>
            <form method="post">

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control mb-3" id="username" placeholder="Enter Username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
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