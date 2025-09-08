<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['student'];
$exam_id = intval($_POST['exam_id']);

// Get all questions for this exam
$questions = $conn->query("SELECT * FROM questions WHERE exam_id=$exam_id");

$score = 0;
$total = $questions->num_rows;

while ($q = $questions->fetch_assoc()) {
    $qid = $q['id'];
    $correct = $q['correct_option'];
    if (isset($_POST["q$qid"]) && $_POST["q$qid"] === $correct) {
        $score++;
    }
}

// Save result
$sql = "INSERT INTO results (student_id, exam_id, score) 
        VALUES ($student_id, $exam_id, $score)
        ON DUPLICATE KEY UPDATE score=$score";

if ($conn->query($sql)) {
    $message = "Your exam has been submitted! You scored $score out of $total.";
} else {
    $message = "Error saving result: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Exam Submitted - Exam Portal</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <h2>Exam Submitted</h2>
    <p><?php echo $message; ?></p>
    <a href="results.php">View My Results</a>

    <?php include 'footer.php'; ?>
</body>
</html>
