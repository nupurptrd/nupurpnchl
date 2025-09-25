<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
// Check if the user is logged in as admin
if (!isset($_SESSION['admin']) || !isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    echo "<h3 style='color:red;'>Access Denied. Please <a href='../admin/login.php'>login</a> as admin.</h3>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Exam System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffffff; /* White background for entire page */
            color: #000000; /* Black text for contrast */
        }
        .sidebar {
            min-height: 100vh;
            background-color: #ffffff; /* White sidebar background */
            padding-top: 20px;
            position: fixed;
            width: 250px;
            transition: width 0.3s ease;
            border-right: 1px solid #000000; /* Black border for separation */
        }
        .sidebar h4 {
            color: #000000; /* Black text for "Exam System" */
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: #ffffff; /* White text for links */
            background-color: #007bff; /* Blue background for links */
            padding: 15px 20px;
            display: block;
            text-decoration: none;
            font-size: 1.1rem;
            margin: 5px 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .sidebar .nav-icon {
            margin-right: 10px;
            color: #ffffff; /* White icons for contrast on blue background */
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #ffffff; /* White main content background */
        }
        .header {
            background-color: #007bff; /* Blue header */
            color: #ffffff; /* White text */
            padding: 15px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .header h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        .role-section {
            background-color: #ffffff; /* White background */
            border: 1px solid #000000; /* Black border */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .role-section h3 {
            color: #007bff; /* Blue heading */
            font-size: 1.4rem;
            margin-bottom: 15px;
        }
        .role-section p {
            color: #333333; /* Dark gray for text */
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .role-section ul {
            list-style-type: none;
            padding-left: 0;
        }
        .role-section li {
            padding: 10px 0;
            font-size: 1.1rem;
            color: #000000; /* Black text */
        }
        .role-section li i {
            color: #007bff; /* Blue icons */
            margin-right: 10px;
        }
        .role-section .encouragement {
            font-style: italic;
            color: #007bff; /* Blue for emphasis */
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                border-right: none;
                border-bottom: 1px solid #000000; /* Black border for mobile */
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Exam System</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="add_exam.php" class="nav-link" aria-label="Add a new exam">
                    <i class="fas fa-plus-circle nav-icon"></i>Add Exam
                </a>
            </li>
            <li class="nav-item">
                <a href="add_question.php" class="nav-link" aria-label="Add questions to an exam">
                    <i class="fas fa-question-circle nav-icon"></i>Add Questions
                </a>
            </li>
            <li class="nav-item">
                <a href="view_results.php" class="nav-link" aria-label="View student results">
                    <i class="fas fa-chart-bar nav-icon"></i>View Student Results
                </a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link" aria-label="Log out of the system">
                    <i class="fas fa-sign-out-alt nav-icon"></i>Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?>!</h2>
        </div>

        <!-- Admin Roles and Tasks -->
        <div class="container-fluid">
            <div class="role-section">
                <h3>Your Role as an Admin</h3>
                <p>As an administrator of the Exam System, you are the backbone of this educational platform, ensuring a seamless and effective experience for students and educators alike. Your expertise and dedication empower you to shape the learning journey, foster academic excellence, and drive success. Below are the key responsibilities and tasks you can perform to make a lasting impact.</p>
                <ul>
                    <li><i class="fas fa-plus-circle"></i><strong>Create and Manage Exams:</strong> Design and configure exams to challenge and assess student knowledge, tailoring content to meet educational goals.</li>
                    <li><i class="fas fa-question-circle"></i><strong>Craft Engaging Questions:</strong> Develop diverse and thought-provoking questions to enhance learning outcomes and ensure fair evaluations.</li>
                    <li><i class="fas fa-chart-bar"></i><strong>Monitor Student Performance:</strong> Analyze exam results to gain insights into student progress, identify strengths, and support areas for improvement.</li>
                    <li><i class="fas fa-cog"></i><strong>Maintain System Integrity:</strong> Oversee the platform’s functionality, ensuring a secure and reliable environment for all users.</li>
                </ul>
                <p class="encouragement">You are making a difference! Your role is pivotal in creating an environment where students can thrive. Embrace your responsibilities with confidence, and know that your efforts are shaping the future of education.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (for interactive components, if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
