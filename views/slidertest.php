<?php
    require('class/sliderBar.class.php');
?>

<html>
<head>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,900" rel="stylesheet">
    <?php
        $sliderDummy = array(
            "previous"=>30,
            "current"=>25,
            "name"=>"Punctual"
        );
        $sliderDummy2 = array(
            "previous"=>50,
            "current"=>73,
            "name"=>"Helpful"
        );
    ?>
    <link rel="stylesheet" href='css/feedback.css'>

</head>
<body>
    <?php $punctualSlider = new sliderBar($sliderDummy);
            $punctualSlider->displaySlider();
            $helpfulSlider = new sliderBar($sliderDummy2);
            $helpfulSlider->displaySlider();
    ?>
</body>
</html>
