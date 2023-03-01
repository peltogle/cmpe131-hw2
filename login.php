<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
</head>

<body>
  <?php
  if (isset($_POST["username"]) && isset($_POST["password"])) {
    if ($_POST["username"] && $_POST["password"]) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $conn = mysqli_connect("localhost", "root", "", "users");
      // check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      // check if username exists
      $sql1 = "SELECT * FROM `users_table` WHERE `username` LIKE '$username'";
      $result1 = mysqli_query($conn, $sql1);
      if (mysqli_num_rows($result1) > 0) {
        $realPassword = mysqli_fetch_row($result1)[1];
        if ($realPassword == $password) {
          echo "<h1>Success! You are logged in!</h1>";
        } else {
          echo "<h1>Fail! You are not logged in!</h1>";
          echo "<br>";
          echo "<a href='../index.html'>Click me to try again.</a>";
        }
      } else {
        echo "<h1>This username does not exist!</h1>";
        echo "<br>";
        echo "<a href='../registration.html'>Click me to go to registration page.</a>";
      }
      // close connection
      mysqli_close($conn);
    } else {
      echo "<h1>Username or password is empty.</h1>";
      echo "<a href='../index.html'>Please try again.</a>";
    }
  } else {
    echo "Form was not submitted.";
  }
  ?>
</body>

</html>