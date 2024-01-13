
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "core"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $delete_sql = "DELETE FROM users WHERE id = $user_id";

    if ($conn->query($delete_sql) === TRUE) {
        session_unset();
        session_destroy();
        header("Location: register.html");
        exit();
    } else {
        echo "Error deleting account: " . $conn->error;
    }

    $conn->close();
}
?>
