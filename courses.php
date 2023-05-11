<?php
session_start();

if(!isset($_SESSION["loggedIn"])) {
    header("Location: login.html");
    exit;
}

require_once "config.php";

$sql = "SELECT id, course_name, description, available_slots FROM courses";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Available Courses</title>
    </head>
    <body>
        <h1>Available Course</h1>
        <table class="course-table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Available Slots</th>
                    <th>Action</th>
                </tr>
            </thead>    
            <tbody>
                <?php
                if($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["course_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["available_slots"]) . "</td>";
                        echo "<td>";
                        echo "<a href='signup_course.php?course_id=" . $row["id"] . "'>Sign Up</a>";
                        echo "<a href='dropout_course.php?course_id=" . $row["id"] . "'>Drop Out</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No courses found.</td?></tr>";
                }
                ?>
            </tbody>
        </table>
        <p>
            <a href="welcome.php">Back to Welcome Page</a>
        </p>
    </body>
</html>

<?php
$conn->close();
?>