<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500&display=swap" rel="stylesheet">
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
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0);
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
        
        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
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
            color: black;
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <h2>Login</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>email</label>
        <input type="text" name="Username"><br>

        <label>Password</label>
        <input type="password" name="password"><br>

        <button type="submit">Login</button>
        <button type="button" onclick="location.href='register.html'">Register</button>
        <button type="button" onclick="location.href='stars.php'">Return to Home</button>
    </form>
</body> 
</html>
