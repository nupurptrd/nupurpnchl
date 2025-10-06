<?php
session_start();
include '../config.php';
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exam_id = $_POST['exam_id'];
    $question = $_POST['question'];
    $a = $_POST['option_a'];
    $b = $_POST['option_b'];
    $c = $_POST['option_c'];
    $d = $_POST['option_d'];
    $correct = $_POST['correct'];

    $sql = "INSERT INTO questions (exam_id, question, option_a, option_b, option_c, option_d, correct_option) 
            VALUES ($exam_id, '$question', '$a', '$b', '$c', '$c', '$correct')";
    if ($conn->query($sql)) {
        $msg = "Question added successfully!";
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Question</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Add Question</h2>
    <?php if(isset($msg)) echo "<p aria-live='assertive' >$msg</p>"; ?>
    <form method="post">
        <label for ="exam" >Exam:</label>
        <select id ="exam" name="exam_id">
            <?php
            $res = $conn->query("SELECT * FROM exams");
            while($row = $res->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['title']}</option>";
            }
            ?>
        </select><br>
        <label for="question" >Question:</label>
        <textarea id = "question" name="question" required></textarea><br>
        <label for = "a" >Option A:</label>
        <input type="text" id = "a" name="option_a" required><br>
        <label for ="b" >Option B:</label>
        <input type="text" id ="b" name="option_b" required><br>
        <label for ="c" >Option C:</label>
        <input type="text" id = "c" name="option_c" required><br>
        <label for = "d" >Option D:</label>
        <input type="text" id ="d" name="option_d" required><br>
        <label for = "correct" >Correct Answer:</label>
        <select id = "correct" name="correct">
            <option value="a">Option A</option>
            <option value="b">Option B</option>
            <option value="c">Option C</option>
            <option value="d">Option D</option>
        </select><br>
        <button type="submit">Add Question</button>
    </form>
     <!-- ✅ Done Button -->
    <br>
    <form action="dashboard.php" method="get">
        <button type="submit">Done</button>
    </form>
</body>
</html>
