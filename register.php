<?php
session_start();
include 'config.php';

if (isset($_POST['register'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = md5($_POST['password']);
    $centre   = $_POST['centre'];
    $role     = "student";

    $sql = "INSERT INTO students (name, email, password, centre, role) 
            VALUES ('$name', '$email', '$password', '$centre', '$role')";

    if ($conn->query($sql) === TRUE) {
<<<<<<< HEAD
        echo "<p aria-live='assertive'  style='color:green;'>Student registered successfully! You can now login.</p>";
        echo "<script>
                setTimeout(function(){ window.location.href='/login.php'; }, 2000);
              </script>";
    } else {
        echo "<p aria-live='assertive' style='color:red;'>Error: " . $conn->error . "</p>";
    }
}
=======
      echo "<p style='color:green;'>Student registered successfully! Redirecting to login...</p>";
      header("Refresh:2; url=login.php");  // waits 2 sec then goes
      exit;
    } else {
      echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }}
>>>>>>> 348612bb4e8a914b587df9062d158fcce5239504
?>
<!DOCTYPE html>
<html>
<head>
  <title>Student Registration</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h2>Student Registration</h2>
  <form method="post">
    <label for="name" >Name:</label>
    <input type="text"id="name"  name="name" required><br>
    <label for="email" >Email:</label>
    <input type="email" id ="email" name="email" required><br>
    <label for="password" >Password:</label>
    <input type="password" id ="password"name="password" required><br>
    <label for ="centre" >Login Centre:</label><br>
  <select id = "centre" name="centre" required>
    <option value="Ahmedabad">Ahmedabad</option>
    <option value="Shaila">Shaila</option>
    <option value="Kapadwanj">Kapadwanj</option>
    <option value="Valsad">Valsad</option>
    <option value="Disha">Disha</option>
    <option value="Other">Other</option>
  </select>
    <button type="submit" name="register">Register</button>
  </form>
</body>
</html>
