<?php
    require("model/admin/numberOfActiveUsers.php");
    require("model/admin/numberOfRegistredUsers.php");
?>

    <div class="container">
        <div class="row mt-2">
            <div class="col-lg-12" id="tableErrors">
                <p class="mt-4"> Active users at the moment : <?= $active->a ?> </p>
                <p class="mt-4"> Number of registred users : <?= $registred->r ?> </p>
                <div id="visited"> </div>
            </div>
        </div>
    </div>