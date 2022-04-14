<?php
include_once 'header.php'
?>

<body>
    <div class="container">
        <h4 class="center" style='text-shadow: 2px 2px #301934;'> UPDATE PHONE </h4>
        <div class="row">
            <div class="col s3 ">
            </div>
            <div class="col s6 ">

                <?php

                $owner = $_SESSION["firstname"] . ' ' . $_SESSION["lastname"];

                ?>

                <form action="includes/update.inc.php?uid=$user_id" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $_GET["id"]; ?>">
                    <input type="text" name="phone_name" value="<?= $_GET["phone_name"]; ?>" required placeholder="Phone Name" />
                    <input type="text" name="curr_owner" value="<?= $_GET["curr_owner"]; ?>" required placeholder="Current Owner" />
                    <input type="hidden" name="imei" value="<?= $_GET['imei']; ?>">
                    <input type="hidden" name="purchased_from" value="<?= $_GET['purchased_from']; ?>">
                    <input type="hidden" name="date_purchased" value="<?= $_GET['date_purchased']; ?>">
                    <?php

                    echo "<p><strong>PREVIOUS OWNER: </strong>" . $_GET['prev_owner'] . "</p>";;
                    echo "<p><strong>IMEI: </strong>" . $_GET["imei"] . "</p>";;
                    echo "<p><strong>PURCHASED FROM: </strong>" . $_GET["purchased_from"] . "</p>";;
                    echo "<p><strong>DATE PURCHASED: </strong>" . $_GET["date_purchased"] . "</p>";;
                    ?>

                    <p>Reported as stolen:</p>
                    <?php
                    if ($_GET["reported_stolen"] === 'true') {
                        echo "<input type='radio' id='true' name='reported_stolen' checked  value='true'>
                <label for='true'>True</label><br>
                <input type='radio' id='false' name='reported_stolen'  value='false'>
                <label for='false'>False</label><br>";
                    } else {
                        echo "<input type='radio' id='true' name='reported_stolen'  value='true'>
                <label for='true'>True</label><br>
                <input type='radio' id='false' name='reported_stolen' checked  value='false'>
                <label for='false'>False</label><br>";
                    }


                    ?>
                    <br />
                    <label for="image">Picture of Phone</label><br />
                    <?php
                    $pic = $_GET["phone_image"];
                    $pic = ltrim($pic, './');
                    $pic = './' . $pic;
                    echo "<img src=$pic alt='phone' width= '300vw' /><br/><br/>";
                    ?>
                    <input class="btn-color" type="submit" name="update" value="Update" />

                </form>

                <?php
                // Display error message
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo "<p>Please fill in all fields! </p>";
                    } elseif ($_GET["error"] == "stmtfailed") {
                        echo "<p>Something went wrong! Please try again. </p>";
                    } elseif ($_GET["error"] == "none") {
                        echo "<p>You have updated phone successfully! </p>";
                    }
                }
                ?>
            </div>
            <div class="col s3 ">
            </div>
        </div>
    </div>
    <?php
    include_once 'footer.php'
    ?>