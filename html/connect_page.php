<?php
include './db_connect.php';

session_start();

global $interest;
global $result1;
global $res;
$success_messages = [];
$showSuccess = false;
$showError = false;
$showAlert = false;


if (isset($_SESSION['email'])) {
    $user_id1 = $_SESSION['email'];
    $sql = "SELECT * FROM `uniconn`.`student` WHERE `email` = '$user_id1'";
    $result1 = $conn->query($sql);
    if (!$result1) {
        echo "Error: " . $sql . "<br>" . $conn->error; // Handle query execution error
    }
}

//code to add the selected user as the logged-in user's friend
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_friend"])) {
    $current_user_id = $_SESSION['s_id'];
    $friend_id = $_POST['friend_id'];

    $sql_check_friendship = "SELECT * FROM `friends` WHERE `s_id`='$current_user_id' AND `f_id`='$friend_id'";
    $result_check_friendship = mysqli_query($conn, $sql_check_friendship);

    if (mysqli_num_rows($result_check_friendship) > 0) {
        $showSuccess = 'You are already connected';
        // echo "You are already connected";
    } else {
        $sql_insert = "INSERT INTO `uniconn`.`friends` (`s_id`, `f_id`) VALUES ('$current_user_id', '$friend_id')";
        if (mysqli_query($conn, $sql_insert) === TRUE) {
            $showSuccess = 'Friend added Successfully';
            // echo "Friend added successfully.";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}

//code to search for other users having the same hobby
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchButton'])) {
    $current_email = $_SESSION['email'];
    $interest = $_POST['hobby_name'];
    $sql1 = "SELECT * FROM `student` WHERE `hobby`='$interest' AND `email` != '$current_email'";
    $res = $conn->query($sql1);

    if (!$res) {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    } else {
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = $row;
            }
        } else {
            $showAlert = 'No User found';
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/profile_page.css">
    <style>
        body {
            background-color: #F7EFE5;
        }

        .search-container {
            width: 40%;
            height: 40px;
            margin: auto;
            padding: 3px;
            border: 1px solid black;
            border-radius: 2rem;
            background-color: #F7EFE5;
            text-align: center;
        }

        .search-bar {
            height: auto;
            width: 400px;
            margin: 5px auto;
        }

        #hobby {
            width: 150px;
            background: #F7EFE5;
        }

        .search-button {
            width: 80px;
            text-decoration: none;
            color: black;
            padding: 0.2rem;
            border: none;
            border-radius: 2rem;
            background-color: #C3ACD0;
            transition: all ease-in-out 0.4s;
        }

        .add-button {
            margin: 0.5rem;
            text-decoration: none;
            color: black;
            padding: 0.2rem;
            border: 1px solid black;
            border-radius: 2rem;
            background-color: #C3ACD0;
            transition: all ease-in-out 0.4s;
        }

        .add-button:hover {
            background-color: bisque;
        }
    </style>
</head>

<body>

    <header>
        <div class="navbar">
            <div class="logo">
                <a href="../html/after_landing_page.php"><img src="../img/logo.png" alt="uniconn logo"></a>
            </div>
            <div class="search-container">
                <div class="search-bar">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="hobby-form">
                        <label for="hobby">Choose a hobby:</label>
                        <select id="hobby" name="hobby_name" class="hobby-select">
                            <option value="Reading" <?php if (isset($_POST['hobby_name']) && $_POST['hobby_name'] == 'Reading') echo 'selected'; ?>>Reading</option>
                            <option value="Sports" <?php if (isset($_POST['hobby_name']) && $_POST['hobby_name'] == 'Sports') echo 'selected'; ?>>Sports</option>
                            <option value="Music" <?php if (isset($_POST['hobby_name']) && $_POST['hobby_name'] == 'Music') echo 'selected'; ?>>Music</option>
                            <option value="Gaming" <?php if (isset($_POST['hobby_name']) && $_POST['hobby_name'] == 'Gaming') echo 'selected'; ?>>Gaming</option>
                            <option value="Coding" <?php if (isset($_POST['hobby_name']) && $_POST['hobby_name'] == 'Coding') echo 'selected'; ?>>Coding</option>
                            <option value="Painting" <?php if (isset($_POST['hobby_name']) && $_POST['hobby_name'] == 'Painting') echo 'selected'; ?>>Painting</option>
                            <option value="Travelling" <?php if (isset($_POST['hobby_name']) && $_POST['hobby_name'] == 'Travelling') echo 'selected'; ?>>Travelling</option>
                        </select>
                        <input class="search-button" type="submit" name="searchButton" value="Search">
                    </form>
                </div>
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
                    <p>Suggestions</p>
                </div>
                <div class="mid">
                    <?php
                    if (isset($rows)) {
                        foreach ($rows as $row) {
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
                                <?php if (isset($success_messages[$row['id']])) { ?>
                                    <p><?php echo $success_messages[$row['id']]; ?></p>
                                <?php } else { ?>
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <input type="hidden" name="friend_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="add_friend" class="add-button">Add Friend</button>
                                    </form>
                                <?php } ?>
                            </div>
                    <?php
                        }
                    } else {
                        if ($showSuccess) {
                            echo $showSuccess;
                        } else {
                            echo $showAlert;
                        }
                    }
                    ?>
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