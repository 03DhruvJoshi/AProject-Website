<?php

require_once('connectdb.php');
try {
    $query = "SELECT  * FROM  projects ";
    $rows = $db->query($query);


    if ($rows && $rows->rowCount() > 0) {

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>AProject project List</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
            <link rel="stylesheet" type="text/css" href="css/style.css" />
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

            <section id="project-list">
                <h1>
                    Project List
                </h1>

                <!-----------------------------
Search query + project List
-------------------------------->

                <div class="search-form">
                    <form method="POST" action="projectlist.php">
                        <label for="search_query">Search Projects by title or start date:</label>
                        <input type="text" id="search_query" name="search_query" placeholder="Enter a project title...">
                        <input type="submit" value="Search">
                        <input type="hidden" name="submitted" value="true">
                    </form>
                </div>


                <?php
                if (isset($_POST['submitted'])) {
                    try {
                        $search_query = $_POST['search_query'];
                        $stmt = $db->prepare("SELECT * FROM projects WHERE title LIKE CONCAT('%', :search_query, '%') OR start_date LIKE CONCAT('%', :search_query, '%')");
                        $stmt->bindParam(':search_query', $search_query, PDO::PARAM_STR);
                        $stmt->execute();

                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (count($result) > 0) {
                            foreach ($result as $row) {
                                echo "Here are your results: ";
                                echo "<div class='project'> <h2>" . $row['title'] . "</h2>";
                                echo "<p> Start Date: " . $row['start_date'] . "</p>";
                                echo "<p> Phase: " . $row['phase'] . "</p><br>";
                                echo "<button class='viewbutton'><p><a href='projectdetails.php?pid=" . $row['pid'] . "'>View Project</a></p></button>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='errorbox'>No results found.</p>";
                        }
                    } catch (PDOException $e) {
                        echo "<p class='errorbox'>Failed to connect to the database.</p><br>";
                        echo "<p class='errorbox'>Error details: <em>" . $ex->getMessage() . "</em></p>";
                    }
                } else {
                    while ($row = $rows->fetch()) {
                        echo "<div class='project'> <h2>" . $row['title'] . "</h2>";
                        echo "<p> Start Date: " . $row['start_date'] . "</p>";
                        echo "<p> Phase: " . $row['phase'] . "</p><br>";
                        echo "<button class='viewbutton'><p><a href='projectdetails.php?pid=" . $row['pid'] . "'>View Project</a></p></button>";
                        echo "</div>";
                    }
                }
    }
} catch (PDOexception $ex) {
    echo "<p class='errorbox'>Failed to connect to the database.</p><br>";
    echo "<p class='errorbox'>Error details: <em>" . $ex->getMessage() . "</em></p>";
}
?>
    </section>
</body>

</html>