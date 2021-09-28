<?php
include_once 'header.php'
?>

<div class="container">
    <h4 class='center' style="text-shadow: 2px 2px #301934;"> ALL USERS</h4>
    <div class="row">
        <div class="col s3 ">
        </div>
        <div class="col s6 ">

            <?php
            try {
                $is_admin = $_SESSION['is_admin'];
                if ($is_admin) {
                    $curr_user = $_SESSION["user_id"];
                    require_once './includes/dbh.inc.php'; // Database handler
                    $sql = "SELECT * FROM users WHERE $curr_user != user_id ;";
                    $result = mysqli_query($conn, $sql);
                    $result_check = mysqli_num_rows($result);

                    if ($result_check > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<p><strong>NAME: </strong>" . $row['firstname'];
                            echo "<tab /> ";
                            echo $row['lastname'] . "</p>";

                            $user_id = $row['user_id'];
                            $is_admin = $row['is_admin'];


                            echo "<p><strong>DATE REGISTERED: </strong>" . $row['reg_date'] . "</p>";

                            if ($is_admin == "0") {
                                echo "<form action='./includes/updateuser.inc.php?is_admin=1&user_id=$user_id'  method='post'>
                    <input class='btn' type='submit' name='update' value='Make Admin' />
                    </form>";
                            } else {
                                echo "<form action='./includes/updateuser.inc.php?is_admin=0&user_id=$user_id'  method='post'>
                    <input class='btn' type='submit' name='update' value='Remove Admin Access' />
                    </form>";

                                echo "<form action='./includes/deleteUser.inc.php?user_id=$user_id'  method='post'>
              
                    <input class='btn' style='margin-top:1vh' type='submit' name='delete' value='Delete' />
                    </form>";
                            }
                        }
                    } else {
                        echo 'No registered user';
                    }
                } else {
                    echo "<p> You are not authorized to view this page</p>";
                }
            } catch (Exception $e) {
                echo "<p>Please login to view this page</p>";
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