<?php session_start(); ?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        //make sure the user is in the session
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user'];
        } else {
            header("location:login.php");
        }
        
       
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "stock";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // var_dump($_GET);
        $row_id = $_GET['id'];
        $sql = "DELETE FROM products WHERE id =$row_id";


        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $conn->close();

        header('location:read.php');
        ?>
    </body>
</html>
