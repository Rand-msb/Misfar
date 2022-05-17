<?php
session_start();
?>
<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="adminHP-add_update_attraction.css">
        <link rel="stylesheet" href="attractionReview.css">
        <link rel="stylesheet" href="link href='https://css.gg/attachment.css' rel='stylesheet'">
        <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
        <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <script src="validation.js"></script>
        <link type="text/css" rel="stylesheet" href="jssocials-1.4.0/jssocials.css" />
        <link type="text/css" rel="stylesheet" href="jssocials-1.4.0/jssocials-theme-classic.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="script.js"></script>
        <style>
            .popup h2 {
                color: #4a2662;
                text-align: center;
                columns: #222;
                margin: 10px 8px 20px;
                font-size: 15px;
            }
            .close-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                width: 15px;
                height: 15px;
                background: #888;
                color: #eee;
                text-align: center;
                line-height: 15px;
                border-radius: 15px;
                cursor: pointer;
            }
            .jssocials-shares{
                text-align: center;
                margin-top: 30px;
            }
            .popup {
                position: fixed;
                top: 50%;
                left: 50%;
                display: none;
                transform: translate(-50%, -50%) scale(1.25);
                width: 200px;
                padding: 20px 30px;
                background: white;
                box-shadow: 2px 2px 5px 5px rgba(0, 0, 0, 0.15);
                border-radius: 10px;
                transition: top 0ms ease-in-out 200ms,
                    opacity 200ms ease-in-out 0ms,
                    transform 200ms ease-in-out 0ms;


            }

        </style>
        <title> Attraction review Page </title>
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
//            $att_id ="";
//            if (isset($_GET['attraction_id'])) {
//                echo 'inside if';
//                $att_id = $_GET['attraction_id'];
//            } else {
//                echo 'inside else';
//            }
            $att_id = $_GET['attraction_id'];
            $att_sql = "SELECT * FROM attractions WHERE id =" . $att_id;
            $att_result = mysqli_query($connection, $att_sql);
            while ($att_rows = mysqli_fetch_assoc($att_result)) {
                $result = mysqli_query($connection, "SELECT * FROM city WHERE id='" . $att_rows['city_id'] . "'") or die(mysqli_error($connection));
                if ($result) {
                    $cityRow = mysqli_fetch_array($result);
                }
                //echo 'inside while';
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
                            <?php echo "<a href=\"attractions.php?city_id=" . $att_rows['city_id'] . "\" >" . $cityRow['city'] . " Attractions</a>"; ?>
                        </li>
                        <li>
                            <?php echo "<a href=\"#\" aria-current=\"page\">" . $att_rows['attractionName'] . "</a>"; ?>
                        </li>
                    </ol>
                </div>
                <div class="big_container">
                    <div class="bigAttP">
                        <div class="AtrractionPhoto">
                            <?php echo "<img src=uploads\\" . $att_rows['img'] . " alt=" . $att_rows['img'] . " style=\"width: 700px; height: 700px;margin-top: 95px;\">"; ?>
                        </div>
                    </div>


                    <div class="bigAttD">
                        <div class="AtrractionDesc">
                            <?php
                            echo "<p class=\"attName\">" . $att_rows['attractionName'] . "</p>"
                            . "<textarea name=\"rev\" rows=\"3\" cols=\"54\" maxlength=\"500\" class=\"desc_area\" id=\"desc_area\"
                                  readonly>" . $att_rows['description'] . "</textarea>"
                            ?>
                        </div>
                    </div>
                </div>


                <?php
                $rev_sql = "SELECT * FROM `reviews` WHERE `attraction_ID` =" . $att_id;
                $rev_result = mysqli_query($connection, $rev_sql);
//            $rev_rows = mysqli_fetch_assoc($rev_result);

                $rev_count = mysqli_num_rows($rev_result);

//            if( $rev_count > 0) {
//                while ($rev_rows = mysqli_fetch_assoc($rev_result)) {
//                    
//                }
//            }
                ?>
                <form action="newReview.php?attractionName=<?php echo $att_rows['attractionName'] ?>" method="POST" id="revForm" enctype="multipart/form-data" >
                    <div class="container">

                        <ul class="responsive-table">
                            <li class="table-header">
                                <div class="col col-1">
                                    <p class="prev">Reviews</p>
                                </div>
                            </li>

                            <?php
                            if ($rev_count > 0) {
                                while ($rev_rows = mysqli_fetch_assoc($rev_result)) {
                                    echo " <li class=\"table-row\">
                                            <div class=\"rev col-1\">
                                            <p class=\"reveiw\">" . $rev_rows['review'] . "</p>";
//                            if ( isset($rev_rows['attachment1']) || isset($rev_rows['attachment2']) ) {
                                    if ($rev_rows['attachment1'] != null || $rev_rows['attachment2'] != null) {

                                        echo "<a href='Review.php?attraction_id=" . $att_id . '&att_name=' . $att_rows['attractionName'] . '&rev_id=' . $rev_rows['id'] . '&city_id=' . $att_rows['city_id'] . "'><i class=\"gg-attachment\"></i></a>";
                                    }
                                }
                                echo "</div>
                            </li>";
                            } else {
                                echo '<li class="table-row" style="justify-content: center;"><div class="rev col-1"><p class="reveiw" style="color: #653e8c;">There aren\'t any reviews for this attraction yet!</p></div></li>';
                            }
                            ?>    
                        </ul>
                    </div>

                    <div class="reviewSec">
                        <br><br>
                        <ul class="responsive-table">
                            <li class="table-header2">
                                <div class="col col-1">
                                    <?php
                                    echo "<p class=\"revQ\">What do you think about " . $att_rows['attractionName'] . "?</p>";
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                    <textarea name="rev" rows="3" cols="54" maxlength="500" class="revSec"
                              placeholder="Share your thoughts here...."></textarea>
                    <br>
                    <label class="AttachmentsLable">
                        Add photos to your review:
                        <br><br>
                        <input type="file" name="files[]" id="files" class="uploading" accesskey="l" multiple
                               onchange="return fileValidation()">

                    </label>

                    <br><br>
                    <img src="images/warning.png" alt="" id="ErrorIcon2" width="20" height="20" style="display: none;">
                    <p id="Error2" style="display: inline;"></p>


                    <br><br><br><br>

                    <input type="submit" value="Post" class="saveRev" name ="newReview"  accesskey="n" onclick="validateForm(); return false;">
                    <input type="submit" value="share" class="SahreRev" onclick="showl();return false">
                    <div class="popup">
                        <div class="close-btn" onclick="hidel();">&times;

                        </div>
                        <h2> Share Your review on</h2>
                        <div class="share" style="" display:none">


                        </div>

                    </div>
            </form>
        </main>

        <footer>
            <img src="imgs/footer.png" alt="logo">
        </footer>
        <script src="https://kit.fontawesome.com/7368c40b21.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

        <script type="text/javascript" src="jssocials-1.4.0/jssocials.min.js"></script>
        <script>

                            function showl() {
                                document.querySelector(".popup").style.display = "block";

                            }
                            function hidel() {
                                document.querySelector(".popup").style.display = "none";

                            }


                            $(".share").jsSocials({
                                url: "http://localhost/swep/attractionReview.php?attraction_id=<?php echo $att_id ?>",
                                text: "I just reviewed this attraction through #Misfar in #Saudi_Arabia\n\
        Check it out",
                                showLabel: false,

                                shares: [
                                    "twitter",
                                    {share: "facebook", label: "Like our Page"},
                                    {share: "whatsapp", label: "Send a Message"},
                                ],
                            });
        </script><!-- comment -->
    </body>

</html>