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
			  
			  for (var i in post)
			  {
				var pid = parseInt(post[i].pid);
				var postType = post[i].post_type;
				
				//determine post type
				if(postType == 0) 
				{
					//check if image
					var cardType= "<div class='card-image'><a href='post.php?pid="+post[i].pid+"'><img src='"+post[i].post_text+"' class='post-image'/><span class='card-title'>"+post[i].post_title+"</span></a></div>";
					var testImage = "<img src='"+post[i].post_text+"' class='post-image' />";
					
					$(testImage).error(function() {
						//just URL
						cardType = "<div class='card-content'><span class='card-title'><a href='"+post[i].post_text+"' target='_blank'>"+post[i].text+"</a></span></div>";
					});
					
					//post type 0 = text and link or image only
					var card = "<div class='card'>"+cardType+"<div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php?pid="+pid+"'><i class='mdi-communication-forum'></i> "+post[i].num_comment+"</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'><a href='#'>"+post[i].username+"</a></span></div></div>";
				}
				else if (postType == 1)
				{
					//post type 1 = title and text
					var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='post.php?pid="+pid+"' class='post-link'>"+post[i].post_title+"</a></span><p>"+post[i].post_text+"</p></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php'># of comments</a>posted by <span class='username'>"+post[i].username+"</span></div></div>";
				}
				$("#content").append(card);	
			
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