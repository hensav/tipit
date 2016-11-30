<?php
$url = "http://http://naturaalmajand.us/tipit/api/request.php/";

require("./class/clientAuth.class.php");

$clientAuth = new clientAuth;
$user = "veljo@naturaalmajand.us";
$pass = "parool";
$result = $clientAuth -> loginRequest($url,$user,$pass);
var_dump($result);

//login errorid
$loginEmailError ="";

if (isset ($_POST["loginEmail"])) {

    //on olemas
    // kas epost on tühi
    if (empty ($_POST["loginEmail"])) {

        // on tühi
        $loginEmailError = "Palun sisesta Email";

    } else {
        // email on olemas ja õige
        $loginEmail = $_POST["loginEmail"];

    }
}




$loginPasswordError ="";

if (isset ($_POST["loginPassword"])) {

    //on olemas
    // kas epost on tühi
    if (empty ($_POST["loginPassword"])) {

        // on tühi
        $loginPasswordError = "Palun sisesta parool";

    } else {
        // email on olemas ja õige
        $loginPassword = $_POST["loginPassword"];

    }
}




?>


<html>
<body>

<form method="POST" >

    <input name="loginEmail" type="email" placeholder="Email">




    <input name="loginPassword" placeholder="Parool" type="password">



    <input type="submit" value="Logi sisse">


</body>
</html>