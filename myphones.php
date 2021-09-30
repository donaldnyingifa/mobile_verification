<?php
include_once 'header.php'
?>

<body>

    <div class="container">
        <?php
        if (isset($_SESSION["is_admin"])) {
            // Display based on user role
            if ($_SESSION["is_admin"] == '1') {
                echo " <h4 class='center' style='text-shadow: 2px 2px #301934;'> ALL PHONES</h4>";
            } else {
                if (isset($_SESSION["firstname"])) {
                    echo "<h4 class='center' style='text-shadow: 2px 2px #301934;'>" . $_SESSION["firstname"] . "'s Phones </h4>";
                }
            }
        }
        ?>

        <div class="row">
            <div class="col s3 ">
            </div>
            <div class="col s6 ">

                <?php

                $uid = $_SESSION['user_id'];
                $is_admin = $_SESSION['is_admin'];

                require_once './includes/dbh.inc.php'; // Database handler
                if ($is_admin) {
                    $sql = "SELECT * FROM phones;";
                } else {
                    $sql = "SELECT * FROM phones WHERE user_id = $uid;";
                }

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

                        echo "<p><strong>REPORTED STOLEN: </strong>" . $row['reported_stolen'] . "</p>";

                        $pic = $row["phone_image"];
                        $pic = ltrim($pic, './');
                        $pic = './' . $pic;
                        echo "<img src=$pic alt='phone' width= '300vw' />";

                        echo "<br /> <br /> ";
                        $phone_name = $row['phone_name'];
                        $curr_owner = $row['curr_owner'];
                        $prev_owner = $row['prev_owner'];
                        $imei = $row['imei'];
                        $purchased_from = $row['purchased_from'];
                        $date_purchased = $row['date_purchased'];
                        $reported_stolen = $row['reported_stolen'];
                        $phone_image = $row['phone_image'];
                        $id = $row['id'];

                        echo "<form action='updatephone.php?id=$id&phone_name=$phone_name&curr_owner=$curr_owner&prev_owner=$prev_owner& imei=$imei& purchased_from=$purchased_from&date_purchased=$date_purchased&reported_stolen=$reported_stolen&phone_image=$phone_image'  method='post'>
                    <input class='btn' type='submit' name='update' value='Update' />
                    </form>";
                        echo "<form action='./includes/delete.inc.php?imei=$imei&id=$id&phone_image=$phone_image'  method='post'>
                    <input class='btn' style='margin-top:1vh' type='submit' name='delete' value='Delete' />
                    </form>";
                    }
                } else {
                    echo 'No registered phone';
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