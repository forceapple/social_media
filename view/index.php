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
        <div id="content" class="col m8">
        
       
          
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
		//post type 2 = 
		  $.ajax({
        url:'../controller/listener.php',
        data: {phase: 0},
        type: 'GET',
        dataType: 'json',
        success: function(post){
          console.log(post);
		  
		  var contentHTML = "";
		  var cardHTML="";
		  for (var i in post)
		  {
		  	var pid = parseInt(post[i].pid);
			var postType = post[i].post_type;
			
			//determine post type
			if(postType == 0) 
			{
				//post type 0 = link only
				var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='"+post[i].text+"'>"+post[i].post_title+" by <span class='username'>"+post[i].username+"</span></a></span><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php'># of comments</a></div></div>";
					$("#content").append(card);	
					console.log(card);	
			}
			else if (postType == 1)
			{
				//post type 1 = image with external a link<br>
				$("#content").append("<div class='card'><div class='card-image'><img src='"+post[i].post_image+"' class='post-image'><span class='card-title'>"+post[i].post_title+" by <span class='username'>"+post[i].username+"</span></span></div><div class='card-content'><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php'># of comments</a></div></div>");				
			}
					
		
		  }
        },
        error: function(err){
          console.log(err);
          console.log('fail');
        }
      })

		  
    });
</script>
</body>
</html>