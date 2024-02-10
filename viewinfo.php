<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticket Counter - View Info</title>
  <link rel="stylesheet" href="landingPage.css">
  
<style>
 .ticket-info {
  max-width: 80%;
  margin: 0 auto;
}

.book-another-button,
.delete-all-button {
  display: inline-block;
  margin-left: 130px;
  padding: 10px 20px;
  background-color: #ff9933;
  border: none;
  border-radius: 5px;
  color: #fff;
  font-size: 1.2em;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.book-another-button:hover,
.delete-all-button:hover {
  background-color: #ffbf80;
  color: rgb(249, 5, 5);
}

button-container {
  text-align: center;
}


</style>
</head>
<body>
  <header>
    <h1>Ticket Information</h1>
    <h2>
      <span style="color: orange; font-size: 50px; display: inline-block; transform: rotate(5deg);">
          Showing
      </span>
      Your
      <span style="color: orange; font-size: 50px; display: inline-block; transform: rotate(-5deg);">
          Ticket
      </span>
      Details
    </h2>
  </header>
  <main>
    <section class="ticket-info">
      <h3>Ticket Information</h3>
      <table>
        <tbody>
        <?php
        // Connect to database
        $conn = mysqli_connect("localhost", "root", "", "tanvirproject-311");
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Query to fetch data from the table
        $sql = "SELECT * FROM ticketdata";
        
        // Execute the query
        $result = mysqli_query($conn, $sql);
        
        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Display the data in a table
            echo "<table>";
            echo "<tr><th>ID</th><th>From</th><th>To</th><th>Bus Operator</th><th>Seat Name</th><th>Date</th><th>Ticket Type</th><th>Quantity</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["fromplace"]."</td><td>".$row["toplace"]."</td><td>".$row["bus_operator"]."</td><td>".$row["seat_name"]."</td><td>".$row["date"]."</td><td>".$row["ticket_type"]."</td><td>".$row["quantity"]."</td></tr>";
            }
            echo "</table>";
        } else {
            // No data found
            echo "No data found";
        }
        
        // Close database connection
        mysqli_close($conn);
        ;
        ?>




        </tbody>
      </table>
      <br>
      <section class="ticket-info">
  <!-- ticket table code here -->
  <div class="button-container">
    <button class="book-another-button" onclick="window.location.href='landingPage.php'">Book Another Ticket</button>
    <button class="delete-all-button" onclick="deleteAllTickets();">Delete All Data</button>

<script>
function deleteAllTickets() {
  if (confirm("Are you sure you want to delete all tickets?")) {
    // Call the deleteAllTickets.php file
    window.location.href = "deleteAllTickets.php";

    // Wait for 2 seconds before reloading the page
    setTimeout(function() {
      window.location.href = "viewinfo.php";
    }, 2000);
  }
}
</script>

    </section>
  </main>
</body>
</html>