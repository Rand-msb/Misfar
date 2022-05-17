<!DOCTYPE html>

<html>
   <!--security: will check the role of the one who start the session-->
<?php
session_start();
if(isset($_SESSION['username'])){//check whether the user loged in or not 
//    echo $_SESSION['username'];
?>

    <head>
        <link rel="stylesheet" href="adminHP-add_update_attraction.css">
        <link rel="stylesheet" href="attractions.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Admin Home Page </title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
        <script src="script.js"></script>

    </head>

    <body>
         <script>
        function delte(y){
                u="delete.php?attraction_id="+y;

    x=confirm('Are you sure you want to delete this attraction?');
    
    if (x)
    location.href=u;
    
}
        </script>
          
        <header class="header" id="samplePara">
            <img class="logo" src="imgs/logo2.png" alt="misfar logo" width="100" height="100">
            <nav class="navbar">
                <a href="signout.php" onclick='return confirm("Are you sure you want to log out?");'>  <span id="show-logout" class="material-icons-outlined" style="color:#6C3D8E; cursor: pointer; font-size: 30px;">
                    logout
                    </span></a>
            </nav>
        </header>

        <main>
            <?php
           
            //inclding the data base connection which is constants in another file 
            include 'dataConncetion.php';
//            $admin_id =$_SESSION['username'];
//            $admin_sql = "SELECT * FROM `admin` WHERE id ='" . $admin_id."'"; //selecting the admin that logged in according to his id 
//            if ($admin_result = mysqli_query($connection, $admin_sql)) {
//                $admin_row = mysqli_fetch_assoc($admin_result);
//            } else {
//                echo "<spript>alert(You Don't have access for this page!);</script>";
//            }
            ?>
            <div style="height: 0px;"></div>
            <div class="breadcrumb">
                <ol>
                    <li>
                        <a href="#" aria-current="page">Admin Home</a>
                    </li>
                </ol>
            </div>
            <div style="height: 16px;"></div>
            <div class="bigW">
                <div class="w1">
                    <p id="welcoming">Welcome <br> <?php echo $_SESSION['username']; ?> !</p>
                    <div>
                        <a href = "addAtraction.php"><button class = "AddAttractButton" type = "button">+ Add
                                Attraction</button></a>
                    </div>
                </div>

                <div style = "width: 61.5%;">
                    <div>
                        <table>
                            <tbody>
                                <tr>
                                    <td class = "th" colspan = "2">Attractions</td>
                                </tr>
                                <?php
                                // querey to retrive the information that is going to be displayed in tables for the attractions.
                                $reqSQL = "SELECT * FROM attractions";
                                $reqResult = mysqli_query($connection, $reqSQL);
                                $att_count = mysqli_num_rows($reqResult);
                                if($att_count != 0){
                                while ($reqRow = mysqli_fetch_array($reqResult)) {
                                    echo '<tr class = "whenHover">
                                    <td><a class = "attractionsLinks" href = "attractionReview.php?attraction_id=' . $reqRow['id'] . '&role=admin">' . $reqRow['id'] . ' - ' . $reqRow['attractionName'] . '</a></td>
                                    <td class = "buttons">
                                        <button class = "updateButton"
                                                onclick = \'location.href = "updateAtraction.php?attractID=' . $reqRow['id'] . '"\'><span>Update</span></button>
                                        <button class = "deleteButton" onclick="delte('.$reqRow['id'].')"><span>Delete</span></button>
                                    </td>
                                </tr>';
                                }
                                }else {
                                    echo '<tr class = "whenHover"><td style="padding-bottom: 10px;padding-top: 10px;"> No Attraction Have Been Added Yet! </td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <footer>
            <img src = "images/footer.png" alt = "logo">
        </footer>

    </body>
    
     <?php 

    }else
          header("Location:index.php"); //if the role of the loged in user is manager return the user to manager homepage

?> 
</html>