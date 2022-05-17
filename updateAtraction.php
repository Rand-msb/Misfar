<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['username'])){//check whether the user loged in or not 
//    echo $_SESSION['username'];
?>
<html>

    <head>
        <title> Update attraction </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
        <link rel="stylesheet" href="attractions.css">
        <link rel="stylesheet" href="adminHP-add_update_attraction.css">
        <script src="adminHP-add_update_attraction.js"></script>

    </head>

    <body>

        <header class="header">
            <img src="images/logo2.png" alt="logo">
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

            $attractID = $_GET['attractID'];
            $attract_sql = "SELECT * FROM attractions a, city c WHERE a.city_id = c.id AND a.id = " . $attractID;
            if ($attract_result = mysqli_query($connection, $attract_sql)) {
                $attract_row = mysqli_fetch_assoc($attract_result);
            } else {
                echo "<spript>alert(You Don't have access for this page!);</script>";
            }
            ?>
            <div style="height: 0px;"></div>
            <div class="breadcrumb">
                <ol>
                    <li>
                        <a href="adminHP.php">Admin Home</a>
                    </li>
                    <li>
                        <a href="#" aria-current="page">Update attraction</a>
                    </li>
                </ol>
            </div>
            <div class="mainContainer">
                <div class="addArea">
                    <div class="addAtrac">
                        <form enctype="multipart/form-data" class="addAtractForm" id="addAtractForm" action="updateAttractionPHP.php?attractID=<?php echo $attractID; ?>" method="post">
                            <div class="preview">
                                <div class="start">
                                </div>
                                <img id="file-ip-1-preview" src="uploads/<?php echo $attract_row['img']; ?>" alt="" style="display: block;">
                                <label class="file-label" for="file-ip-1">Update Image</label>
                                <input name ="img" type="file" id="file-ip-1"  accept="image/*" class="img-input"
                                       onchange="showPreview(event);">
                            </div>
                    </div>
                    <div class="info">

                        <div class="title">
                            <div class="formType">
                                <p>Update Attraction:</p>
                            </div>
                            <div style="display: flex;gap: 40px;">
                                <div>

                                    <label for="tilte">Title</label>
                                    <input style="padding-left: 10px" type="text" id="title" name="title" value="<?php echo $attract_row['attractionName']; ?>">
                                </div>
                                <div>

                                    <label for="Category">Category</label>
                                    <input style="width: 110px; padding-left: 10px" type="text" id="Category" name="Category" value="<?php echo $attract_row['field']; ?>">
                                </div>

                            </div>

                        </div>
                        <div class="disc">
                            <label for="Description">Description</label>
                            <textarea id="desc"
                                      name="desc"><?php echo $attract_row['description']; ?></textarea>
                        </div>
                        <div class="cat-sub">
                            <div class="city">
                                <label for="city">City:</label>
                                <?php
                                $city[0] = 'Riyadh';
                                $city[1] = 'Alula';
                                $city[2] = 'Jeddah';
                                for ($i = 0; $i < 3; $i++) {
                                    if (strcasecmp($city[$i], $attract_row['city']) == 0) {
                                        echo '<input type="radio" id="' . $city[$i] . '" name="city" value="' . $city[$i] . '" checked>';
                                        echo '<label for = "' . $city[$i] . '">' . $city[$i] . '</label><br>';
                                    } else {
                                        echo '<input type="radio" id="' . $city[$i] . '" name="city" value="' . $city[$i] . '">';
                                        echo '<label for = "' . $city[$i] . '">' . $city[$i] . '</label><br>';
                                    }
                                }
                                ?>
                                <div class="error">
                                    <img src="images/warning.png" alt="" id="ErrorIcon" width="20" height="20"
                                         style="display: none;">
                                    <p id="Error" style="display: inline;"></p>
                                </div>
                            </div>
                            <div class="submit">
                                <input type="submit" value="Update" onclick="validateForm(); return false;">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </main>

        <footer>
            <img src="images/footer.png" alt="logo">
        </footer>

    </body>
<?php 

    }else
          header("Location:index.php"); //if the role of the loged in user is manager return the user to manager homepage

?> 
</html>