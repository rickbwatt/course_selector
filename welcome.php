<?php
session_start();

if(!isset($_SESSION["loggedIn"])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welcome</title>
    </head>
    <body>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!<h1>
            <p>
                <a href="courses.php">Available Courses</a>
            </p>
            <p>
                <a href="my_courses.php">My Courses</a>
            </p>
            <p>
                <a href="logout.php">Logout</a>
            </p>
        </h1>
    </body>
</html>