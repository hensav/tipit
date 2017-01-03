<?php
//dummydata
$companyName="Lendav Taldrik";
$companyImgUrl="http://www.northestonia.eu/sites/default/files/styles/large/public/visitestonia_pics/d0b4f1cdca0e3e3aadc1bf3eab9029ba.jpg?itok=4PnXFqtH";
$companyDescription="Me ei ole tüüpiline Aasia restoran. Tule ja vaata, milles kogu kära!"
?>

<?php require("header.php"); ?>
    <div class="employee">
        <h2><?php echo $companyName; ?></h2>
    </div>
    <img src=<?=$companyImgUrl?> class="employee-image">
    <?php echo $companyDescription; ?>




<?php require("footer.php"); ?>