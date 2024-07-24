<?php
session_start();
$showAlert = false;
$showError = false;
$user_id_array = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sig"])) {
    include './db_connect.php';
    $user_id = $_POST["id"];
    $_SESSION['id'] = $user_id;
    $username = $_POST["name"];
    $email = $_POST["email"];
    $branch = $_POST["branch"];
    $hobby = $_POST["hobby_choice"];
    $password = $_POST["pswd"];
    $cpassword = $_POST["cpswd"];
    // $exists=false;

    // Check whether this username exists
    $existSql = "SELECT * FROM `student` WHERE `name` = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {
        // $exists = true;
        $showError = "Username Already Exists";
    } else {
        // $exists = false; 
        if (($password == $cpassword)) {
            // $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `uniconn`.`student` (`id`,`name`, `email`, `branch`, `hobby`, `password`, `cpassword`,`dt`) VALUES ('$user_id','$username', '$email', '$branch', '$hobby', '$password', '$cpassword', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match";
        }
    }
}

$login = false;
$showError_log = false;
if (isset($_POST["login"])) {
    include './db_connect.php';
    $email = $_POST["email"];
    $_SESSION['email'] = $email;
    $password = $_POST["pswd"];

    // $sql = "Select * from users where username='$username' AND password='$password'";
    $sql = "SELECT * FROM `student` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            // $row = mysqli_fetch_assoc($result);
            if ($password == $row['password']) {
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['s_id'] = $row['id'];
                header("location: after_landing_page.php");
                exit();
            } else {
                $showError_log = "Invalid Credentials";
            }
        }
    } else {
        $showError_log = "Invalid Credentials. Username is incorrect or password or you are not registered. Try again";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/landing_page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login_page.css">


    <style>
        body {
            background-color: #F7EFE5;
        }
    </style>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <a href="../html/before_landing_page.php"><img src="../img/logo.png" alt="uniconn logo"></a>
            </div>
        </div>
    </header>

    <?php
    if ($showAlert) {
        echo 'Success!</strong> Your account is now created and you can login';
    }
    if ($showError) {
        echo '<strong>Error!</strong> ' . $showError . ' ';
    }
    if ($showError_log) {
        echo '<strong>Error!</strong> ' . $showError_log . ' ';
    }
    ?>

    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup">
            <form action="login_page.php" method="post" name="sig">
                <label id="signup_l" for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="id" placeholder="ID" required="">
                <input type="text" name="name" placeholder="User name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="text" name="branch" placeholder="Branch" required="">
                <select id="hobby" name="hobby_choice" required>
                    <option value="Reading">Reading</option>
                    <option value="Sports">Sports</option>
                    <option value="Music">Music</option>
                    <option value="Gaming">Gaming</option>
                    <option value="Coding">Coding</option>
                    <option value="Painting">Painting</option>
                    <option value="Travelling">Travelling</option>
                </select>
                <input type="password" name="pswd" placeholder="Password" required="">
                <input type="password" name="cpswd" placeholder="Confirm Password" required="">
                <button type="submit" name="sig">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form action="login_page.php" method="post">
                <label id="login_l" for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="pswd" placeholder="Password" required="">
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="foot-content">
            <p>© UniConn 2024</p>
        </div>
    </footer>

</body>

</html>