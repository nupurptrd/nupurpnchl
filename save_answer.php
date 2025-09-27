<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['student'];
$exam_id = $_POST['exam_id'];
$question_id = $_POST['question_id'];
$answer = $_POST['answer'] ?? null;
$qno = $_POST['qno'];

if ($answer) {
    $sql = "INSERT INTO student_answers (student_id, exam_id, question_id, answer)
            VALUES ('$student_id','$exam_id','$question_id','$answer')
            ON DUPLICATE KEY UPDATE answer='$answer'";
    $conn->query($sql);
}

// Redirect to next question
header("Location: exam.php?id=$exam_id&qno=".($qno+1));
exit;
?>
