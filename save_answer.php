<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['student'];
$exam_id = intval($_POST['exam_id']);
$question_id = intval($_POST['question_id']);
$answer = isset($_POST['answer']) ? intval($_POST['answer']) : null;
$qno = intval($_POST['qno']);

// Save student’s answer
if ($answer !== null) {
    $conn->query("INSERT INTO student_answers (student_id, exam_id, question_id, answer) 
                  VALUES ($student_id, $exam_id, $question_id, $answer)
                  ON DUPLICATE KEY UPDATE answer=$answer");
}

// Redirect to next question
header("Location: exam.php?id=$exam_id&qno=" . ($qno + 1));
exit;
?>
