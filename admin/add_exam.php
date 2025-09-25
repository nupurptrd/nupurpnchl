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
    <?php if(isset($msg)) echo "<p>$msg</p>"; ?>
    <!-- Add Exam Form -->
        <div class="container-fluid">
            <div class="form-container">
                <?php if(isset($msg)) echo "<p class='message'>" . htmlspecialchars($msg) . "</p>"; ?>
                <form method="post">
                    <label for="title">Exam Title:</label>
                    <input type="text" id="title" name="title" required aria-required="true">

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" aria-describedby="description-help"></textarea>
                    <small id="description-help" class="form-text text-muted">Optional: Provide a brief description of the exam.</small>

                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required aria-required="true">

                    <button type="submit" aria-label="Submit exam details">Add Exam</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
