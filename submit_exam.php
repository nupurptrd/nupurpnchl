<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

$student_id = intval($_SESSION['student']);
$exam_id = isset($_POST['exam_id']) ? intval($_POST['exam_id']) : 0;

// fallback from session if exam_id missing
if ($exam_id == 0 && isset($_SESSION['exam_id'])) {
    $exam_id = intval($_SESSION['exam_id']);
}

if ($exam_id == 0) {
    die("Invalid Exam ID.");
}

// store exam_id in session for safety
$_SESSION['exam_id'] = $exam_id;

// Fetch all questions for this exam
$questions = $conn->query("SELECT * FROM questions WHERE exam_id=$exam_id");
if (!$questions) {
    die("DB error: " . $conn->error);
}

$score = 0;
$total = $questions->num_rows;

while ($q = $questions->fetch_assoc()) {
    $qid = $q['id'];
    $correct_answer = intval($q['correct_option']);

    $res = $conn->query("SELECT answer FROM student_answers 
                         WHERE student_id=$student_id AND exam_id=$exam_id AND question_id=$qid");
    if ($res && $row = $res->fetch_assoc()) {
        $student_answer = intval($row['answer']);
        if ($student_answer === $correct_answer) {
            $score++;
        }
    }

    if (isset($_POST['q' . $qid])) {
        $student_answer = $conn->real_escape_string($_POST['q' . $qid]);

        if ($student_answer == $correct_answer) {
            $score++;
        }

        // Save or update student's answer
        $conn->query("INSERT INTO student_answers (student_id, exam_id, question_id, answer) 
                      VALUES ($student_id, $exam_id, $qid, '$student_answer')
                      ON DUPLICATE KEY UPDATE answer='$student_answer'");
    }
}

// Save result
$conn->query("INSERT INTO results (student_id, exam_id, score, total) 
              VALUES ($student_id, $exam_id, $score, $total)
              ON DUPLICATE KEY UPDATE score=$score, total=$total");

// ✅ OPTION A: Redirect to home page
//header("Location: index.php?msg=" . urlencode("Exam Submitted Successfully. You scored $score / $total"));
//exit;

// ✅ OPTION B (if you want result page instead of redirect):

?>
<!DOCTYPE html>
<html>
<head>
    <title>Exam Result</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<<<<<<< HEAD
    <?php include 'header.php'; ?>

    <h2>Exam Submitted</h2>
    <p aria-live="assertive" ><?php echo $message; ?></p>
    <a href="results.php">View My Results</a>

    <?php include 'footer.php'; ?>
=======
    <h2>Exam Completed</h2>
    <p>You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo $total; ?></strong>.</p>
    <a href="index.php" style="background:green;color:white;padding:10px;text-decoration:none;">Go to Home</a>
>>>>>>> 348612bb4e8a914b587df9062d158fcce5239504
</body>
</html>
<?php

?>
