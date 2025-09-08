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
    $correct = $_POST['correct'];

    $sql = "INSERT INTO questions (exam_id, question, option_a, option_b, option_c, correct_option) 
            VALUES ($exam_id, '$question', '$a', '$b', '$c', '$correct')";
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
    <?php if(isset($msg)) echo "<p>$msg</p>"; ?>
    <form method="post">
        <label>Exam:</label>
        <select name="exam_id">
            <?php
            $res = $conn->query("SELECT * FROM exams");
            while($row = $res->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['title']}</option>";
            }
            ?>
        </select><br>
        <label>Question:</label>
        <textarea name="question" required></textarea><br>
        <label>Option A:</label>
        <input type="text" name="option_a" required><br>
        <label>Option B:</label>
        <input type="text" name="option_b" required><br>
        <label>Option C:</label>
        <input type="text" name="option_c" required><br>
        <label>Correct Answer:</label>
        <select name="correct">
            <option value="a">Option A</option>
            <option value="b">Option B</option>
            <option value="c">Option C</option>
        </select><br>
        <button type="submit">Add Question</button>
    </form>
</body>
</html>
