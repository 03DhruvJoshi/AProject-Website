<?php

session_start();
require_once('connectdb.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

//FOREIGN KEY STUFF

//Foreign key prepare query, retrieves foreign key and prevents SQL injection
$stmt = $db->prepare('SELECT uid FROM users WHERE username = :uid');
$stmt->bindParam(':uid', $name);
$name = $username;
$stmt->execute();
$user_id = $stmt->fetchColumn();
$_SESSION['uid'] = $user_id;

//INSERT ADD PROJECTS 
#form submission consequences 
if (isset($_POST['submitted'])) {
    $title = isset($_POST['title']) ? $_POST['title'] : false;
    $startdate = isset($_POST['start_date']) ? $_POST['start_date'] : false;
    $enddate = isset($_POST['end_date']) ? $_POST['end_date'] : false;
    $phase = isset($_POST['phase']) ? $_POST['phase'] : false;
    $description = isset($_POST['description']) ? $_POST['description'] : false;

    try {
        #register user by inserting the user info 
        $stat = $db->prepare("INSERT INTO projects VALUES (default,?,?,?,?,?,?)");
        $stat->execute(array($title, $startdate, $enddate, $phase, $description, $user_id));
        echo "<p class='successbox'> Congratulations! You have added a new project! </p>";
    } catch (PDOException $ex) {
        echo "<p class='errorbox'>Failed to connect to the database.</p><br>";
        echo "<p class='errorbox'>Error details: <em>" . $ex->getMessage() . "</em></p>";
    }
}

// UPDATE PROJECT
if (isset($_POST['update'])) {
    $pid = isset($_POST['pid']) ? $_POST['pid'] : false;
    $title = isset($_POST['title']) ? $_POST['title'] : false;
    $startdate = isset($_POST['start_date']) ? $_POST['start_date'] : false;
    $enddate = isset($_POST['end_date']) ? $_POST['end_date'] : false;
    $phase = isset($_POST['phase']) ? $_POST['phase'] : false;
    $description = isset($_POST['description']) ? $_POST['description'] : false;

    try {
        $stmt = $db->prepare("UPDATE projects SET title=?, start_date=?, end_date=?, phase=?, description=? WHERE pid=? AND uid=?");
        $stmt->execute(array($title, $startdate, $enddate, $phase, $description, $pid, $user_id));
        echo "<p class='successbox'> Congratulations! You have updated the project with ID $pid! </p>";
    } catch (PDOException $ex) {
        echo "<p class='errorbox'>Failed to connect to the database.</p><br>";
        echo "<p class='errorbox'>Error details: <em>" . $ex->getMessage() . "</em></p>";
    }
} ?>

<?php
try {
    $query = "SELECT * FROM projects WHERE uid = $user_id";
    $rows = $db->query($query);

    if ($rows && $rows->rowCount() > 0) {
        ?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Dashboard</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
            <link rel="stylesheet" type="text/css" href="css/style2.css" />
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
                        <li><a href="register.php">Log Out</a></li>
                    </ul>
                </nav>
            </header>

            <div id='dash'>
                <?php
                echo "<div id='dash'>";
                echo "<h2> Welcome " . $_SESSION['username'] . "! </h2>";
                echo "</div>";
                ?>

                <nav>
                    <ul>
                        <li><a href="#project-list">View Projects</a></li>
                        <li><a href="#addproject">Add Project</a></li>
                        <li><a href="#updateproject">Update Project</a></li>
                        <li><a href="#logout">Log Out</a></li>
                    </ul>
                </nav>

            </div>


            <!-----------------------------
        project LIST
-------------------------------->

            <section id="project-list">
                <h1>
                    Your Projects
                </h1>
                <?php

                while ($row = $rows->fetch()) {
                    echo "<div class='project'> <h2>" . $row['title'] . "</h2>";
                    echo "<p><strong> Project ID: " . $row['pid'] . "</strong></p>";
                    echo "<p> Start Date: " . $row['start_date'] . "</p>";
                    echo "<p> Phase: " . $row['phase'] . "</p><br>";
                    echo "<button class='viewbutton'><p><a href='projectdetails.php?pid=" . $row['pid'] . "'>View Project</a></p></button>";
                    echo "</div>";
                }

    }
} catch (PDOexception $ex) {
    echo "<p class='errorbox'>Failed to connect to the database.</p><br>";
    echo "<p class='errorbox'>Error details: <em>" . $ex->getMessage() . "</em></p>";
}
?>

        <!-----------------------------
       INSERT PROJECT FORM
        -------------------------------->
        <div id="addproject">
            <h1> Add a New Project </h1>

            <form method="post" action="dashboard.php">
                <p>
                    Project Title: <input type="text" name="title" required />
                </p>
                <p>
                    Start Date: <input type="date" id="start_date" name="start_date" pattern="\d{4}-\d{2}-\d{2}"
                        required />
                </p>
                <p>
                    End Date: <input type="date" id="end_date" name="end_date" pattern="\d{4}-\d{2}-\d{2}" required />
                </p>
                Phase:
                <select id="phase" name="phase" required>
                    <option value="">--Select an option--</option>
                    <option value="design">Design</option>
                    <option value="development">Development</option>
                    <option value="testing">Testing</option>
                    <option value="deployment">Deployment</option>
                    <option value="complete">Complete</option>
                </select>
                </p>
                <p>
                    Description: <textarea id="description" name="description" rows="5" cols="40" required> </textarea>
                </p>

                <input type="submit" value="Create Project" /> <br><br>
                <input type="hidden" name="submitted" value="true" />

            </form>

        </div>

        <!-----------------------------
UPDATE PROJECT FORM
-------------------------------->
        <div id="updateproject">
            <h1> Update Existing Project </h1>

            <form method="post" action="dashboard.php">
                <p>
                    Project ID: <input type="number" name="pid" required />
                </p>
                <p> NOTE: You can only update the project with Project ID that is assigned to your projects exclusively.
                    To check the Project ID of the project you wish to update, go to 'Your Projects' section, the
                    Project ID
                    will be diplayed under the title.
                <p>
                    Project Title: <input type="text" name="title" required />
                </p>
                <p>
                    Start Date: <input type="date" id="start_date" name="start_date" pattern="\d{4}-\d{2}-\d{2}"
                        required />
                </p>
                <p>
                    End Date: <input type="date" id="end_date" name="end_date" pattern="\d{4}-\d{2}-\d{2}" required />
                </p>
                <p>
                    Phase:
                    <select id="phase" name="phase" required>
                        <option value="">--Select an option--</option>
                        <option value="design">Design</option>
                        <option value="development">Development</option>
                        <option value="testing">Testing</option>
                        <option value="deployment">Deployment</option>
                        <option value="complete">Complete</option>
                    </select>
                </p>
                <p>
                    Description: <textarea id="description" name="description" rows="5" cols="40" required> </textarea>
                </p>

                <input type="submit" value="Update Project" /> <br><br>
                <input type="hidden" name="update" value="true" />

            </form>
        </div>

        <div id="logout">
            <style>
                #logout {
                    font-family: Arial, sans-serif;
                    font-size: x-large;
                    text-align: center;
                    background-color: rgb(245, 227, 207);
                }
            </style>
            <p>Would like to log out? <button><a href="logout.php">Log out</a></button> </p>
        </div>

</body>

</html>