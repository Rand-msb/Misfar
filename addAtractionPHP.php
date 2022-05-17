<!-- this page for adding the attractions in the database -->
<?php
include 'dataConncetion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {// to check request method
    $img = $_FILES['img']['name'];
    $destination = 'uploads/' . $img;
    $file = $_FILES['img']['tmp_name'];
    move_uploaded_file($file, $destination);
    $title = $_POST['title'];
    $att_SQL = "SELECT id, attractionName FROM attractions";
    $att_result = mysqli_query($connection, $att_SQL) or die(mysqli_error($connection));
    while ($row1 = mysqli_fetch_array($att_result)) {
        if (strcmp($title, $row1['attractionName']) == 0) {
            echo '<script>var result = confirm("Attraction already exists in the database.\r\nDo you want to update the attraction?");
                if (result){
                window.location.href = "updateAtraction.php?attractID=' . $row1['id'] . '";
                } else {
                 window.location.href = "adminHP.php"
                 };</script>';
            exit;
        }
    }
    $Category = $_POST['Category'];
    $desc = $_POST['desc'];
    $city = $_POST['city'];
    $city_idSQL = "SELECT id FROM city WHERE city='" . $city . "'"; //to get the id of the selcted city
    $result = mysqli_query($connection, $city_idSQL) or die(mysqli_error($connection));
    if ($result) {
        $row = mysqli_fetch_array($result);
        $city_id = $row['id']; // here we get the id so we can add the city
    }
    $stmt = mysqli_prepare($connection, "INSERT INTO attractions (attractionName, field, description, img ,city_id) VALUES (?,?,?,?,?)"); //inserting to the attractions table in the databse
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $Category, $desc, $img, $city_id);
    $insertResult = mysqli_stmt_execute($stmt);
    if ($insertResult) {// to check if adding the attraction was succefull then go to the admin home page
        echo '<script>alert("This attraction have been added successfully.");</script>';
        echo '<script> window.location.href = "adminHP.php"</script>';
        exit;
    } else {// if wasn't succesfull then display appropiate message 
        echo '<script>alert("Error in adding the attraction.");</script>';
        echo '<script> window.location.href = "adminHP.php"</script>';
        exit;
    }
}    