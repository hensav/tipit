<?php

require("./class/employee.class.php");
include_once("header.php");
//two dummy values
$employeeId = 140;
$apikey = 123;

//Let's define some stuff that we want to get. You can use whichever variable name for the array that you want,
//as long as you pass it into the get function afterwards.

$gimme = array("name","description","goodcode","currP1","currP2","currP3","photo_url",);
$U = Employee::get($employeeId,$gimme,$apikey);
?>

<p>You can just use the public values that we requested about <?=$U->name?>,
    goodcode <?=$U->goodcode?>, in text. His description is as follows:</p>
<p>"<?=$U->description?>"</p>
<p>His current average score is <?=($U->currP1 + $U->currP2 + $U->currP3)/3?> and he looks something like this:</p>
<img src="http://naturaalmajand.us/tipit/uploads/<?=$U->photo_url?>"></img>
<p>Note how easy it becomes to build pages that only display information. No need for a million extra classes, in a million extra files. </p>
<?=$U->name?> promises to look into how to store information in an easy to understand manner, too.

<?php
include_once("footer.php");