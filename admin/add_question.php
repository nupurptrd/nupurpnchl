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
    $correct = $_POST['correct_option'];

    $sql = "INSERT INTO questions (exam_id, question, option_a, option_b, option_c, option_d, correct_option) 
            VALUES ($exam_id, '$question', '$a', '$b', '$c', '$d', '$correct')";
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
        <label for="question">Question:</label>
                    <textarea id="question" name="question" required aria-required="true" placeholder="Enter the question"></textarea>

                    <label for="option_a">Option A:</label>
                    <input type="text" id="option_a" name="option_a" required aria-required="true" placeholder="Enter first option">

                    <label for="option_b">Option B:</label>
                    <input type="text" id="option_b" name="option_b" required aria-required="true" placeholder="Enter second option">

                    <label for="option_c">Option C:</label>
                    <input type="text" id="option_c" name="option_c" required aria-required="true" placeholder="Enter third option">

                    <label for="option_d">Option D:</label>
                    <input type="text" id="option_d" name="option_d" required aria-required="true" placeholder="Enter fourth option">

                    <label for="correct_option">Correct Option:</label>
                    <select id="correct_option" name="correct_option" required aria-required="true">
                        <option value="" disabled selected>Select the correct option</option>
                        <option value="1">Option A</option>
                        <option value="2">Option B</option>
                        <option value="3">Option C</option>
                        <option value="4">Option D</option>
                    </select>

                    <label for="explanation">Explanation (Optional):</label>
                    <textarea id="explanation" name="explanation" aria-describedby="explanation-help" placeholder="Provide an explanation for the correct answer"></textarea>
                    <br><br>

                    <button type="submit" aria-label="Submit C language MCQ">Add MCQ</button>
                    <br><br>
                    <button type="button" style="background-color: #00ba16ff; color: white;" onclick="window.location.href='dashboard.php'"> Publish the Question paper</button>


    </form>
</body>
</html>
