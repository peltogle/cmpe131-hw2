<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
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
      // check if username already exists
      $sql1 = "SELECT * FROM `users_table` WHERE `username` LIKE '$username'";
      $result1 = mysqli_query($conn, $sql1);
      if (mysqli_num_rows($result1) > 0) {
        echo "<h1>This username is taken already!</h1>";
        echo "<br>";
        echo "<a href='../registration.html'>Please try again.</a>";
      } else {
        // register user
        $sql2 = "INSERT INTO users_table (username, password) VALUES ('$username', '$password')";
        $results2 = mysqli_query($conn, $sql2);
        if ($results2) {
          echo "<h1>Registration successful!</h1>";
          echo "The user has been added.";
          echo "<br>";
          echo "<br>";
          echo "Username from registration: " . $_POST["username"];
          echo "<br>";
          echo "<br>";
          echo "Password from registration: " . $_POST["password"];
          echo "<br>";
          echo "<br>";
          echo "<a href='../index.html'>Click me to go to sign in page</a>";
        } else {
          echo "<h1>Registration failed!</h1>";
          echo mysqli_error($conn);
          echo "<br>";
          echo "<a href='../registration.html'>Please try again.</a>";
        }
      }
      // close connection
      mysqli_close($conn);
    } else {
      echo "<h1>Username or password is empty.</h1>";
      echo "<a href='../registration.html'>Please try again.</a>";
    }
  } else {
    echo "Form was not submitted.";
  }
  ?>
</body>

</html>