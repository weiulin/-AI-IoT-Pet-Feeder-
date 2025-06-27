<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Cat Image</title>
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

        form {
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0);
            backdrop-filter: blur(5px);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            margin: auto;
            border: none;
        }

        form h2 {
            margin-top: 0;
            color: black;
        }

        form div {
            margin-bottom: 15px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: black;
        }

        form input[type="file"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            color: black;
            margin-bottom: 10px;
        }

        form button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #333;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        form button:hover {
            background-color: #555;
        }

        .error {
            color: red;
            font-size: 14px;
            font-weight: bold;
            margin-top: 5px;
            display: none;
        }
    </style>
</head>

<body>
    <form id="uploadForm" action="save_image.php" method="post" enctype="multipart/form-data">
        <h2>Upload Images for <?php echo htmlspecialchars($_GET['name']); ?></h2>
        <input type="hidden" name="name" value="<?php echo htmlspecialchars($_GET['name']); ?>">
        <label for="image">Select images to upload:</label>
        <input type="file" name="images[]" id="image" multiple required><br><br>
        <div id="errorMessage" class="error">Please select at least one image.</div>
        <button type="button" onclick="uploadImages()">Upload Images</button>
        <button type="button" onclick="location.href='home.html'">Return to menu</button>
    </form>

    <script>
        function uploadImages() {
            var fileInput = document.getElementById('image');
            if (fileInput.files.length === 0) {
                document.getElementById('errorMessage').style.display = 'block';
                return;
            }
            var form = document.getElementById('uploadForm');
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_image.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert('Images uploaded successfully!');
                } else {
                    alert('Error uploading images. Please try again later.');
                }
            };
            xhr.onerror = function () {
                alert('Network error. Please check your internet connection and try again.');
            };
            xhr.send(formData);
        }
    </script>
</body>

</html>
