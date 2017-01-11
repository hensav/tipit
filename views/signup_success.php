<?php require("header.php"); ?>

    <i class="icon-ok"> </i>


    <div class="welcome">

        <h1>Thank you!  You've successfully signed up.</h1>

        <p><a href="login.php">Log in</a></p>

    </div>
    </div>
    <script>
        setTimeout(function () {
            window.location.href= 'login.php'
        },3000);//5sec
    </script>

<?php require("footer.php"); ?>