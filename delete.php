<?php
    include 'dataConncetion.php';

if (isset($_GET['attraction_id'])) {

    $attrID = $_GET['attraction_id']; // to get request id so we can now the service id and other things
       
 }
$data = mysqli_query($connection, "DELETE FROM attractions WHERE id ='" . $attrID . "'"); //delete query
if ($data){
    
   echo '<script>alert("The Attraction is successfully deleted.");</script>';
   echo '<script> window.location.href ="adminHP.php"</script>';

}
else{
    echo "<script>alert('the deletion process can not be completed please try again);</script>";
    echo '<script> window.location.href ="adminHP.php"</script>';
    
}
      