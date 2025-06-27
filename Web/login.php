<?php
include "dbcon.php";

if (isset($_POST['Username']) && isset($_POST['password'])){

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['Username']);
    $pass = validate($_POST['password']);

    if (empty($uname)){
        header("Location: index.php?error=User name is required");
        exit();
    } else if(empty($pass)){
        header("Location: index.php?error=Password is required");
        exit();
    } else{
        $sql = "SELECT * FROM login WHERE email='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if ($result === false) {
            echo "查詢執行失敗: " . mysqli_error($conn);
        } else {
            if (mysqli_num_rows($result) > 0) {
                header("Location: home.html");
                exit();
            } else {
                header("Location: index.php?error=Username or password is wrong");
                exit();
            }
        }
    }

}
?>
