<?php

session_start();
session_destroy();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log Out</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
</head>

<body>


    <!-----------------------------
        Main Header
-------------------------------->

    <body>
        <style>
            #logoutpage {
                font-family: Arial, sans-serif;
                align-items: center;
                align-content: center;
                text-align: center;
                padding: 20px 50px;
                margin: 20px;
                background-color: rgb(245, 227, 207);
            }
        </style>
        <div id='logoutpage'>
            <H2> Logged out now! </H2>

            <p>Would like to create an account? <a href="register.php">Register</a> </p>

            <p>Would like to log in again? <a href="login.php">Log in</a> </p>
        </div>
    </body>

</html>