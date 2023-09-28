<?php

//if the form has been submitted

//CROSS SITE REQUEST FORGERY PREVENTION
session_start();
if (!isset($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submitted'])) {
	//CROSS SITE REQUEST FORGERY PREVENTION
	if (!isset($_POST['username'], $_POST['password'], $_POST['csrf_token'])) {
		exit('Please fill in the username, password, and CSRF token fields!');
	}
	if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
		exit('Invalid CSRF token!');
	}


	require_once("connectdb.php");
	try {
		$stat = $db->prepare('SELECT password FROM users WHERE username = ?');
		$stat->execute(array($_POST['username']));

		if ($stat->rowCount() > 0) {
			$row = $stat->fetch();

			if (password_verify($_POST['password'], $row['password'])) {
				session_start();
				$_SESSION["username"] = $_POST['username'];
				header("Location:dashboard.php");
				exit();
			} else {
				echo "<p class='errorbox'>Error logging in, password does not match </p>";
			}
		} else {

			echo "<p class='errorbox'>Error logging in, Username not found </p>";
		}
	} catch (PDOException $ex) {
		echo ("<p class='errorbox'>Failed to connect to the database.</p><br>");
		echo ($ex->getMessage());
		exit;
	}

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Log In</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>


	<!-----------------------------
		Main Header
-------------------------------->

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

		<h2>AProject Log In</h2>
		<form method="post" action="login.php">
			<p>
				Username: <input type="text" name="username" required />
			</p>
			<p>
				Password: <input type="password" name="password" required />
			</p>

			<input type="submit" value="Log In" /> <br><br>
			<input type="hidden" name="submitted" value="true" />
			<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
		</form>

		<p> Thinking of creating an account? <a href="register.php"> Register </a> </p>

	</div>

</body>

</html>