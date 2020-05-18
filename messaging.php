<?php 
include("includes/header.php");

?>
<!DOCTYPE html>
<html>
<style>
#container{box-shadow:2px 2px 10px  #000000; width:1350px; height:600px; margin:2% auto; border-radius:1%; overflow:hidden;}
#menu{
	background: #808080;
	color: white;
	padding: 1%;
	font-size:30px;
}

#left-col, #right-col{
	position:relative;
	float:left;
	height:90%;
}

#left-col{width:30%;}
#right-col{width:69%; border:1px solid #efefef;}

</style>
<body>
	<?php require_once("includes/classes/new-message.php"); ?>

 <div id="container">
 	<div id="menu">
 		<?php
if(isset($_SESSION["userLoggedIn"])) {
    echo $userLoggedInObj->getName();
}
?>
    
    </div>

    <div id="left-col">
    	<?php require_once("includes/classes/left-col.php"); ?>
    		<!--end of left-col-container-->
    	<!--end of left colom -->
    
</div>

    <div id="right-col">

    	<?php require_once("includes/classes/right-col.php"); ?>
    	
    	<!--end of right col -->
    </div>
</div>




</body>
</html>