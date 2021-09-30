<?php
include_once 'header.php'
?>

<body>
    <div class="container">
        <h4 class="center" style='text-shadow: 2px 2px #301934;'> SEARCH RESULT </h4>
        <div class="row">
            <div class="col s3 ">
            </div>
            <div class="col s6 ">
                <?php
                require_once './includes/dbh.inc.php'; // Database handler
                require_once './includes/functions.inc.php';

                $phone_imei = $_POST["search_imei"];
                if (emptySearch($phone_imei) !== false) {

                    echo "<p>PLEASE ENTER A VALID IMEI</p>";
                } else if (is_numeric($phone_imei)) {
                    $sql = "SELECT * FROM phones WHERE imei = $phone_imei;";
                    $result = mysqli_query($conn, $sql);

                    $result_check = mysqli_num_rows($result);

                    if ($result_check > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<p><strong>NAME OF PHONE: </strong>" . $row['phone_name'] . "</p>";

                            echo "<p><strong>CURRENT OWNER: </strong>" . $row['curr_owner'] . "</p>";

                            echo "<p><strong>PREVIOUS OWNER: </strong>" . $row['prev_owner'] . "</p>";

                            echo "<p><strong>IMEI: </strong>" . $row['imei'] . "</p>";

                            echo "<p><strong>PURCHASED FROM: </strong>" . $row['purchased_from'] . "</p>";

                            echo "<p><strong>DATE PURCHASED: </strong>" . $row['date_purchased'] . "</p>";

                            echo "<p><strong>DATE AND TIME REGISTERED: </strong>" . $row['reg_date'] . "</p>";

                            echo "<p><strong>REPORTED STOLEN: </strong>" . $row['reported_stolen'] . "</p>";
                            if ($row['reported_stolen'] == 'true') {
                                echo "<p style='color: red;font-weight: bold;'>DO NOT PURCHASE !! THIS PHONE WAS REPORTED STOLEN !!</p>";
                            }
                            $pic = $row["phone_image"];
                            $pic = ltrim($pic, './');
                            $pic = './' . $pic;
                            echo "<img  src=$pic alt='phone' width= '300vw' />";

                            echo "<br /> <br /> ";
                        }
                    } else {
                        echo '<p>NO REGISTERED PHONE WITH <strong>' . $phone_imei . '</strong></p>';
                    }
                } else {
                    echo "<p>INVALID IMEI</p>";
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