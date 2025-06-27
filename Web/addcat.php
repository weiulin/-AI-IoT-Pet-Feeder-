<?php
$host = "localhost";
$dbname = "testdata";
$username = "root";
$password = "411021233";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $conn->real_escape_string($_POST['name']);
$breed = $conn->real_escape_string($_POST['breed']);
$weight = $conn->real_escape_string($_POST['weight']);
$years = (int)$_POST['years'];
$months = (int)$_POST['months'];

$stmt = $conn->prepare("INSERT INTO cats (name, breed, weight, years, months) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssdii", $name, $breed, $weight, $years, $months);

if ($stmt->execute()) {
    $conn->close();
    header("Location: upload_image.php?name=" . urlencode($name));
    exit;
} else {
    echo "Error: " . $stmt->error;
    $conn->close();
}
?>
