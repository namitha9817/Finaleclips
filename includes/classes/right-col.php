<style>
  #right-col-container{width:100%; height:100%; margin:0px auto; overflow: auto;}
#message-container{
  height: 80%; overflow: auto;}
.textarea{width: 100%; height: 10%; position: absolute; bottom: 5%; margin: 0px auto;}
.grey-message, .white-message{
  border: 1px solid black;
  width: 96%;
  padding: 5px;
  margin: 0px auto;
  margin-top: 2px;
  overflow: auto;
}

.grey-message{
  background: #efefef;
}
</style>

<div id="right-col-container">

  <div id="message-container">
     <?php

          $no_message = false;
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
          }  }?>

    
       
        
      </div>
      <form method="post" id="message-form">
      <textarea class="textarea" id="message_text" placeholder="Write your message"></textarea>
    </form>
        
      </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
  $("document").ready(function(event){

    $("#right-col-container").on('submit','#message-form', function(){
      var message_text= $("#message_text").val();
      $.post("includes/classes/sending_process.php?user=<?php echo $_GET['user'];?>",
     

        {
          text: message_text,
        },
        function real (data, status){
          
         $("#message_text").val("");
         
         document.getElementById("message-container").innerHTML += data;


        }
 );

    });
    $('#right-col-container').keypress(function(e){
     if(e.keyCode == 13 && !e.shiftKey){
        $("#message-form").submit();
     }

    });
  });
</script>
