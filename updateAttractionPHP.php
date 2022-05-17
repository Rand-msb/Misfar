<!-- this page for updating the attractions in the database -->
<?php
 include 'dataConncetion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {// to check request method
    $attractID = $_GET['attractID']; // to know whic row we need to update in the database
    $img = $_FILES['img']['name'];
    if ($img == '') {
        $img = 'oldimg';
    } else {
        $destination = 'uploads/' . $img;
        $file = $_FILES['img']['tmp_name'];
        move_uploaded_file($file, $destination);
    }
    $title = $_POST['title'];
    $Category = $_POST['Category'];
    $desc = $_POST['desc'];
    $city = $_POST['city'];
    $city_idSQL = "SELECT id FROM city WHERE city='" . $city . "'"; //to get the id of the selcted city
    $result = mysqli_query($connection, $city_idSQL) or die(mysqli_error($connection));
    if ($result) {
        $row = mysqli_fetch_array($result);
        $city_id = $row['id']; // here we get the id so we can update the city later
    }
    if (strcasecmp($img, 'oldimg') == 0) {
        $img_SQL = "SELECT img FROM attractions WHERE id='" . $attractID . "'"; //to get the img
        $result = mysqli_query($connection, $img_SQL) or die(mysqli_error($connection));
        if ($result) {
            $row = mysqli_fetch_array($result);
            $img = $row['img']; // here we get the id so we can update the city later
        }
    }
    $stmt = mysqli_prepare($connection, "UPDATE attractions SET attractionName = ?, field = ?, description=?, img=?, city_id=? where id = ? ;");
    mysqli_stmt_bind_param($stmt, "ssssii", $title, $Category, $desc, $img, $city_id, $attractID);
    $updateResult = mysqli_stmt_execute($stmt);
    if ($updateResult) {// to check if updating the attraction was succefull then go to the admin home page
        if($city_id==1)
            $location="attractions.php?city_id=1";
        else if ($city_id==2)
            $location="attractions.php?city_id=2";
        else
            $location="attractions.php?city_id=3";
        echo 
         ' <script>
             x=confirm("The attraction is updated successfully,would you like to view it in the attraction\'s page");
    if (x)
location.href = "'.$location.'"
    else
    location.href = "adminHP.php"</script>';

                
        exit;
    } else {// if wasn't succesfull then display appropiate message 
        echo '<script>alert("Error in updating the attraction.");</script>';
        echo '<script> window.location.href = "adminHP.php"</script>';
        exit;
    }
}

    