<?php

include 'dataConncetion.php';
//echo 'in new review';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {// to check the method
    if (isset($_POST['rev'])) {//to know if the field of the review is set
        $count = 0; //for counting number of files , possible values are 0,1,2
        $exitLoop = false;
        $rev = $_POST['rev']; //to get the written review

        if (isset($_FILES['files']['name'][0])) {//if  one file uploaded
            $filename = $_FILES['files']['name'][0];
            if ($filename != '') {

                $count += 1;
            }
        }
        if (isset($_FILES['files']['name'][1])) {//if the another file was uploaded 
            $count += 1;
        }

        for ($i = 0; $i < $count; $i++) {//to upload the files 
            $filename = $_FILES['files']['name'][$i];
            $destination = 'uploads/' . $filename;
            $file = $_FILES['files']['tmp_name'][$i];

            move_uploaded_file($file, $destination);

            $exitLoop = true;
        }

        if (isset($_GET['attractionName'])) {
            $att_name = $_GET['attractionName'];
//                    echo $att_name;
        }
//        echo 'working so far';

        $attInfo_sql = "SELECT `id` FROM `attractions` WHERE `attractionName`= '" . $att_name . "'";
//        echo $attInfo_sql;

        $attInfo_result = mysqli_query($connection, $attInfo_sql);

        $attInfo_rows = mysqli_fetch_array($attInfo_result);

        $att_id = $attInfo_rows['id']; //store attraction id in the variable att_id
        $file = ''; //to upload nothing if the count=0 for both attachment or 1 for attachment in the database

        if ($count == 0) {//check number of files
            $stmt = mysqli_prepare($connection, "INSERT INTO reviews( attraction_ID, review, attachment1 ,attachment2) VALUES (?,?,?,?)"); //imserting to the review table in the databse
            mysqli_stmt_bind_param($stmt, "isss", $att_id, $rev, $file, $file);
            $add_review = mysqli_stmt_execute($stmt);
        } else if ($count == 1) {
            $stmt = mysqli_prepare($connection, "INSERT INTO reviews( attraction_ID, review, attachment1 ,attachment2) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "isss", $att_id, $rev, $_FILES['files']['name'][0], $file);
            $add_review = mysqli_stmt_execute($stmt);
        } else if ($count == 2) {
            $stmt = mysqli_prepare($connection, "INSERT INTO reviews( attraction_ID, review, attachment1 ,attachment2) VALUES (?,?,?,?)");

            mysqli_stmt_bind_param($stmt, "isss", $att_id, $rev, $_FILES['files']['name'][0], $_FILES['files']['name'][1]);
            $add_review = mysqli_stmt_execute($stmt);
        }
        if ($add_review) {
            echo '<script>alert("your review have been posted successfully.");</script>';
                    echo '<script> window.location.href = "attractionReview.php?attraction_id=' . $att_id . '"</script>';

        } else {// if insert to the database wasn't succesfull
            echo '<script>alert("Error in filling review.");</script>';
//             header("Location:attractionReview.php");
        }
    }
}else {
    header("Location:newReview.php");  // to stay in the new Review page
}

?>

