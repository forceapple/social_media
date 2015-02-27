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
        
        <!-- insert 
         <form id="insertUserForm">
        <div class="row block-content">
        	<div class="col s3">
        		<div class="form-group center med-content">
                    	<label>User</label>
                           <input type="text" class="form-control" id="uid" value="1" placeholder="user ID" required>
               </div>
           </div>
           <div class="col s3">
        		<div class="form-group center med-content">
                    	<label>Add Profile Pic</label>
                        <input type="text" class="form-control" id="profilePicPath" placeholder="http://">
               </div>
           </div>
           <div class="col s3 center med-content">
        		<div class="form-group center">
                		<label>Insert a profile picture for user.</label>
                    	<button id="insertProfilePicButton" class="btn waves-effect waves-light btn-large" type="submit" name="action">SUBMIT<i class="mdi-action-perm-contact-cal right"></i></button>
               </div>
           </div>
           <div id="insertUserMsgBox" class="col s3 center med-content">	
           </div>
        </div>
        </form>
        

     
     <!-- start container -->
       <div class="row">
       <!-- content -->
        <div class="col m8">
          <div class="card">
            <div class="card-content">
              <span class="card-title"><a href="#">Link Card</a></span>
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#"># of comments</a>
            </div>
          </div>
          
            <div class="card">
            <div class="card-image">
              <img src="http://www.evolutionsupply.com/_images/image9.gif" class="post-image">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
             <a href="#"># of comments</a>
            </div>
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
    		<button id="insertProfilePicButton" class="btn waves-effect waves-light btn-large" type="submit" name="action">LOGIN<i class="mdi-action-perm-contact-cal right"></i></button>
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
		
		$("#uid-mirror").text($("#uid").val());	
		$("#uid").on("input", function() {
			$("#uid-mirror").text($("#uid").val());	
		});
			
		$("#getInfo").click(function() {
			$.ajax({
			url: "../controller/listen.php",
			data: {mode: 0, uid: $("#uid").val()},
			type: "GET",
			dataType: "json",
			success: function (resp) {
			  console.log(resp); 
			  
			 $("#images-div").html(' <table id="images-table" class="hoverable"><tbody></tbody></table><table id="profilepics-table" class="hoverable"><tbody></tbody></table>'); // clear whatever from previous
			  
			  //profile pics
			 $("#profilepics-table").append("<thead><th>Profile pics:</th></thead>");
			  
			  for (var i in resp["profile"]) {
					var profile = resp["profile"][i];
						
				  	$("#profilepics-table > tbody:last").append("<tr><td><img src="+profile+" class='myprofilepics circle images' data-profileid='"+i+"'/></td></tr>");  
			   }
				  
				$(".myprofilepics").click(function(e) {
						$.ajax({
							url: "../controller/listen.php",
							data: {mode:2, pid: $(this).data("profileid")},
							dataType:"json",
							type: "GET",
							success: function(profile_comment) {
								//console.log(e.target);
								//$(e.target).after( document.createTextNode( profile_comment ) );
								$(e.target).after("<div class='comment'>"+profile_comment+"</div>");
								
								
							},
							error: function(resp2) {
								console.log(resp);
							}
						});  
					});
			  
			  //images
			  $("#images-table").append("<thead><th>Images:</th></thead>");
			  for (var i in resp["images"]) {
				var image = resp["images"][i];
			
				  $("#images-table > tbody:last").append("<tr><td><img src="+image+" class='myimages circle images' data-imageid='"+i+"' /></td></tr>");  
			  }
				  
				  $(".myimages").click(function(e) {
						$.ajax({
							url: "../controller/listen.php",
							data: {mode:1, iid: $(this).data("imageid")},
							dataType:"json",
							type: "GET",
							success: function(image_comment) {
								//console.log("myimages "+image_comment);
								//console.log(e.target);
								//$(e.target).after( document.createTextNode( image_comment ) );
								$(e.target).after("<div class='comment'>"+image_comment+"</div>");
							},
							error: function(resp2) {
								console.log(resp);
							}
						});  
					});
			  
			},
			error: function(resp) {
				
				},
			  });   
	     });
			
			
		  $("#getAllCrazyImagesButton").click(function() {
			$.ajax({
			url: "../controller/listen.php",
			data: {phase: 0},
			type: "GET",
			dataType: "json",
			async: false,
			success: function (imagesArr) {
			  console.log(imagesArr); //supposedly returns an associative array
			  /*
			  $arr[0,1,2,3,..] where 0,1,2,3,.. is an associative array
				$arr = array{
					[0] => array{
					imagePath=>test.jpg,
					username=>test,
					profilePic=>testPic.jpg
					},
					[1] => array{
					imagePath=>test1.jpg,
					username=>test1,
					profilePic=>testPic1.jpg
					},
					etc.
				}
			  */
			  for (var i in imagesArr) {
				var imageRowHTML =  '<div class="row images-row"><div class="col-lg-4"><img src="'+imagesArr[i].imagePath+'" class="user_image" height=150 width=150 border=1 /></div><div class="col-lg-8 images-row-info"><div class="valign">Added by <a href="#">'+imagesArr[i].username+'</a> <img src="'+imagesArr[i].profilePic+'" class="profile_pic" height=50 width=50 border=1></div></div></div>';
				$("#images-div").append(imageRowHTML);  
			  }
			},
		  });   
		  });
		  
		  $("#insertProfilePicButton").click(function() {
			$.ajax({
			  url: "../controller/listen.php",
			  data: {phase: 1, ppic: $("#profilePicPath").val(), username: $("#uid").val()},
			  type: "POST",
			  dataType: "json",
			  async: false,
			  success: function (resp) {
				console.log(resp);
				$("#insertUserMsgBox").html("<br><p class='bg-success'>Successfully added a profile picture!</p>");  
			  },
			});   
		  });
		  
		  $("#insertImageButton").click(function() {
			$.ajax({
			  url: "../controller/listen.php",
			  data: {phase: 2, image: $("#imagePath").val(), username: $("#uid").val()},
			  type: "POST",
			  dataType: "json",
			  async: false,
			  success: function (resp) {
				console.log(resp);
				$("#insertImageMsgBox").html("<br><p class='bg-success'>Successfully added an image!</p>"); 
			  },
			});   
		  });
		  
    });
</script>
</body>
</html>