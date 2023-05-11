<?php
session_start();

if(!isset($_SESSION["loggedIn"])) {
    header("Location: login.html");
    exit;
}

require_once "config.php";

$user_id = $_SESSION["id"];

$sql = "SELECT courses.id, courses.course_name, courses.description, courses.available_slots
        FROM user_courses
        JOIN courses ON user_courses.course_id = courses.id
        WHERE user_courses.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Courses</title>
    </head>
    <body>
        <h1>My Courses</h1>
        <table class="course-table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Available</th>
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
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>You have not signed up for any courses.</td?></tr>";
                }
                ?>
            </tbody>
        </table>
        <p>
            <a href="courses.php">Back to Available Courses</a>
        </p>
    </body>
</html>

<?php
$stmt->close();
$conn->close();
?>