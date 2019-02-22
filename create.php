<?php session_start();

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
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$title = $_POST['title'];
$price = $_POST['price'];

$sql = "INSERT INTO products (title, price)
VALUES ('$title', '$price')";

$_SESSION['title'] = $title;
$_SESSION['price'] = $price;

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header('location:read.php');

?>
