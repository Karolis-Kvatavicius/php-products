<?php

session_start();
if (isset($_SESSION['username']) && $_SESSION['role'] == 1) {

    require_once 'config.php';

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string);
    if (isset($_GET['name']) && isset($_GET['delete'])) {

        $sql = 'DELETE FROM products.products WHERE "name"=\'' . $_GET['name'] . '\';';
        $ret = pg_query($dbconn, $sql);
        if ($ret) {

            header('Location: ./index.php');
        } else {

            echo "Something Went Wrong";
        }
    }
} else {
    header('Location: ./login.php');
}
