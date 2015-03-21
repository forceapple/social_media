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
			async: false,
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
				var cardType, card;
				
				$("#content").append("<div id='card"+pid+"'></div>");
				//determine post type
				//post type 0 = text and link or image only
				if(postType == 0) 
				{
					//check if image
					IsValidImageUrl(post[i], function(resp){
						//image
						cardType= "<div class='card-image'><a href='post.php?pid="+resp.pid+"'><img src='"+resp.post_text+"' class='post-image'/><span class='card-title'>"+resp.post_title+"</span></a></div>";
						card = "<div class='card'>"+cardType+"<div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php?pid="+resp.pid+"'><i class='mdi-communication-forum'></i> "+resp.num_comment+"</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'><a href='#'>"+resp.username+"</a></span></div></div>";
						$("#card"+resp.pid).append(card);
						//alert(card);
					}, function(resp){
						cardType = "<div class='card-content'><span class='card-title'><a href='"+resp.post_text+"' target='_blank'>"+resp.post_title+"</a></span></div>";
						card = "<div class='card'>"+cardType+"<div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php?pid="+pid+"'><i class='mdi-communication-forum'></i> "+resp.num_comment+"</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'><a href='#'>"+resp.username+"</a></span></div></div>";
						$("#card"+resp.pid).append(card);
						//alert(card);
					});		
					
				}
				else if (postType == 1)
				{
					//post type 1 = title and text
					var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='post.php?pid="+pid+"' class='post-link'>"+post[i].post_title+"</a></span><p>"+post[i].post_text+"</p></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php?pid="+post[i].pid+"'><i class='mdi-communication-forum'></i> "+post[i].num_comment+"</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'><a href='#'>"+post[i].username+"</a></span></div></div>";
				}
				$("#card"+post[i].pid).append(card);	
			
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
	
function IsValidImageUrl(url, callback, error) {
    console.log(url.post_text);
	$("<img>", {
        src: url.post_text,
		async: false,
        error: function() { error(url); },
        load: function() { callback(url); }
    });
}
</script>
</body>
</html>