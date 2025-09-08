<?php
session_start();
include 'config.php';

if(!isset($_SESSION['student'])) {
  header("Location: login.php");
  exit;
}

$student_id = $_SESSION['student'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Results - Exam Portal</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <h2>Your Results</h2>
  <table border="1" cellpadding="10">
    <tr>
      <th>Exam</th>
      <th>Score</th>
    </tr>
    <?php
    $sql = "SELECT exams.title, results.score 
            FROM results 
            JOIN exams ON results.exam_id = exams.id 
            WHERE results.student_id = $student_id";
    $res = $conn->query($sql);
    while($row = $res->fetch_assoc()) {
      echo "<tr><td>{$row['title']}</td><td>{$row['score']}</td></tr>";
    }
    ?>
  </table>
  <?php include 'footer.php'; ?>
</body>
</html>
