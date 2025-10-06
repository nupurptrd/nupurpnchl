<?php
session_start();
include '../config.php';
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['date'];

    $sql = "INSERT INTO exams (title, description, date) VALUES ('$title', '$desc', '$date')";
    if ($conn->query($sql)) {
        $msg = "Exam added successfully!";
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Exam</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Add Exam</h2>
    <?php if(isset($msg)) echo "<p aria-live='assertive' >$msg</p>"; ?>
    <form method="post">
        <label for='title' >Exam Title:</label>
        <input type="text" id ="title" name="title" required><br>
        <label for ="dis" >Description:</label>
        <textarea id ="dis" name="description"></textarea><br>
        <label for ="date" >Date:</label>
        <input type="date" id = "date" name="date" required><br>
        <button type="submit">Add Exam</button>
    </form>
</body>
</html>
