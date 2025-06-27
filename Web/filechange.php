<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Cat Info</title>
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
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
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
        <form action="" method="post">
            <h2>Change Cat Information</h2>
            <?php
            $mysqli = new mysqli("localhost", "root", "411021233", "testdata");
            $message = '';

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            if (isset($_POST['save_changes'])) {
                $stmt = $mysqli->prepare("UPDATE cats SET weight=?, years=?, months=? WHERE name=?");
                $stmt->bind_param("diis", $_POST['weight'], $_POST['years'], $_POST['months'], $_POST['original_name']);
                if ($stmt->execute()) {
                    $message = 'Cat information updated successfully.';
                } else {
                    $message = 'Error updating record.';
                }
                $stmt->close();
            }

            $result = $mysqli->query("SELECT DISTINCT name FROM cats");
            echo '<select name="original_name" onchange="this.form.submit()">';
            echo '<option value="">Select a pet</option>';
            while ($row = $result->fetch_assoc()) {
                $selected = (isset($_POST['original_name']) && $_POST['original_name'] == $row['name']) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($row['name']) . '" ' . $selected . '>' . htmlspecialchars($row['name']) . '</option>';
            }
            echo '</select>';
            ?>
            <?php
            if (isset($_POST['original_name']) && $_POST['original_name'] != '') {
                $stmt = $mysqli->prepare("SELECT * FROM cats WHERE name = ?");
                $stmt->bind_param("s", $_POST['original_name']);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    echo '<input type="hidden" name="original_name" value="' . htmlspecialchars($row['name']) . '">';
                    echo '<label>Name: </label><span>' . htmlspecialchars($row['name']) . '</span>';
                    echo '<label>Breed: </label><span>' . htmlspecialchars($row['breed']) . '</span>';
                    echo '<label for="weight">Weight (kg):</label>';
                    echo '<input type="text" id="weight" name="weight" value="' . htmlspecialchars($row['weight']) . '" required>';
                    echo '<label for="years">Age (Years):</label>';
                    echo '<input type="number" id="years" name="years" value="' . htmlspecialchars($row['years']) . '" required>';
                    echo '<label for="months">Age (Months):</label>';
                    echo '<input type="number" id="months" name="months" value="' . htmlspecialchars($row['months']) . '" required>';
                    echo '<button type="submit" name="save_changes">Save Changes</button>';
                }
                $stmt->close();
            }
            $mysqli->close();
            ?>
        </form>
        <form action="home.html" method="get">
            <button type="submit">Return to Menu</button>
        </form>
    </div>

    <?php if ($message): ?>
    <script type="text/javascript">
        alert('<?php echo $message; ?>');
    </script>
    <?php endif; ?>
</body>
</html>
