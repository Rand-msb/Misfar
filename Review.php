<?php
session_start();
?>
<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Review.css">
        <link rel="stylesheet" href="adminHP-add_update_attraction.css">
        <link rel="stylesheet" href="link href='https://css.gg/attachment.css' rel='stylesheet'">
        <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
        <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <script src="misfar1.js"></script>
        <title> Review Page </title>
    </head>

    <body>
        <header class="header">
            <img class="logo" src="imgs/logo2.png" alt="misfar logo" width="100" height="100">
            <?php
            if (isset($_SESSION['username'])) {
                echo '<nav class="navbar">
                    <a href="signout.php" onclick=\'return confirm("Are you sure you want to log out?");\'>  <span id="show-logout" class="material-icons-outlined" style="color:#6C3D8E; cursor: pointer; font-size: 30px;">
                    logout
                    </span></a></nav>';
            }
            ?>
        </header>

        <main>
            <?php
            include 'dataConncetion.php';
            $att_name = $_GET['att_name'];
            $att_id = $_GET['attraction_id'];
            $city = $_GET['city_id'];
            $result = mysqli_query($connection, "SELECT * FROM city WHERE id='" . $city . "'") or die(mysqli_error($connection));
            if ($result) {
                $cityRow = mysqli_fetch_array($result);
            }
            ?>
            <div class="breadcrumb">
                <ol>
                    <li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo '<a href="adminHP.php">Admin Home</a>';
                        } else {
                            echo '<a href="index.php">Home</a>';
                        }
                        ?>  
                    </li>
                    <li>
                        <?php echo "<a href=\"attractions.php?city_id=" . $city . "\" >" . $cityRow['city'] . " Attractions</a>"; ?>
                    </li>
                    <li>
                        <?php echo "<a href=\"attractionReview.php?attraction_id=" . $att_id . "\">" . $att_name . "</a>"; ?>
                    </li>
                    <li>
                        <a href="#" aria-current="page">Review</a>
                    </li>
                </ol>
            </div>
            <br><br><br>
            <?php
            $rev_id = $_GET['rev_id'];

            $rev_sql2 = " SELECT * FROM `reviews` WHERE `attraction_ID` =" . $att_id;
            $rev_result2 = mysqli_query($connection, $rev_sql2);
            while ($rev_rows2 = mysqli_fetch_assoc($rev_result2)) {
                if (strcmp($rev_rows2['id'], $rev_id) == 0) {
                    ?>
                    <ul>
                        <li class = "table-row">
                            <div class = "rev col-1">
                                <?php echo "<p class=\"reveiw\">" . "“ " . $rev_rows2['review'] . "”" . "</p>"; ?>
                            </div>
                        </li>
                    </ul>
                    <br>
                    <img src="images/sado2.png" style="height:61px; margin-left:-5px; width: 100%;">
                    <br><br><br>

                    <?php if (isset($rev_rows2['attachment1'])) { ?>
                        <div class=”gallery”>
                            <figure class=”gallery__item gallery__item--1">
                                <?php
                                echo "<img src=uploads\\" . $rev_rows2['attachment1'] . " class=\"gallery__img\" alt=\"Image 1\">";
                            } //end checking if is set 
                            ?>
                        </figure>
                        <?php if (isset($rev_rows2['attachment2'])) { ?>
                            <figure class="gallery__item gallery__item--2">
                                <?php
                                echo "<img src=uploads\\" . $rev_rows2['attachment2'] . " class=\"gallery__img\" alt=\"Image 2\">";
                            }//end cheking if is set 
                            ?>
                        </figure>
                    </div>
                    <?php
                } //end cheking the equality of the reviews 
            } //end while loop 
            ?>

        </main>

        <footer>
            <img src="imgs/footer.png" alt="logo">
        </footer>

    </body>

</html>