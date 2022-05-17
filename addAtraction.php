<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['username'])){//check whether the user loged in or not 
//    echo $_SESSION['username'];
?>
<html>

    <head>
        <title> Add atraction </title>
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
            <div style="height: 0px;"></div>
            <div class="breadcrumb">
                <ol>
                    <li>
                        <a href="adminHP.php">Admin Home</a>
                    </li>
                    <li>
                        <a href="#" aria-current="page">Add attraction</a>
                    </li>
                </ol>
            </div>
            <div style="height: 16px;"></div>
            <div class="mainContainer">
                <div class="addArea">
                    <div class="addAtrac">
                        <form enctype="multipart/form-data" class="addAtractForm" id="addAtractForm" action="addAtractionPHP.php" method="post">
                            <div class="preview">
                                <div class="start">
                                    <i id="uplode-icon" class="fa fa-download" aria-hidden="true"></i>
                                    <div id="uplode-par">Upload an image</div>
                                </div>
                                <img id="file-ip-1-preview">
                                <label class="file-label" for="file-ip-1">Upload Image</label>
                                <input name = 'img' type="file" id="file-ip-1" accept="image/*" class="img-input"
                                       onchange="showPreview(event);">
                            </div>
                    </div>
                    <div class="info">

                        <div class="title">
                            <div class="formType">
                                <p>Add Atraction:</p>
                            </div>
                            <div style="display: flex;gap: 40px;">
                                <div>
                                    <label for="tilte">Title</label>
                                    <input style="padding-left: 10px" type="text" id="title" name="title">
                                </div>
                                <div>
                                    <label for="Category">Category</label>
                                    <input style="width: 110px; padding-left: 10px" type="text" id="Category" name="Category">
                                </div>

                            </div>
                        </div>
                        <div class="disc">
                            <label for="Description">Description</label>
                            <textarea id="desc" name="desc"></textarea>
                        </div>
                        <div class="cat-sub">
                            <div class="city">
                                <label for="city">City:</label>
                                <input type="radio" id="Riyadh" name="city" value="Riyadh">
                                <label for="Riyadh">Riyadh</label><br>
                                <input type="radio" id="Jeddah" name="city" value="Jeddah">
                                <label for="Jeddah">Jeddah</label><br>
                                <input type="radio" id="Alula" name="city" value="Alula">
                                <label for="Alula">Al-Ula</label>
                                <div class="error">
                                    <img src="images/warning.png" alt="" id="ErrorIcon" width="20" height="20"
                                         style="display: none;">
                                    <p id="Error" style="display: inline;"></p>
                                </div>
                            </div>
                            <div class="submit">
                                <input type="submit" value="Add" onclick="validateForm(); return false;">
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