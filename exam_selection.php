<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

// When starting a new exam, reset the timer
$_SESSION['exam_start'][$exam_id] = time();
header("Location: exam.php?id=$exam_id&qno=1");
exit;

// Fetch all exams
$exams = $conn->query("SELECT * FROM exams ORDER BY date ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Exams</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f9fc;
            padding: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .exam-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .exam-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
        }
        .exam-card h3 {
            margin: 0 0 10px;
            color: #0056b3;
        }
        .exam-card p {
            margin: 5px 0;
            color: #555;
        }
        .start-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 14px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .start-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <h2>📅 Upcoming Exams</h2>

    <?php if ($exams->num_rows > 0): ?>
        <div class="exam-list">
            <?php while ($exam = $exams->fetch_assoc()): ?>
                <div class="exam-card">
                    <h3><?php echo htmlspecialchars($exam['title']); ?></h3>
                    <p><strong>Date:</strong> <?php echo $exam['date']; ?></p>
                    <p><strong>Duration:</strong> <?php echo $exam['duration']; ?> mins</p>
                    <p><?php echo htmlspecialchars($exam['description']); ?></p>
                    <a class="start-btn" href="exam.php?id=<?php echo $exam['id']; ?>&qno=1">Start Exam</a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No upcoming exams found.</p>
    <?php endif; ?>

    <?php include 'footer.php'; ?>
</body>
</html>
