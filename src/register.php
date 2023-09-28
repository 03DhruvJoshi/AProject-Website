<?php
//if the form has been submitted


//user cannot register when logged in, he/she/they have to log out in order to register
session_start();
if (isset($_SESSION['username'])) {
  header("Location: logout.php");
  exit();
}


if (isset($_POST['submitted'])) {

  require_once('connectdb.php');

  $username = isset($_POST['username']) ? $_POST['username'] : false;
  $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : false;
  $email = isset($_POST['email']) ? $_POST['email'] : false;

  if (!($username)) {
    echo "Username wrong!";
    exit;
  }
  if (!($password)) {
    exit("password wrong!");
  }
  if (!($email)) {
    exit("email wrong!");
  }

  try {
    $stat = $db->prepare("insert into users values(default,?,?,?)");
    $stat->execute(array($username, $password, $email));

    $uid = $db->lastInsertId();
    echo "<p class='successbox'>Congratulations! You are now registered. Your ID is: $uid  </p>";

  } catch (PDOexception $ex) {
    echo "<p class='errorbox'>Failed to connect to the database.</p><br>";
    echo "<p class='errorbox'>Error details: <em>" . $ex->getMessage() . "</em></p>";
  }


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AProject Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>

  <header id="main-header">
    <div id="logo">
      <img src="img/Topleft-logo.png" alt="TopLeft Logo" style="width: 40%; height: auto" />
    </div>

    <nav class="navigation-container">
      <ul class="navigation">
        <li><a href="projectlist.php">Home</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="login.php">Log In</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>
    </nav>
  </header>



  <div class="login">
    <h2> Register </h2>
    <form method="post" action="register.php">
      <p> Username: <input type="text" name="username" required /> </p>
      <p>Email: <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required /></p>
      <p> Password: <input type="password" name="password" required
          pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
          title="Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number." />
      </p>

      <input type="submit" value="Register" /> <br><br>
      <input type="hidden" name="submitted" value="true" />
    </form>


    <p> Already a user? <a href="login.php"> Log In </a> </p>
  </div>
</body>

</html>