<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

$exam_id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$qno = isset($_GET['qno']) ? intval($_GET['qno']) : 1;

// Get exam details
$exam = $conn->query("SELECT * FROM exams WHERE id=$exam_id")->fetch_assoc();

// Get total questions
$total_questions = $conn->query("SELECT COUNT(*) AS cnt FROM questions WHERE exam_id=$exam_id")->fetch_assoc()['cnt'];

// Fetch current question
$question = $conn->query("SELECT * FROM questions WHERE exam_id=$exam_id LIMIT ".($qno-1).",1")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $exam['title']; ?> - Take Exam</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<?php include 'header.php'; ?>

<h2><?php echo $exam['title']; ?></h2>
<p><?php echo $exam['description']; ?> | Date: <?php echo $exam['date']; ?></p>

<?php if ($question): ?>
    <form method="post" action="save_answer.php">
        <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
        <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
        <input type="hidden" name="qno" value="<?php echo $qno; ?>">

        <p><strong>Q<?php echo $qno; ?>. <?php echo $question['question']; ?></strong></p>
        <label><input type="text" name="option_a" value="1"> <?php echo $question['option_a']; ?></label><br>
        <label><input type="radio" name="option_b" value="2"> <?php echo $question['option_b']; ?></label><br>
        <label><input type="radio" name="option_c" value="3"> <?php echo $question['option_c']; ?></label><br>
        <label><input type="radio" name="option_d" value="4"> <?php echo $question['option_d']; ?></label><br><br>


        <?php if ($qno < $total_questions): ?>
            <button type="submit">Next Question</button>
        <?php else: ?>
            <button type="submit" formaction="submit_exam.php">Finish Exam</button>
        <?php endif; ?>
    </form>
<?php else: ?>
    <p>No questions available.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
</body>
</html>
