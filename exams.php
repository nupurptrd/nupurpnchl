<?php session_start(); ?>
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Exams - Exam Portal</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <h2>Upcoming Exams</h2>
  <ul>
    <?php
    $result = $conn->query("SELECT * FROM exams ORDER BY date ASC");
    while($row = $result->fetch_assoc()) {
      echo "<li><strong>{$row['title']}</strong> - {$row['date']}<br>{$row['description']}</li>";
    }
    ?>
  </ul>
  <?php include 'footer.php'; ?>
</body>
</html>
