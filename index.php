<?php
include_once 'header.php'
?>

<body>
    <style>
        ::-webkit-input-placeholder {
            /* Edge */
            color: grey;
        }

        :-ms-input-placeholder {
            /* Internet Explorer */
            color: grey;
        }

        ::placeholder {
            color: grey;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>

    <div class="container" style="width: 50vw;">
        <div class="row" style="display: flex;
                        flex-direction: column;
                        justify-content: center;
                        min-height: 80vh;
                       ">
            <?php
            // Welcome message for logged in user
            if (isset($_SESSION["firstname"])) {
                echo "<h4 class='center' style='text-shadow: 2px 2px #301934;'>   Welcome " . $_SESSION["firstname"] . "</h4><br />";
            }

            //display this only if the user is admin
            if (isset($_SESSION["is_admin"])) {
                if ($_SESSION["is_admin"] == '1') {
                    require_once './includes/dbh.inc.php'; // Database handler

                    $phonesql = "SELECT * FROM phones;";
                    $adminusers = "SELECT * FROM users WHERE is_admin = 1;";
                    $genuser = "SELECT * FROM users WHERE is_admin = 0;";

                    $phoneresult = mysqli_query($conn, $phonesql);
                    $adminresult = mysqli_query($conn, $adminusers);
                    $genresult = mysqli_query($conn, $genuser);
                    echo "<div class='center z-depth-4' style='margin-top: 2vh;'>";
                    echo "<h5>REGISTERED PHONES: " . mysqli_num_rows($phoneresult) . "</h5>";
                    echo "<h5>REGULAR USERS: " . mysqli_num_rows($genresult) . "</h5>";
                    echo "<h5>ADMIN USERS: " . mysqli_num_rows($adminresult) . "</h5>";
                    echo "</div>";
                }
            }
            ?>
            <section class="heading center">
            <h2>Welcome to the mobile verification portal</h1>
            </section>
       
            <div class="center">

           
                <form action=" search.php" method="post">
                    <input style="border: 3px solid #4fa79a; border-radius: 5px; " type="text" name="search_imei" value="" required placeholder="Type your IMEI " />
                    <input class="btn" type="submit" name="submit" value="Submit" />
                </form>
                <?php
                // Display error message
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "invalidimei") {
                        echo "<p>Invalid IMEI  </p>";
                    }
                    if ($_GET["error"] == "emptysearch") {
                        echo "<p>Please type an IMEI ! </p>";
                    }
                }
                ?>
            </div>

        </div>
    </div>

    <?php
    include_once 'footer.php'
    ?>