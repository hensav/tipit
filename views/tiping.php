<?php require("header.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>tipit dirty</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./main.css">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,900" rel="stylesheet">
</head>
<body>

<div class="wrapper">
    <div class="employee">
        <form method="POST" class="employee__auth">
            <input type="text" placeholder="The good code" name="goodCode" class="form__field txt-center">

            <h2>Mariann</h2>

            <div class="w3-container progress-bar">
                <div class="w3-progress-container">
                    <div id="myBar" class="w3-progressbar w3-green" style="width:25%"></div>
                </div>
                <br>
                <a href="feedback.php"><input type="submit" value="let's go!" class="form__button inactive--button w3-btn" onclick="move()"></a>
            </div>
        </form>
    </div>

</div>
<script src="js/progressbar.js"></script>
</body>
</html>