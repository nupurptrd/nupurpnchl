<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

$exam_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Get exam details
$exam = $conn->query("SELECT * FROM exams WHERE id=$exam_id")->fetch_assoc();
$questions = $conn->query("SELECT * FROM questions WHERE exam_id=$exam_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $exam['title']; ?> - Take Exam</title>
    <link rel="stylesheet" href="assets/style.css">
    <script>
    // Countdown timer
    let duration = <?php echo $exam['duration']; ?> * 60; // convert minutes to seconds

    function startTimer() {
        let timer = duration, minutes, seconds;
        let countdown = document.getElementById("time");

        let interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            countdown.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(interval);
                alert("⏳ Time is up! Your exam will be submitted automatically.");
                document.getElementById("examForm").submit();
            }
        }, 1000);
    }

    window.onload = startTimer;
    </script>
</head>
<body>
    <?php include 'header.php'; ?>

    <h2><?php echo $exam['title']; ?></h2>
    <p><?php echo $exam['description']; ?> | Date: <?php echo $exam['date']; ?></p>
    <p><strong>Time Remaining: <span id="time"></span></strong></p>

    <?php if ($questions->num_rows > 0): ?>
    <form method="post" action="submit_exam.php" id="examForm">
        <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">

        <?php $qno = 1; ?>
        <?php while($q = $questions->fetch_assoc()): ?>
            <div class="question">
                <p><strong><?php echo $qno++ . ". " . $q['question']; ?></strong></p>
                <label><input type="radio" name="q<?php echo $q['id']; ?>" value="a"> <?php echo $q['option_a']; ?></label><br>
                <label><input type="radio" name="q<?php echo $q['id']; ?>" value="b"> <?php echo $q['option_b']; ?></label><br>
                <label><input type="radio" name="q<?php echo $q['id']; ?>" value="c"> <?php echo $q['option_c']; ?></label><br>
                <label><input type="radio" name="q<?php echo $q['id']; ?>" value="d"> <?php echo $q['option_d']; ?></label>
            </div>
        <?php endwhile; ?>

        <button type="submit">Submit Exam</button>
    </form>
    <?php else: ?>
        <p>No questions available for this exam yet.</p>
    <?php endif; ?>

    <?php include 'footer.php'; ?>
</body>
</html>
