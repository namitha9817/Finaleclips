<?php 
require_once("../connection.php");
if(isset($_POST['user'])){
	$q ='SELECT * FROM users WHERE username = "'.$_POST['user'].'"';
	$r = mysqli_query($con, $q);

	if($r){
		if(mysqli_num_rows($r)>0){
			while($row =mysqli_fetch_assoc($r)){
				$username = $row['username'];

				echo'<option value ="'.$username.'">';

		}}else{
			echo "1";
		}
	}else{
		echo $q;
 }
	}
?>
	