<?php
// Connect to your database
$conn = mysqli_connect("localhost", "root", "", "tanvirproject-311");

// Check for errors
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

// Delete all data from your table
$sql = "DELETE FROM ticketdata";
if (mysqli_query($conn, $sql)) {
  echo "";
} else {
  echo "Error deleting data: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>All Data Deleted</title>
  <style>
    /* Center the content vertically and horizontally */
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    /* Style the success message */
    .success-message {
      padding: 20px;
      border-radius: 10px;
      background-color: #4CAF50;
      color: white;
      text-align: center;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    /* Style the button */
    .go-back-button {
      padding: 10px 20px;
      border-radius: 5px;
      background-color: #008CBA;
      color: white;
      font-size: 16px;
      text-decoration: none;
      margin-top: 20px;
      display: inline-block;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }
    /* Change the background color of the button on hover */
    .go-back-button:hover {
      background-color: #006B8E;
    }
  </style>
</head>
<body>
  <div class="success-message">
    <h1>All Data Deleted Successfully!</h1>
    <a href="viewinfo.php" class="go-back-button">Go Back</a>
  </div>
</body>
</html>
