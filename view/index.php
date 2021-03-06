<?php include('header.php'); 
	$userId_session = 1;

?>
        	
     <!-- start wrapper -->     
       <div class="row">
	   
       <!-- content -->
        <div id="content" class="col m12">
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
            <div id="container">
            	
            </div>
       
          
         </div><!-- /content-->
        
      </div>
     
     <!-- start footer -->
     	<?php include('footer.php'); ?>
     <!-- end footer -->
     
     <!-- end wrapper -->
     
  
  </div><!-- end of container-->

	  <script src="js/packery.pkgd.min.js"></script>
      <script src='js/packery-custom.js'></script>
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
				var cardType, card;
				
				$("#container").append("<div id='card"+pid+"' class='item'></div>").packery();
				//var $container = $('#container').packery();
				//$container.append("<div id='card"+pid+"' class='item'></div>");
				//$container.packery( 'appended', "<div id='card"+pid+"' class='item'></div>" );	
				
				//determine post type
				//post type 0 = text and link or image only
				if(postType == 0) 
				{
					//check if image
					IsValidImageUrl(post[i], function(resp){
						//image
						cardType= "<div class='card-image'><a href='post.php?pid="+resp.pid+"'><img src='"+resp.post_text+"' class='post-image'/><span class='card-title'>"+resp.post_title+"</span></a></div>";
						card = "<div class='card'>"+cardType+"<div class='card-action'><div class='voteBox'><a href='#' class='userVote' data-votetype='0' data-pid='"+resp.pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='voteCount' id='voteBox"+resp.pid+"'>0</div><a href='#' data-votetype='1' class='userVote' data-pid='"+resp.pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-down'></i></a></div><div class='postDetails'><a href='post.php?pid="+resp.pid+"'><i class='mdi-communication-forum'></i> "+resp.num_comment+"</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'><a href='#'>"+resp.username+"</a></span></div></div></div>";
						
						$("#card"+resp.pid).append(card);
						$("#container").packery();	
						
						
					}, function(resp){
						cardType = "<div class='card-content'><span class='card-title'><a href='"+resp.post_text+"' target='_blank'>"+resp.post_title+"</a></span></div>";
						card = "<div class='card'>"+cardType+"<div class='card-action'><div class='voteBox'><a href='#' class='userVote' data-votetype='0' data-pid='"+resp.pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='voteCount' id='voteBox"+resp.pid+"'>0</div><a href='#' data-votetype='1' class='userVote' data-pid='"+resp.pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-down'></i></a></div><div class='postDetails'><a href='post.php?pid="+pid+"'><i class='mdi-communication-forum'></i> "+resp.num_comment+"</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'><a href='#'>"+resp.username+"</a></span></div></div></div>";
						$("#card"+resp.pid).append(card);
						$("#container").packery();	
						
					});		
					
				}
				else if (postType == 1)
				{
					//post type 1 = title and text
					var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='post.php?pid="+pid+"' class='post-link'>"+post[i].post_title+"</a></span><p>"+post[i].post_text+"</p></div><div class='card-action'><div class='voteBox'><a href='#' class='userVote' data-votetype='0' data-pid='"+post[i].pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='voteCount' id='voteBox"+pid+"'>0</div><a href='#' data-votetype='1' class='userVote' data-pid='"+post[i].pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-down'></i></a></div><div class='postDetails'><a href='post.php?pid="+post[i].pid+"'><i class='mdi-communication-forum'></i> "+post[i].num_comment+"</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'><a href='#'>"+post[i].username+"</a></span></div></div></div>";
					$("#card"+post[i].pid).append(card);
					$("#container").packery();	
					
				}
	
				getVoteCount(post[i].pid);
			
			  }
			},
			error: function(err){
			  console.log(err);
			  console.log('fail');
			}
		  }).done(function() {
			  	//when all cards are present bind event listener for votes
				votingFunc();  
				$("#container").packery('reloadItems');
		  });

		  
    });
	
function IsValidImageUrl(url, callback, error) {
    //console.log(url.post_text);
	$("<img>", {
        src: url.post_text,
        error: function() { error(url); },
        load: function() { callback(url); }
    });
}

function getVoteCount(pid) {
	$.ajax({
		url:'../controller/listener.php',
		data: {phase: 3, pid: pid},
		type: 'GET',
		dataType: 'json',
		success: function (voteNum) {
			$("#voteBox"+pid).text(voteNum);
		}, 
		error: function(err) {
			console.log(err);
		}
	});  
}

function votingFunc() {
	//vote click event listener binds dynamically made cards
	$(document).on("click", ".userVote", function(e) {
			e.preventDefault();
			var votetype = $(this).data('votetype');
			var pid = $(this).data('pid');
			var currVoteCount = parseInt($("#voteBox"+pid).text());
			var uservotetype = $(this).data('uservote');
			
			if (!votetype)
			{
				$("#voteBox"+pid).text(currVoteCount	+1);
				$(this).attr("class", "disableVote");
				$(this).siblings().closest("a").attr("class","userVote");
			}
			else {
				$("#voteBox"+pid).text(currVoteCount-1);
				$(this).attr("class", "disableVote");
				$(this).siblings().closest("a").attr("class","userVote");
			}
			$(document).on("click", ".disableVote", function(e) { e.preventDefault(); });
			
			var formData = {
				phase: 6, 
				uid: <?php echo $userId_session; ?>, //user in session
				pid: pid, 
				votetype: votetype 
			};
			//0 is upvote, 1 is minus
			$.ajax({
				url:'../controller/listener.php',
				data: formData,
				type: 'POST',
				dataType: 'json',
				success: function(resp) {
					console.log(formData);
					console.log(resp);
				},
				error: function(err) {
					
				}
			});
	});
}
</script>
</body>
</html>