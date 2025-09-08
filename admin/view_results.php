<?php
session_start();
include '../config.php';
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Results</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>All Student Results</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Student</th>
            <th>Exam</th>
            <th>Score</th>
        </tr>
        <?php
        $sql = "SELECT students.name, exams.title, results.score 
                FROM results
                JOIN students ON results.student_id = students.id
                JOIN exams ON results.exam_id = exams.id";
        $res = $conn->query($sql);
        while($row = $res->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['score']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
