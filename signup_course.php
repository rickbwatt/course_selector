<?php

session_start();

if(!isset($_SESSION["loggedIn"])) {
    header("Location: login.html");
    exit;
}

require_once "config.php";

$course_id = $_GET["course_id"];
$user_id = $_SESSION["id"];
$signup_success = false;

$sql = "SELECT id FROM user_courses WHERE user_id = ? AND course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $course_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    $sql = "INSERT INTO user_courses (user_id, course_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $course_id);

    if($stmt->execute()) {
        $signup_success = true;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign Up for Course</title>
    </head>
    <body>
        <?php
        if ($signup_success) {
            echo "<h1>You have successfully signed up for the course!</h1>";
        } else {
            echo "<h1>Failed to sign up for course.</h1>";
        }
        ?>
        <p>
            <a href="courses.php">Back to Courses</a>
        </p>
    </body>
</html>