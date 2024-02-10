<?php

// Establishing a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tanvirproject-311";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving the values submitted from the form
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Check if any required fields are empty
    if(empty($username) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('Please fill out all required fields');</script>";
    } else {
        //Check if password and confirm password fields have the same value
        if($password !== $confirm_password) {
            echo "<script>alert('Password and Confirm Password do not match');</script>";
        } else {
            // Query to insert data into the logininfo table
            $sql = "INSERT INTO logininfo (userName, password) VALUES ('$username', '$confirm_password')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Data inserted successfully');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="login.css">


</head>

<body>

    <h1>Sign up Page</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>

        <label for="confirm-password">Confirm Password:</label><br>
        <input type="password" id="confirm-password" name="confirm-password"><br>
        <a href="login.php"><button type="button" name="login">Login</button></a>
        <button type="submit" name="submit" onsubmit="return true">Submit</button>

    </form>


</body>

</html>
