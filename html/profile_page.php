<?php
include './db_connect.php';

session_start();

global $result1;
global $result;
global $res;

if (isset($_SESSION['email'])) {
    $user_id1 = $_SESSION['email'];

    $sql = "SELECT * FROM `uniconn`.`student` WHERE `email` = '$user_id1'";
    $result1 = $conn->query($sql);
}

if (isset($_SESSION['s_id'])) {
    $user_id = $_SESSION['s_id'];

    $sql1 = "SELECT * FROM `uniconn`.`friends` where `s_id`= '$user_id' ";
    $res = $conn->query($sql1);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/profile_page.css">
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
                <a href="../html/after_landing_page.php"><img src="../img/logo.png" alt="uniconn logo"></a>
            </div>
            <div class="centernav">


            </div>
            <div class="addfriend">
                <a href="connect_page.php">Add Friends</a>
            </div>
        </div>
    </header>

    <main>
        <div class="content">
            <div class="profile">
                <div class="profilepic">
                    <img src="../img/user.png" alt="profile picture">
                </div>
                <?php
                if ($result1 && $result1->num_rows > 0) {
                    $row1 = $result1->fetch_assoc();
                ?>
                    <p><?php echo $row1['name']; ?></p>
                    <p><?php echo $row1['email']; ?></p>
                    <p><?php echo $row1['id']; ?></p>
                    <p><?php echo $row1['branch']; ?></p>
                    <p><?php echo $row1['hobby']; ?></p>
                <?php
                } else {
                    echo "You haven't logged-in";
                }
                ?>

                <div class="logout">
                    <a href="../html/logout.php">Log Out</a>
                </div>

                <div class="social">
                    <a href="https://www.instagram.com/"><img src="../img/instagram.png" alt="Instagram"></a>
                    <a href="https://www.twitter.com/"><img src="../img/twitter.png" alt="Twitter"></a>
                    <a href="https://www.facebook.com/"><img src="../img/facebook.png" alt="Facebook"></a>
                </div>
            </div>

            <div class="connection">
                <div class="topmid">
                    <img src="../img/connection.png" alt="connection">
                    <p>Connections</p>
                </div>
                <div class="mid">
                    <?php
                    if ($res && $res->num_rows > 0) {
                        while ($row_id = $res->fetch_assoc()) {
                    ?>
                            <?php
                            $id = $row_id['f_id'];
                            $sql2 = "SELECT * FROM `uniconn`.`student` WHERE `id` = '$id'";
                            $result = $conn->query($sql2);
                            $row = $result->fetch_assoc();
                            ?>
                            <div class="friends">
                                <div class="f_profilepic">
                                    <img src="../img/user.png" alt="profile picture">
                                </div>
                                <p><?php echo $row['id']; ?></p>
                                <p><?php echo $row['name']; ?></p>
                                <p><?php echo $row['email']; ?></p>
                                <p><?php echo $row['branch']; ?></p>
                                <p><?php echo $row['hobby']; ?></p>
                            </div>
                    <?php
                        }
                    }else {
                        echo 'No friends Connected';
                    } ?>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="foot-content">
            <p>© UniConn 2024</p>
        </div>
    </footer>

</body>

</html>