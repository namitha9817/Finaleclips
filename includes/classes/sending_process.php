<?php 
session_start();
require_once("../connection.php");
if(isset($_SESSION['userLoggedIn']) and isset ($_GET['user'])){
if(isset($_POST['text'])){

	if($_POST['text'] != ''){
    $sender_name = $_SESSION["userLoggedIn"];
	$reciever_name = $_GET["user"];
	$message= $_POST["text"];
	$date = date("Y-m-d h:m:s");

	$q='INSERT INTO `messages` (`id`, `sender_name`, `reciever_name`, `message_text`, `date_time`) VALUES ("", "'.$sender_name.'", "'.$reciever_name.'", "'.$message.'", "'.$date.'" )';
    $r = mysqli_query($con, $q);

    if($r){
    	?>
    	<div class="white-message">
              <a href="#"><?php echo $sender_name; ?></a>
            <p><?php echo $message; ?></p>
           </div>

           <?php
    }else{
    	echo $q;
    }
}

else{
	echo 'problem with text';
}


}else{

	echo 'Please login or select a user to send a message';
}}

?>