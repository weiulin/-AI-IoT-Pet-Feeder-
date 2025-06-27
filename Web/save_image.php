<?php
$host = "localhost";
$dbname = "testdata";
$username = "root";
$password = "411021233";
$target_dir = "user_cat/";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $conn->real_escape_string($_POST['name']);

foreach ($_FILES["images"]["name"] as $key => $filename) {
    $target_file = $target_dir . basename($filename);
    $tmp_name = $_FILES["images"]["tmp_name"][$key];

    if (move_uploaded_file($tmp_name, $target_file)) {
        echo "The file ". htmlspecialchars($filename). " upload successful.<br>";

        $stmt = $conn->prepare("INSERT INTO images (cat_name, image_path) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $target_file);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.<br>";
    }
}

$conn->close();
?>

<button type="button" onclick="location.href='home.html'">Return to menu</button>
