<?php
// session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//     header("location: login_page.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/landing_page.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <a href="after_landing_page.php"><img src="../img/logo.png" alt="uniconn logo" /></a>
            </div>
            <div class="nav">
                <!-- <h1>header</h1> -->
            </div>
            <div class="login">
                <a href="profile_page.php">My Profile</a>
                <a href="connect_page.php">Discover friends</a>
                <a href="../html/logout.php">Logout</a>
            </div>
        </div>
    </header>

    <main>
        <div class="content">
            <div class="welcome_img">
                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt />
                <div class="content_1">
                    <div class="welcome">
                        <p>
                            Connecting Students Through Shared
                            <br />Interests and Hobbies
                        </p>
                        <!-- <a href="../html/login_page.php">Lets Connect!</a> -->
                    </div>
                    <div class="discover">
                        <p>
                            Our innovative friend recommendation system uses
                            advanced
                            algorithms <br />to match students based on
                            their personal
                            interests and hobbies.<br />
                            Find new friends who share your passions and
                            make your
                            university experience even more memorable.
                        </p>
                        <!-- <a href="login_page.php">Lets Connect!</a> -->
                    </div>
                </div>
            </div>

            <div class="content_2">
                <p>Top Interests</p>
                <div class="interest">
                    <div class="img1">
                        <p>Reading</p>
                        <a href="connect_page.php"><img src="https://images.unsplash.com/photo-1491309055486-24ae511c15c7?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="reading"> </a>
                    </div>
                    <div class="img2">
                        <label>Sports</label>
                        <a href="connect_page.php"><img src="https://images.unsplash.com/photo-1484482340112-e1e2682b4856?q=80&w=1776&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="reading"> </a>
                        <p>Music</p>
                        <a href="connect_page.php"><img src="https://images.unsplash.com/photo-1510915361894-db8b60106cb1?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="reading"> </a>
                    </div>
                    <div class="img3">
                        <p>Gaming</p>
                        <a href="connect_page.php"><img src="https://images.unsplash.com/photo-1606490114832-d41056bdca34?q=80&w=1886&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="reading"> </a>
                    </div>
                    <div class="img4">
                        <label style="z-index: 1; font-size: 1rem; position: absolute; bottom: 200px; position: absolute; right: 16px; background-color: rgba(0, 0, 0, 0.6); padding: 5px; border-radius: 5px; font-size: 14px; color: white; z-index: 1;">Coding</label>
                        <a href="connect_page.php"><img src="https://plus.unsplash.com/premium_photo-1678566153919-86c4ba4216f1?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="reading"> </a>
                        <p>Painting</p>
                        <a href="connect_page.php"><img src="https://plus.unsplash.com/premium_photo-1673514503035-0021bb051fa7?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="reading"> </a>
                    </div>
                    <div class="img5">
                        <p>Travelling</p>
                        <a href="connect_page.php"><img src="https://images.unsplash.com/photo-1554710869-95f3df6a3197?q=80&w=1877&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="reading"> </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    
    <footer>
        <div class="foot_content">
        <p>© UniConn 2024</p>
        </div>
    </footer>

</body>
</html>
