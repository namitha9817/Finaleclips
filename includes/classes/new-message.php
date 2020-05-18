<style>
#new-message{
	display: none;
	box-shadow: 2px 10px 30px #000000;
	width:510px;
	position: fixed;
	top: 20%;
	background: white;
	z-index: 2;
	left: 50%;
	transform: translate(-50%, 0);
	border-radius: 5px;
	overflow: auto;


}
.m-header, .m-footer{background: #233070; margin: 0px; color: white; padding: 5px;}
.m-header{font-size: 20px;
text-align: center;}
.m-footer{}
.m-body{padding:5px;}

.message-input{width: 96%;}
</style>


<div id="new-message">
		<p class="m-header">New message</p>
		<p class="m-body">
			<form align="center" method="post">
               <input type="text" list="user" onkeyup="check_in_db()" class="message-input" placeholder="username" name="username" id="username"><br><br>


               <!--this data list to show available users -->

               <datalist id="user"></datalist>


               <textarea placeholder="Write your message" class="message-input"  name="message"></textarea><br><br>
               <input type="submit" value="send" name="send"  id="send"/>
               <button onclick="document.getElementById('new-message').style.display='none'">Cancel</button>
           </form>
			</p>
		<p class="m-footer">Click send to send</p>
		<!--end of new message-->
			</div>


<?php
require_once("includes/connection.php");

if(isset($_POST["send"])){
	$sender_name = $_SESSION["userLoggedIn"];
	$reciever_name = $_POST["username"];
	$message= $_POST["message"];
	$date = date("Y-m-d h:m:s");

	$q='INSERT INTO `messages` (`id`, `sender_name`, `reciever_name`, `message_text`, `date_time`) VALUES ("", "'.$sender_name.'", "'.$reciever_name.'", "'.$message.'", "'.$date.'" )';
    $r = mysqli_query($con, $q);
      if($r){
      	header("location:messaging.php?user=".$reciever_name);
      }else{
      	echo $q;
      }
}



?>

<script>

document.getElementById("send").disabled = true;

	function check_in_db(){
		var username = document.getElementById("username").value;
    $.post("includes/classes/check_in_db.php",
    {
    	user: username
    },
     function(data, status){

    if(data == 1){
     		document.getElementById("send").disabled = true;
     	}
     	else{
        document.getElementById("send").disabled = false;
    }

    document.getElementById("user").innerHTML = data;
 }

     );
}

</script>
