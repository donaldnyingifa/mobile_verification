<?php
include_once 'header.php'
?>

<body>

    <?php
    $owner = $_SESSION["firstname"] . ' ' . $_SESSION["lastname"];

    ?>
    <div class="container">

        <div class="row">
            <div class="col s3 ">
            </div>
            <div class="col s6 ">

                <?php
                echo "<br />";
                echo "<div style='color:'red''>";

                //Display errors if any
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo "<p style='color:red;'>Please fill in all fields! </p>";
                    } elseif ($_GET["error"] == "stmtfailed") {
                        echo "<p style='color:red;'>Something went wrong! Please try again. </p>";
                    } elseif ($_GET["error"] == "toobig") {
                        echo "<p style='color:red;'>Your image size is too big! Please add an image below 2mb</p>";
                    } elseif ($_GET["error"] == "errorupload") {
                        echo "<p style='color:red;'>There was an error uploading your image</p>";
                    } elseif ($_GET["error"] == "wrongtype") {
                        echo "<p style='color:red;'>You cannot upload images of this type!</p>";
                    } elseif ($_GET["error"] == "none") {
                        echo "<p style='color:red;'>You have added phone successfully! </p>";
                    }
                }
                echo "</div>";
                ?>

                <h4 style="text-shadow: 2px 2px #301934;">ADD PHONE </h4>
                <form class="card-panel" action="includes/phone.inc.php?uid=$user_id" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"]; ?>">
                    <input type="text" name="phone_name" value="" required placeholder="Phone Name" />
                    <input type="text" name="curr_owner" value="<?= $owner; ?>" required placeholder="Current Owner" />
                    <input type="text" name="prev_owner" value="" required placeholder="Previous Owner" />
                    <input type="text" name="imei" value="" required placeholder="IMEI" />
                    <input type="text" name="purchased_from" value="" required placeholder="Purchased From" />
                    <input type="date" name="date_purchased" value="" required placeholder="Date Purchased" />

                    <p>Reported as stolen:</p>
                    <input type="radio" id="true" name="reported_stolen" value="true">
                    <label for="true">True</label><br>
                    <input type="radio" id="false" name="reported_stolen" checked value="false">
                    <label for="false">False</label><br /><br />
                    <label for="image">Picture of Phone</label>
                    <div style="margin: 20px; background-color:azure;">
                        <input type="file" name="phone_image" value="" required placeholder="select image" />
                    </div>
                    <div class="center">
                        <input class="btn" type="submit" name="submit" value="Submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>

    </div>
    <div class="col s3 ">
    </div>
    </div>
    </div>
    <?php
    include_once 'footer.php'
    ?>