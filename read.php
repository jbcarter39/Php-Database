<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PhpDb</title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Montserrat');

            h1{
                text-align: right;
                font-family: 'Montserrat', sans-serif;
                font-size: 1em;
                padding-right: 25px;
            }
            h2{
                text-align: center;
                font-family: 'Montserrat', sans-serif;
                font-size: 2em;
               
                padding-bottom: 75px;
                margin-bottom: -200px;
            }
            body{
                text-align: center;
                font-family: 'Montserrat', sans-serif;
                font-size: 1em;
            }
            .container{
                text-align: center;
                margin-left: 150px;
            }
            table {
                font-family: 'Montserrat', sans-serif;
                border-collapse: collapse;
                width: 90%;   
            }
            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 4px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
            .wrapper {
                margin-top: 10px;
                text-align: right;
                padding-right: 25px;
            }
            .log-out{
                padding: 5px 25px;
                text-decoration: none;
                background-color: #43b4ec;
                border-width: 0;
                color: #fff;
                cursor: pointer;
                transition: background-color 200ms;
            }
            .log-out:hover {
                background-color: #63c7ef;
            }
            .insert{
                padding: 10px 20px;
                background-color: #43b4ec;
                border-width: 0;
                text-decoration: none;
                color: #fff;
                cursor: pointer;
                transition: background-color 200ms;
            }
            .insert:hover {
                background-color: #63c7ef;
            }
            .delete{
                color: red;
            }
        </style>
    </head>
    <body>

        <?php
        //make sure the user is in the session
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user'];
        } else {
            header("location:login.php");
        }

        echo '<h1><i class="fa fa-user-circle"></i>User: ' . $_SESSION['user'] . '</h1><br>';
        echo '<div class="wrapper">'; ?>
        
        <a class="log-out" href="logout.php" onclick="return confirm('Are you sure you want to log out?')">Logout</a>
        
            <?php echo '</div>';
        echo '<h2>Product Database</h2>';
        
  
        
        

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

        $sql = "SELECT id, title, price FROM products";
        $result = $conn->query($sql);
        
        echo '<div class="container">';
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Product</th>';
        echo '<th>Price</th>';
        echo '<th></th>';
        echo '</tr>';
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $del_id = $row["id"];
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["title"] . '</td>';
                echo '<td> $' . $row["price"] . '</td>';
                echo "<td> <a class='delete' href='delete.php?id=" . $del_id . "'>Delete</a></td><br>";
                echo '</tr>';
                
            }
        } else {
            echo "0 results";
        }
        echo '</table>';
        echo '</div><br>';
        echo "<a class='insert' href='insert.php'>Insert</a><br>";
        
        $conn->close();
        ?>
    </body>
</html>
