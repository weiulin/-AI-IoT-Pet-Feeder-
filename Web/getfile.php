<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Get Pet Info</title>
    <style>
        body {
            font-family: 'Noto Sans TC', sans-serif;
            margin: 0;
            padding: 0;
            background: url('assets/cat2.jpg') no-repeat center center / cover;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 80%;
            max-width: 500px;
        }

        form {
            display: block;
            width: 100%;
        }

        label, span {
            display: block;
            margin-bottom: 5px;
            color: white;
        }

        input, select, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
            font-size: 14px;
        }

        button {
            background-color: #333;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Select a Pet</h1>
        <form action="" method="post">
            <select name="name">
                <option value="no-info">Select a pet</option>
                <?php
                $mysqli = new mysqli("localhost", "root", "411021233", "testdata");
                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                $result = $mysqli->query("SELECT DISTINCT name FROM cats");
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
                }
                ?>
            </select>
            <button type="submit">Show Details</button>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && $_POST['name'] != 'no-info') {
                $petName = $_POST['name'];
                $stmt = $mysqli->prepare("SELECT * FROM cats WHERE name = ?");
                $stmt->bind_param("s", $petName);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo "<table border='1'><tr><th>Name</th><th>Breed</th><th>Weight</th><th>Age</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['breed']) . "</td>";
                        echo "<td>" . $row['weight'] . " kg</td>";
                        echo "<td>" . $row['years'] . " years " . $row['months'] . " months</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No details found for the selected pet.</p>";
                }
                $stmt->close();
            }
            ?>
            <button type="button" onclick="location.href='home.html'">Return to menu</button>
        </form>
        <?php $mysqli->close(); ?>
    </div>
</body>
</html>
