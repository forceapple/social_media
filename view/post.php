<?php
	include("../controller/main.php");
	$pid = $_GET['pid'];
	
	$main = new noniController();
	print_r($main->get_post($pid));

?>

<!doctype html>
<html>
<head>
<!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Let browser know website is optimized for mobile-->
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <title>Reddit?</title>

</head>

<body>
	<div class="container">
    	<div class="row">
        	<div class="col s12" id="header">NONI</div>
        </div>
  
     <!-- start container -->
       <div class="row">
       <!-- content -->
        <div class="col m8">
          <div class="card">
          
   			<!-- if else POST LINK -->
            <div class="card-content">
              <span class="card-title"><a href="#">Link Card</a></span>
               <p>lorem ipsum dolor blaaaaah</p>
            </div><!-- /POST LINK -->
            
            <!-- if else POST IMAGE -->
             <div class="card-image">
              <img src="http://www.evolutionsupply.com/_images/image9.gif" class="post-image">
              <span class="card-title">Card Title</span>
            </div><!--/POST IMAGE -->
            
            
            <div class="card-action">
            	 <a href="#"><i class="mdi-hardware-keyboard-arrow-up"></i></a><div class="vote">2 votes</div><a href="#"><i class="mdi-hardware-keyboard-arrow-down"></i></a>
            </div>
          </div>
          
          <!-- start comments -->
          <h2># comments</h2>
           <div class="col m8">
           		<table  class="comments-table">
               <tbody>
                  <tr>
                    <td class="user-avatar-td"> <img src="https://shechive.files.wordpress.com/2012/08/0-kids-fashion-1.jpg" alt="" class="circle user-avatar"></td>
                    <td>Name</td>
                  </tr>
                  <tr>
                    <td colspan="2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sagittis vestibulum consectetur. Praesent efficitur urna velit, a euismod libero ullamcorper pretium. Donec dignissim neque quis nibh euismod, non maximus sem viverra. Aenean quis urna sapien. Duis feugiat vehicula pretium. Sed sed nisi enim. Quisque justo nulla, ornare non sem ut, laoreet elementum sem.</td>
                  </tr>
       		 </tbody>
             </table>
			</div>
          
         </div><!-- /content-->
         
         <!-- sidebar: username? -->
          <div class="col m4">
           <form id="insertUserForm">
        <div class="row block-content">
        	<div class="col">
        		<div class="form-group center med-content">
                    	<label>Username</label>
                           <input type="text" class="form-control" id="uid" value="1" placeholder="user ID" required>
               </div>
           </div>
    		<button id="loginButton" class="btn waves-effect waves-light btn-large" type="submit" name="action">LOGIN<i class="mdi-hardware-keyboard-alt right"></i></button>
           <div id="insertUserMsgBox" class="col s3 center med-content">	
           </div>
        </div>
        </form>
        </div><!-- end sidebar -->
      </div>
     
     <!-- end CONTAINER -->
     
  
    </div><!-- end of container-->

	  <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
  $(document).ready(
    function() {
	
    });
</script>
</body>
</html>