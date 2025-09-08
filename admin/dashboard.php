<?php
session_start();
/*// Check if the user is logged in as admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    echo "<h3 style='color:red;'>Access Denied. Please <a href='../admin/login.php'>login</a> as admin. 
    And if you are a new user then please <a href='../admin/register.php'>register</a> as admin.</h3>";
    exit;
}*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
    <ul>
        <li><a href="add_exam.php">Add Exam</a></li>
        <li><a href="add_question.php">Add Questions</a></li>
        <li><a href="view_results.php">View Student Results</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
