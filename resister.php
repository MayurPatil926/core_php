<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "core";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$address = mysqli_real_escape_string($conn, $_POST['address']);

// Check if email and phone are unique
$sql = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Email or phone number already exists!";
} else {
    
    $insert_sql = "INSERT INTO users (name, email, phone, password, address) VALUES ('$name', '$email', '$phone', '$password', '$address')";
    
    if ($conn->query($insert_sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
