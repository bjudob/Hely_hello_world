<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($con,$_POST['username']);
      $mypassword = mysqli_real_escape_string($con,$_POST['password']); 
      
      $sql = "SELECT username 
	          FROM users 
			  WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         
         header("location: ./helynevek/helynevek_menu.php");
      }else {
         $error = "Helytelen felhasználónév vagy jelszó!";
      }
   }
?>
<html>
   
   <head>
      <title>Kezdőoldal</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:25px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:25px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body >
	
      <div align = "center" >
         <div style = "width:300px; border: solid 2px #333333; " align = "center" >
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Bejelentkezés</b></div>
            <br>

               
               <form action = "" method = "post">
                  <label>Név : </label><input type = "text" name = "username" class = "box" required /><br /><br />
                  <label>Jelszó :</label><input type = "password" name = "password" class = "box" required /><br/><br />
                  <input type = "submit" value = " Bejelentkezés "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php if (isset($error)) echo $error; ?></div>

         </div>
			
      </div>

   </body>
</html>