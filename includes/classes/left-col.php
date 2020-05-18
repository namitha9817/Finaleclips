<style>
#left-col-container{width:100%; height:100%; margin:0px auto; overflow: auto;}

.gray-back{
	border: 1px solid black;
	padding: 5px;
	background: #efefef;
	margin:0px auto;
	margin-top: 2px;
	overflow: auto;
}
</style>
<div id="left-col-container">
<div onclick="document.getElementById('new-message').style.display='block'" class="white-back" style="cursor:pointer">
	<p align="center">New message</p>

</div>
<?php 

$q='SELECT DISTINCT `reciever_name`, `sender_name` FROM `messages` WHERE `sender_name`="'.$_SESSION["userLoggedIn"].'" or `reciever_name`="'.$_SESSION["userLoggedIn"].'" ORDER BY `date_time` DESC';

$r = mysqli_query($con, $q);
if($r){
	if(mysqli_num_rows($r)>0){
		$counter = 0;			
		$added_user = array();
        while($row=mysqli_fetch_assoc($r)){
        	$sender_name=$row['sender_name'];
        	$reciever_name=$row['reciever_name'];

        	if($_SESSION['userLoggedIn'] == $sender_name){
        		if(in_array($reciever_name, $added_user)){

        		}else{
        			?> <div class="gray-back">
				    	<?php echo '<a href="?user='.$reciever_name.'">'.$reciever_name.'</a>' ; ?>
				        </div>
				    	<?php


				    	$added_user = array($counter => $reciever_name);
				    	$counter++;

        		}
				}elseif($_SESSION['userLoggedIn'] == $reciever_name){
        		if(in_array($sender_name, $added_user)){

        		}else{
        			?> <div class="gray-back">
				    	<?php echo '<a href="?user='.$sender_name.'">'.$sender_name.'</a>' ; ?>
				        </div>
				    	<?php
				    	$added_user = array($counter => $sender_name);
				    	$counter++;

        		}
				}
        }
}else{
		echo 'no user';
	}

}else{
	echo $q;
}
?>
</div>
