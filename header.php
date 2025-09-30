<header>
  
  <nav>
    <div class="logo">
      <img src="assets/logo.png" alt="Student Portal" height="80" class="logo">
      <img src="assets/logo2.png" alt="Student Portal" height="80" class="logo">
      <h1 class="site-title">Exam Portal</h1>
    </div>
    <a href="index.php">Home</a>
    <a href="exams.php">Exams</a>
    <a href="results.php">Results</a>
    <a href="guidelines.php">Guidelines</a>
    <a href="about.php">Contact</a>
    <?php if(isset($_SESSION['student'])): ?>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="login.php">Login</a>
    <?php endif; ?>
  </nav>
</header>
