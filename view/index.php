<?php include('header.php'); ?>
        	
     <!-- start wrapper -->
       <div class="row">
	       
       <!-- content -->
        <div id="content" class="col m8">
	        <!--loading circle -->
	        <div id="post-loading" style="display:none" class="preloader-wrapper big active">
			    <div class="spinner-layer spinner-blue-only">
			      <div class="circle-clipper left">
			        <div class="circle"></div>
			      </div><div class="gap-patch">
			        <div class="circle"></div>
			      </div><div class="circle-clipper right">
			        <div class="circle"></div>
			      </div>
			    </div>
			</div>
       
          
         </div><!-- /content-->
         
		<?php include('sidebar.php'); ?>
        
      </div>
     
     <!-- start footer -->
     	<?php include('footer.php'); ?>
     <!-- end footer -->
     
     <!-- end wrapper -->
     
  
  </div><!-- end of container-->

	  <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
  $(document).ready(
    function() {

		$.ajax({
			url:'../controller/listener.php',
			data: {phase: 0},
			type: 'GET',
			dataType: 'json',
			beforeSend: function(){
				$('#post-loading').show();
			},
			success: function(post){
				$('#post-loading').hide();
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
					var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='"+post[i].text+"?pid="+pid+"' class='post-link'>"+post[i].post_title+" by <span class='username'>"+post[i].username+"</span></a></span><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php'># of comments</a></div></div>";
						$("#content").append(card);	
						console.log(card);	
				}
				else if (postType == 1)
				{
					//post type 1 = image with external a link<br>
					$("#content").append("<div class='card'><div class='card-image'><a href='post.php?pid="+pid+"' class='post-link'><img src='"+post[i].post_image+"' class='post-image'></a><span class='card-title'><span class='imageLink'><a href='post.php?pid="+pid+"' class='post-link'>"+post[i].post_title+"</a></span> by <span class='username'>"+post[i].username+"</span></span></div><div class='card-content'><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php'># of comments</a></div></div>");				
				}
						
			
			  }
			},
			error: function(err){
			  console.log(err);
			  console.log('fail');
			}
		  });
		  
		$(".post-link").on("click", function() {
			 
		});

		  
    });
</script>
</body>
</html>