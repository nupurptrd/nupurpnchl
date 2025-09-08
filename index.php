<?php session_start(); ?>
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Exam Portal - Home</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <section class="hero">
    <h2>Welcome to the Online Exam Portal of <span style="color: black;">Blind People's Association.</span></h2>
    <p >Conducting exams securely and efficiently for Brilliant <span style="color: black;">Visually Impaired students.</span></p>
  </section>

  <section class="container">
    <div class="card">
      <h3>Upcoming Exams</h3>
      <p>Check the schedule of upcoming exams.</p>
      <a href="exams.php">View Exams →</a>
    </div>
    <div class="card">
      <h3>Results</h3>
      <p>Access your exam results and performance reports.</p>
      <a href="results.php">Check Results →</a>
    </div>
    <div class="card">
      <h3>Guidelines</h3>
      <p>Read the exam guidelines before you appear.</p>
      <a href="guidelines.php">Read Guidelines →</a>
    </div><br>
    <div class="card">
      <h3>Attend exam </h3>
      <p>Give the exam as per guided by guidelines.</p>
      <a href="exam.php">Attend exam →</a>
    </div>
  </section>

  <?php include 'footer.php'; ?>
</body>
</html>
