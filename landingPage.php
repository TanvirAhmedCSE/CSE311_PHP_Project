<?php
// Establishing MySQL database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tanvirproject-311";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Inserting form data into the database table
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $busOperator = $_POST['bus-service-name'];
    $seatNameArray = isset($_POST['seats']) ? $_POST['seats'] : [];
    $seatCount = count($seatNameArray);
    $seatName = implode(', ', $seatNameArray);
    $date = $_POST['date'];
    $ticketType = $_POST['ticket-type'];
    $quantity = $seatCount > 0 ? $seatCount : '';
    if(empty($from) || empty($to) || empty($busOperator) || empty($seatName) || empty($date) || empty($ticketType)) {
      echo "<script>alert('Please fill out all required fields');</script>";
  } else {
    $sql = "INSERT INTO ticketdata (fromplace, toplace, bus_operator, seat_name, date, ticket_type, quantity) 
            VALUES ('$from', '$to', '$busOperator', '$seatName', '$date', '$ticketType', '$quantity')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Successfully Booked!')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
}

mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticket Counter</title>
  <link rel="stylesheet" href="landingPage.css">
</head>
<body>
  <header>
    <h1>Ticket Counter</h1>
    <h2>
      <span style="color: orange; font-size: 50px; display: inline-block; transform: rotate(5deg);">
          Book
      </span>
      Your
      <span style="color: orange; font-size: 50px; display: inline-block; transform: rotate(-5deg);">
          Ticket
      </span>
      here
  </h2>
  </header>
  
  <main>
    <section class="ticket-form">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
          <label for="from">From</label>
          <input type="text" id="from" name="from" list="fromlist">
          <datalist id="fromlist">
            <?php
              $districts = array("Dhaka", "Chittagong", "Khulna", "Rajshahi", "Barisal", "Sylhet", "Rangpur", "Mymensingh");
              foreach ($districts as $district) {
                echo "<option value=\"$district\">";
              }
            ?>
          </datalist>
        </div>
        <div class="form-group">
          <label for="to">To</label>
          <input type="text" id="to" name="to" list="tolist">
          <datalist id="tolist">
            <?php
              foreach ($districts as $district) {
                echo "<option value=\"$district\">";
              }
            ?>
          </datalist>
        </div>
        <div class="form-group">
          <label for="bus-service-name">Bus Service Name</label>
          <input type="text" id="bus-service-name" name="bus-service-name" list="bus-services">
          <datalist id="bus-services">
            <option value="Green Line">Green Line</option>
            <option value="Shohagh Paribahan">Shohagh Paribahan</option>
            <option value="Hanif Enterprise">Hanif Enterprise</option>
            <option value="Desh Travels">Desh Travels</option>
            <option value="S.R Travels">S.R Travels</option>
            <option value="Ena Transport">Ena Transport</option>
            <option value="Nabil Paribahan">Nabil Paribahan</option>
            <option value="S.Alam Paribahan">S.Alam Paribahan</option>
            <option value="Royal Coach">Royal Coach</option>
            <option value="Eagle Paribahan">Eagle Paribahan</option>
          </datalist>
        </div>
        <div class="form-group">
          <label for="seat-name">Seat Name</label>
          <div id="seat-group">
            <?php
            $rowNames = range('A', 'J');
            for ($i=0; $i<10; $i++) {
              for ($j=1; $j<=4; $j++) {
                $seatName = $rowNames[$i] . $j;
                echo "<label for='seat_$seatName'>";
                echo "<input type='checkbox' id='seat_$seatName' name='seats[]' value='$seatName' />";
                echo "$seatName";
                echo "</label>";
              }
              echo "<br />";
            }
            ?>
          </div>
        </div>
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" id="date" name="date">
        </div>
      <br>
        <div class="form-group">
          <label for="ticket-type">Ticket Type</label>
          <select id="ticket-type" name="ticket-type">
            <option value="economy">Economy</option>
            <option value="business">Business</option>
            <option value="first-class">First Class</option>
          </select>
        </div>
        <div class="form-group">
          <label for="quantity">Quantity</label>
          <input type="number" id="quantity" name="quantity" min="1" max="10">
        </div>
        <button type="submit">Book Now</button>
        <br>
        <a href="viewinfo.php">Details</a>

      </form>
    </section>
  </main>
  <footer>
    <p>&copy; 2023 Ticket Counter. All rights reserved.</p>
  </footer>
  
</script>
</body>
</html>
