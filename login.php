<?php
include_once 'header.php'
?>

<body>

    <div class="container">

        <div class="row" style="padding: 3%; margin-top: 10%; box-shadow: 10px 10px 25px 1px rgba(0,0,0,0.75);">

            <div class="col m6 ">
                <h4 class="center" style="text-shadow: 2px 2px #301934;"> LOGIN </h4>

                <form style="margin-left: 10%; margin-right: 10%" action="includes/login.inc.php" method="post">
                    <input type="text" name="email" value="" required placeholder="Email" />
                    <input type="password" name="pwd" value="" required placeholder="Password" />
                    <input class="btn" type="submit" name="submit" value="LOGIN" />
                </form>

                <?php
                // Display error message
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo "<p>Please fill in all fields! </p>";
                    }
                    if ($_GET["error"] == "invalidemail") {
                        echo "<p>Please enter a valid email address! </p>";
                    } elseif ($_GET["error"] == "wronglogin") {
                        echo "<p>Invalid login information! </p>";
                    }
                }
                ?>
            </div>
            <div class="col m6"">
                <h5><strong> Hello, Would <br />you like to register? </strong></h5>
                <p>Fill in a few details to begin</p>
                <a class=" btn" href="register.php">SIGNUP</a>
            </div>

        </div>
    </div>

    <?php
    include_once 'footer.php'
    ?>