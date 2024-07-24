<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "blood_bank";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a new donor
function addDonor($conn, $full_name, $blood_group, $phone, $email, $address) {
    $full_name = mysqli_real_escape_string($conn, $full_name);
    $blood_group = mysqli_real_escape_string($conn, $blood_group);
    $phone = mysqli_real_escape_string($conn, $phone);
    $email = mysqli_real_escape_string($conn, $email);
    $address = mysqli_real_escape_string($conn, $address);

    $sql = "INSERT INTO donors (full_name, blood_group, phone, email, address) 
            VALUES ('$full_name', '$blood_group', '$phone', '$email', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "New donor added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Example usage: Add a new donor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $blood_group = $_POST['blood_group'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    addDonor($conn, $full_name, $blood_group, $phone, $email, $address);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donor Management System</title>
</head>
<body>
    <h2>Add New Donor</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" required><br><br>
        
        <label for="blood_group">Blood Group:</label><br>
        <input type="text" id="blood_group" name="blood_group" required><br><br>
        
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="address">Address:</label><br>
        <textarea id="address" name="address" rows="4" required></textarea><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

<?php
$conn->close();
?>
