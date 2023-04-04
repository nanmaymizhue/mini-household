<?php 
require base_path("database.php");


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user_id=$_SESSION['user']['id'];

    $query = sprintf("DELETE FROM cashflows WHERE id= '%d' AND user_id = $user_id",
                mysqli_real_escape_string($conn,$id));

    $result = mysqli_query($conn,$query);

    if($result){
        header('location:cashflow');
    }else{
        die("Error");
    }
    
}

?>

