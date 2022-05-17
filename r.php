<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->

<?php
session_start();
include 'dataConncetion.php';
if (isset($_POST['Log-in'])) {
    $result = mysqli_query($connection, "SELECT * FROM  admin WHERE username = '" . $_POST['username'] . "'");

    if (mysqli_num_rows($result)) { //if not zero means the user signed up 
        $row = mysqli_fetch_array($result);

        if (password_verify($_POST['password'], $row['password'])) {//successfuly loged in -> create sessions +redirect to homepage 
            $_SESSION['username'] = $row['username'];
            $x = $_SESSION['username'];
            echo '<script> window.location.href = "adminHP.php"</script>';
            echo"<script>c onsole.log($x);</script>";
        } else {//incorrect password
            echo "<script>alert('Incorrect password,Try again');</script>";
            echo '<script> window.location.href = "index.php"</script>';
            exit;
        }
    } else {//incorrect ID 
        echo '<script>alert("Incorrect username,Try again");</script>';
        echo '<script> window.location.href = "index.php"</script>';
        exit;
    }
}
if (isset($_POST['Sign'])) {//take the inputs from the sign up form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $select = mysqli_query($connection, "SELECT * FROM admin WHERE username = '" . $_POST['username'] . "'"); //check whether the admin signed up before 
    $select2 = mysqli_query($connection, "SELECT * FROM admin WHERE email = '" . $_POST['email'] . "'"); //check whether the admin signed up before 

    if (mysqli_num_rows($select)) { //if Zero==false then a new Employee 
        echo '<script>alert("The username is already taken please try again");</script>';
        echo '<script> window.location.href = "index.php"</script>';
        exit();
    } elseif (mysqli_num_rows($select2)) {
        echo '<script>alert("This email address is already being used,Try another one");</script>';
        echo '<script> window.location.href = "index.php"</script>';
        exit();
    } else {

        $stmt = mysqli_prepare($connection, "INSERT INTO admin (username,password,name,email) VALUES (?, ?, ?,?)");
        mysqli_stmt_bind_param($stmt, "ssss", $username, $pass, $name, $email);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            $select = mysqli_query($connection, "SELECT * FROM admin WHERE  username = '" . $_POST['username'] . "'"); //create sessions +redirect to log in page
            $row = mysqli_fetch_array($select);

            $_SESSION['username'] = $row['username'];
            header("Location:adminHP.php");
        } else {
            echo"there were errors";
        }
    }
}/*         * *******END OF SIGN UP PHP********** */
       