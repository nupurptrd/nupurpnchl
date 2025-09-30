<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['student'];
$exam_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$qno = isset($_GET['qno']) ? intval($_GET['qno']) : 1;


if ($exam_id == 0) {
    die("Invalid Exam ID.");
}

//$duration = $exam['duration']; // in minutes

// Fetch exam details
$exam = $conn->query("SELECT * FROM exams WHERE id=$exam_id")->fetch_assoc();
if (!$exam) {
    die("Exam not found.");
}
//remove the multiplecation
 $duration = intval($exam['duration']); // in minutes

// ✅ Save exam start time in session (first load only)
if (!isset($_SESSION['exam_start'][$exam_id])) {
    $_SESSION['exam_start'][$exam_id] = time();
}
$exam_start_time = $_SESSION['exam_start'][$exam_id];

// Calculate remaining time
$exam_duration = $exam['duration'] * 60; // 30 minutes in seconds (or from DB: $exam['duration'] * 60)
$elapsed = time() - $exam_start_time;
$remaining_seconds = max(0, $exam_duration - $elapsed);

echo "<pre>";
echo "Exam Duration: $exam_duration seconds\n";
echo "Elapsed: $elapsed seconds\n";
echo "Remaining: $remaining_seconds seconds\n";
echo "</pre>";

// Count total questions
$total_questions = $conn->query("SELECT COUNT(*) AS cnt FROM questions WHERE exam_id=$exam_id")->fetch_assoc()['cnt'];

// ✅ If qno is greater than total, end the exam
if ($qno > $total_questions) {
    header("Location: submit_exam.php");
    exit;
}
// Fetch current question
$offset = $qno - 1;
$question = $conn->query("SELECT * FROM questions WHERE exam_id=$exam_id LIMIT $offset,1")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($exam['title']); ?> - Exam</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h2><?php echo htmlspecialchars($exam['title']); ?></h2>
<p><?php echo htmlspecialchars($exam['description']); ?> | Date: <?php echo $exam['date']; ?></p>
<div id="timerBox">
    <strong>Time Remaining: <span id="timer"></span></strong>
</div>

<?php if ($question): ?>
    <form method="post" action="save_answer.php" id="examForm">
        <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
        <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
        <input type="hidden" name="qno" value="<?php echo $qno; ?>">

        <p><strong>Q<?php echo $qno; ?>. <?php echo htmlspecialchars($question['question']); ?></strong></p>

        <label><input type="radio" name="answer" value="1"> <?php echo htmlspecialchars($question['option_a']); ?></label><br>
        <label><input type="radio" name="answer" value="2"> <?php echo htmlspecialchars($question['option_b']); ?></label><br>
        <label><input type="radio" name="answer" value="3"> <?php echo htmlspecialchars($question['option_c']); ?></label><br>
        <label><input type="radio" name="answer" value="4"> <?php echo htmlspecialchars($question['option_d']); ?></label><br><br>

        <?php if ($qno < $total_questions): ?>
            <button type="submit">Next Question</button>
        <?php else: ?>
            <button type="submit" formaction="submit_exam.php">Finish Exam</button>
        <?php endif; ?>
    </form>
<?php else: ?>
    <p>No questions available for this exam.</p>
<?php endif; ?>

<!-- Timer Script -->
<script>
let durationMinutes = <?php echo $duration; ?>; // remaining time in seconds
//alert(duration );
let startTime = <?php echo $_SESSION['exam_start'][$exam_id]; ?>; // remaining time in seconds
// alert(startTime);
 let timerDisplay = document.getElementById("timer");
// Convert duration to seconds
let durationSeconds = durationMinutes * 60;

// Compute when the countdown should end
let endTime = startTime + durationSeconds;

// Update function
function updateTimer() {
    let now = Math.floor(Date.now() / 1000); // current UNIX time in seconds
    let remaining = endTime - now;

    if (remaining <= 0) {
        document.getElementById("timer").textContent = "00:00";
        alert("Time is up!");
        clearInterval(timerInterval);
        return;
    }

    let minutes = Math.floor(remaining / 60);
    let seconds = remaining % 60;

    // Format mm:ss
    let formatted = 
        String(minutes).padStart(2, '0') + ":" + 
        String(seconds).padStart(2, '0');

    document.getElementById("timer").textContent = formatted;
}

// Run immediately and then every second
updateTimer();
let timerInterval = setInterval(updateTimer, 1000);
// let warned = false;

// function startTimer() {
//     let countdown = setInterval(function() {
//         let minutes = Math.floor(duration / 60);
//         let seconds = duration % 60;

//         minutes = minutes < 10 ? "0" + minutes : minutes;
//         seconds = seconds < 10 ? "0" + seconds : seconds;

//         timerDisplay.textContent = minutes + ":" + seconds;

//         // ⚠ Show warning ONLY once when exactly 10 minutes left
//         if (!warned && duration === 600) {
//             alert("⚠ Only 10 minutes remaining!");
//             warned = true;
//         }

//         /*if (duration < 0) {
//             clearInterval(countdown);
//             alert("⏳ Time is up! Submitting exam...");
//             document.getElementById("examForm").submit();
//         }*/
//         duration--;//decrement after updating display
//     }, 1000);
// }

//window.onload = startTimer;
// ⚠ Show warning ONLY once when exactly 10 minutes left
         if (!warned && duration === 600) {
             alert("⚠ Only 10 minutes remaining!");
             warned = true;
         }

         if (duration < 0) {
             clearInterval(countdown);
             alert("⏳ Time is up! Submitting exam...");
             document.getElementById("examForm").submit();
         }
</script>
</body>
</html>