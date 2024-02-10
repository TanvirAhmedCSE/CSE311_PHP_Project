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

    // Query to select the row where the userName and password match the entered values
    $sql = "SELECT * FROM logininfo WHERE userName='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User is authenticated
        header("Location: landingPage.php");
        exit();
    } else {
        // Display error message
        echo "<script>alert('Incorrect username or password');</script>";
    }
}

$conn->close();


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <h1>Login Page</h1>
    <form method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" placeholder="Enter your name" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" placeholder="Enter your password" name="password" required><br>
        <button type="submit" name="submit">Login</button>
        <a href="signup.php"><button type="button" name="signup">Signup</button></a>
    </form>
</body>
