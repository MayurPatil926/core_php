<!-- dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <style>
            .new{
                display:flex;
            }
        </style>
</head>
<body>
    <h1 class="mx-3">Welcome to Your Dashboard</h1>
    
<div class="container">
    <?php
    
    session_start();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];

        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "core"; 

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Display user details
            echo "<p>User ID: " . $row['id'] . "</p>";
            echo "<p>User Name: $user_name</p>";
            echo "<p>Email: " . $row['email'] . "</p>";
            echo "<p>Phone: " . $row['phone'] . "</p>";
            echo "<p>Address: " . $row['address'] . "</p>";

            echo "<p><a href='logout.php' >Logout</a></p>";
        } else {
            echo "User not found!";
        }

        $conn->close();
    } else {
        header("Location: login.html"); 
        exit();
    }
    ?>
    </div>
<div class="container new my-3">
    <div class="w-50 mx-3">
<form action="update_profile.php" method="post" target="_blank">
    <h2>Update your  Profile</h2>
    <label for="name"  class="form-label">Name:</label>
    <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required><br>
    <label for="phone" class="form-label">Phone:</label>
    <input type="tel" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" required><br>
    <label for="address" class="form-label">Address:</label>
    <textarea name="address" class="form-control" required><?php echo $row['address']; ?></textarea><br>
    <input type="submit" value="Update Profile">
</form>
</div>
<div class="w-50 mx-3">
<form action="delete_account.php" method="post" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
    <h2>Delete Account</h2>
    <p>Warning: This will permanently delete your account. This action cannot be undone.</p>
    <input type="submit" value="Delete My Account">
</form>
</div>
</div>
</body>
</html>
