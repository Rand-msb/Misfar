<!DOCTYPE html>
<html>
    <?php
    session_start();

    include 'dataConncetion.php';

    //Retrieve the city ID from the query string 

    $getCity = $_GET['city_id'];
    // we get the city name so we can display it later in the breadcumb and above the sadu
    $cityQuery = "SELECT * FROM city WHERE id=" . $getCity;
    $resultQuery = mysqli_query($connection, $cityQuery);
    $row2 = mysqli_fetch_assoc($resultQuery);
    ?>
    <head>
        <link rel="stylesheet" href="adminHP-add_update_attraction.css">
        <link rel="stylesheet" href="attractions.css">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
        <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?php echo $row2['city']; ?> attractions </title>

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
                        <a href="#" aria-current="page"><?php
                            // display city name in the breadcrumb
                            echo $row2['city'];
                            ?> Attractions</a>
                    </li>
                </ol>
            </div>
            <h3 style="text-align: center; color: #653E8C; font-size: 60px; margin: 26px; margin-bottom: 53px; text-transform: uppercase;"><?php /* display city name */echo $row2['city']; ?></h3>

            <img src="images/sado2.png" style="height:61px; margin-left:-5px; width: 100%;">
            <div style="height: 0px;"></div>

            <div style="height: 16px;"></div>


            <?php
//             echo 'hellllo';
            // to break from inner loop when exceeding 3 so that we will have 3 pictures per row
            $count = 0;

            // to count how many pictures where uploaded in the page and break from outer loop when it's equal to number of attractions in the DB
            $numRows = 0;
            //Retrieve attractions information from the database Based on the city sent with the query string 
            $sqlQuery = "SELECT * FROM attractions WHERE city_id = " . $getCity;
            if ($resultQuery = mysqli_query($connection, $sqlQuery)) {
                // 1 loop through the attractions
                while ($num = mysqli_num_rows($resultQuery) != $numRows) {
                    echo " <div class='attractions-container'>";

                    while ($row = mysqli_fetch_array($resultQuery)) {
                        // 2 retrive attraction name
                        // 3 retrive the field
                        // 4 retrive the picture of the attraction
                        $attractionـname = $row['attractionName'];
                        $field = $row['field'];
                        $img = $row['img'];
//                        $id = $row ['id'];
//                        echo 'hello';
//                        echo $id;


                        echo "<div class='tb-isotop-item w-1  mw-1 flex'>";
                        echo "<div class=tb-image-box tb-style2 tb-relative tb-radious-4 tb-border tb-height1' style='width: 285px; height: 264px;'>";

                        // here we are going to put query string to redirect to ghadeer page
                        echo "<a href=attractionReview.php?attraction_id=" . $row ['id'] . " class='tb-image-link'>";
                        echo "<div class='tb-absolute width-100 height-100 z-10 tb-hover d-flex align-items-center'>";
                        echo "<div class='container'>";
                        echo "<div class='row'>";
                        echo "<div class='col-12 text-center my-5'>";
                        echo "<div class='fillet-bold h3'>";

                        echo $attractionـname;

                        echo "<div class='grid-tags'>";
                        echo " <small>";
                        $sqlQuery2 = "SELECT * FROM city WHERE id = " . $getCity;
                        if ($resultQuery2 = mysqli_query($connection, $sqlQuery2)) {
                            if ($row2 = mysqli_fetch_assoc($resultQuery2)) {
                                $city = $row2['city'];
                                echo $city;
                            }
                        }

                        echo "&amp;" . $field;
                        echo "</small>";
                        echo "</div>";
                        echo "</div>";

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='tb-image tb-relative'>";
                        echo "<div class='tb-bg' style='position:relative;'>";

                        echo "<img src='uploads/$img' type='' style='width: 285px; height: 264px;'>";

                        echo "</div>";
                        echo "</div>";
                        echo "</a>";
                        echo "</div>";
                        echo "</div>";
                        $numRows++;
                        $count++;
                        if ($count == 3) {
                            $count = 0;

                            break;
                        }
                    }
                    echo "</div>";
                }
            }
            // } else {
            //   echo "<p>You Don't have access for this page!</p>";
            // }
            ?>
            <!-- 
            
            
            
             <div class="tb-isotop-item w-1  mw-1">
                 <div class="tb-image-box tb-style2 tb-relative tb-radious-4 tb-border tb-height1"
                      style="width: 285px; height: 264px;">
                     <a href="misfar1.html" class="tb-image-link ">
                         <div class="tb-absolute width-100 height-100 z-10 tb-hover d-flex align-items-center">
                             <div class="container">
                                 <div class="row">
                                     <div class="col-12 text-center my-5">
                                         <div class="fillet-bold h3">

                                             diriyah

                                             <div class="grid-tags">
                                                 <small>
                                                     Riyadh
                                                     &amp; History
                                                 </small>
                                             </div>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="tb-image tb-relative">
                             <div class="tb-bg" style="position:relative;">

                                 <img src="images/diriyah.jpg" type="" style="width: 285px; height: 264px;">

                             </div>
                         </div>
                     </a>
                 </div>
             </div>


             <div class="tb-isotop-item w-2  mw-1">
                 <div class="tb-image-box tb-style2 tb-relative tb-radious-4 tb-border tb-height1"
                      style="width: 285px; height: 264px;">
                     <a href="misfar2.html" class="tb-image-link ">
                         <div class="tb-absolute width-100 height-100 z-10 tb-hover d-flex align-items-center">
                             <div class="container">
                                 <div class="row">
                                     <div class="col-12 text-center my-5">
                                         <div class="fillet-bold h3">
                                             boulevard

                                             <div class="grid-tags">
                                                 <small>
                                                     Riyadh
                                                     &amp; Entertainment
                                                 </small>
                                             </div>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="tb-image tb-relative">
                             <div class="tb-bg" style="position:relative;">

                                 <img src="images/boulevard.jpeg" type="" style="width: 285px; height: 264px;">

                             </div>
                         </div>
                     </a>
                 </div>

             </div>
             <div class="tb-isotop-item w-3 mw-1">
                 <div class="tb-image-box tb-style2 tb-relative tb-radious-4 tb-border tb-height1"
                      style="width: 285px; height: 264px;">
                     <a href="misfar3.html" class="tb-image-link ">
                         <div class="tb-absolute width-100 height-100 z-10 tb-hover d-flex align-items-center">
                             <div class="container">
                                 <div class="row">
                                     <div class="col-12 text-center my-5">
                                         <div class="fillet-bold h3">
                                             edge of the world

                                             <div class="grid-tags">
                                                 <small>
                                                     Riyadh
                                                     &amp; History
                                                 </small>
                                             </div>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="tb-image tb-relative">
                             <div class="tb-bg" style="position:relative;">

                                 <img src="images/edge.jpg" type="" style="width: 285px; height: 264px;">

                             </div>
                         </div>
                     </a>
                 </div>
             </div> -->


            <?php
//if ($count == 3) {
//    echo $count;
//    echo '<br>';
//    $count = 0;
//} else {
//    echo $count;
//    echo 'fail';
//}
//
            ?>


        </main>
        <footer>


            <img src="images/footer.png" alt="logo">


        </footer>
    </body>

</html>