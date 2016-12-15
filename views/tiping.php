<?php require("header.php"); ?>


    <div class="employee">
        <form method="POST" class="employee__auth">
            <input type="text" placeholder="The good code" name="goodCode" class="form__field txt-center">
            <h2>Mariann</h2>
            <input type="submit" value="let's go!" class="form__button" onclick="move()">
        </form>
        <div class="w3-container progress-bar">
            <div class="w3-progress-container">
                <div id="myBar" class="w3-progressbar w3-green" style="width:25%"></div>
            </div>
        </div>
    </div>

</div>


<?php require("footer.php"); ?>