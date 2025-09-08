<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin")  {
     echo "<h3 style='color:red;'>Access Denied. Please <a href='../login.php'>login</a> as admin. </h3>";
    // header("Location: ../dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
    <ul>
        <li><a href="add_exam.php">Add Exam</a></li>
        <li><a href="add_question.php">Add Questions</a></li>
        <li><a href="view_results.php">View Student Results</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
