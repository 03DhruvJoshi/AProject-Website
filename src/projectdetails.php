<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Project Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/style2.css" />
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

    <?php

    require_once("connectdb.php");


    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
        $query = "SELECT * FROM projects WHERE pid=?";
        $stmt = $db->prepare($query);
        $stmt->execute([$pid]);
        $project = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$project) {

            echo "<p class='errorbox'>\n" . " Project not found</p>";

            exit;
        }
    } else {
        echo "<p class='errorbox'>Invalid project ID</p>";
        exit;
    }

    $uquery = "SELECT * FROM users WHERE uid=?";
    $ustmt = $db->prepare($uquery);
    $ustmt->execute([$project['uid']]);
    $urow = $ustmt->fetch(PDO::FETCH_ASSOC);

    ?>

    <div class="prodesc">
        <h1>
            <?php echo $project['title']; ?>
        </h1>
        <p><strong>Start date:</strong>
            <?php echo $project['start_date']; ?>
        </p>
        <p><strong>End date:</strong>
            <?php echo $project['end_date']; ?>
        </p>
        <p><strong>Phase:</strong>
            <?php echo $project['phase']; ?>
        </p>
        <p><strong>Description:</strong>
            <?php echo $project['description']; ?>
        </p>
        <p><strong>Email:</strong>
            <?php echo $urow['email'];
            ; ?>
        </p>
    </div>


    <div class="userprodesc">
        <h3>
            User Details
        </h3>
        <p><strong>Username:</strong>
            <?php echo $urow['username']; ?>
        </p>
        <p><strong>Email:</strong>
            <?php echo $urow['email']; ?>
        </p>
    </div>

    <div class="viewback">

        <a href="projectlist.php"><button> Back to view projects </button></a>
        <style>
            .viewback {
                font-family: Arial, sans-serif;
                font-size: x-large;
                align-items: center;
                align-content: center;
                text-align: center;
                padding: 20px 50px;
                margin: 20px;
                background-color: rgb(245, 227, 207);
            }
        </style>
    </div>
</body>

</html>