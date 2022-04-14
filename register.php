<?php
include_once 'header.php'
?>

<body>

    <div class="container register-wrapper">
        <h4 class="center header-text"> Create your account </h4>
        <div class="row">
            <div class="col s3 ">
            </div>
            <div class="col s6 " style="padding: 5%; box-shadow: 10px 10px 12px 1px rgba(0,0,0,0.75); border-radius: 15px;">
                <form action="includes/signup.inc.php" method="post">
                    <input type="text" name="firstname" value="" required placeholder="First Name" />
                    <input type="text" name="lastname" value="" required placeholder="Last Name" />
                    <input type="email" name="email" value="" required placeholder="Email" />
                    <input type="password" name="pwd" value="" required placeholder="Password" />
                    <input type="password" name="pwdrepeat" value="" required placeholder="Confirm Password" />
                    <input class="btn" type="submit" name="submit" value="Submit" />

                </form>

                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo "<p>Please fill in all fields! </p>";
                    } elseif ($_GET["error"] == "invalidemail") {
                        echo "<p>Please enter a valid email address! </p>";
                    } elseif ($_GET["error"] == "pwddontmatch") {
                        echo "<p>Please make sure the password matches! </p>";
                    } elseif ($_GET["error"] == "emailexists") {
                        echo "<p>This email is already registered! </p>";
                    } elseif ($_GET["error"] == "stmtfailed") {
                        echo "<p>Something went wrong! Please try again. </p>";
                    } elseif ($_GET["error"] == "none") {
                        echo "<p>You have signed up successfully! </p>";
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

</body>