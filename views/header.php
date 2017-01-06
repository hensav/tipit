<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,900" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous">
    </script>
</head>

<body>
<div class="wrapper logo">
    <div class="header-bar">
        <h6><span class="logo-text"><a href="index.php">Tip!it </a></span>
<?php
    if(isset($_SESSION['userRole'])){
        echo("
            <span class='logout'><a href='logout.php'>Log out</a></span>
        ");
    }

?>
        </h6>
    </div>
