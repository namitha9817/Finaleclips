<div>
  <?php 
session_start();
require_once("../connection.php");
if(isset($_GET['user'])){
            $_GET['user'] = $_GET['user'];
          }else{
            $q='SELECT `sender_name`, `reciever_name` FROM `messages` WHERE `sender_name` = "'.$_SESSION["userLoggedIn"].'" or `reciever_name` = "'.$_SESSION["userLoggedIn"].'" ORDER BY `date_time` DESC LIMIT 1';

            $r = mysqli_query($con, $q);
            if($r){
              if(mysqli_num_rows($r)>0){
                while($row = mysqli_fetch_assoc($r)){
                  $sender_name = $row['sender_name'];
                  $reciever_name = $row['reciever_name'];

                  if($_SESSION["userLoggedIn"] == $sender_name){
                    $_GET['user'] = $reciever_name;
                  }else{
                    $_GET['user'] = $sender_name;
                  }
                  }

              }else{
                echo 'no messages from you';
                $no_message =true;
              }
          }else{
          echo $q;
          }}

          if($no_message == false){
          $q='SELECT * FROM `messages` WHERE `sender_name`="'.$_SESSION["userLoggedIn"].'" AND `reciever_name` = "'.$_GET["user"].'"
           OR `sender_name`="'.$_GET["user"].'" And `reciever_name` = "'.$_SESSION["userLoggedIn"].'"';

          $r = mysqli_query($con, $q);

          if($r){
            while($row = mysqli_fetch_assoc($r)){
              $sender_name = $row['sender_name'];
              $reciever_name = $row['reciever_name'];
              $message = $row['message_text'];

              if($sender_name == $_SESSION['userLoggedIn'])   {?>

                <div class="grey-message">
                  <a href="#"><?php echo "You";?></a>
                  <p><?php echo $message; ?></p>
                 </div>

              <?php
              }else{  ?>
                 <div class="white-message">
              <a href="#"><?php echo $sender_name; ?></a>
            <p><?php echo $message; ?></p>
           </div>

           <?php

              }
             }
           }
            
          else{
            echo $q; 
          }  }
          ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
var myVar = setInterval(myTimer, 1000);

function myTimer() {
  document.getElementById("demo").innerHTML +=data;
}
</script>
