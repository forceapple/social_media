<?php
	include("../controller/main.php");
	
	//TO DO
	//session when login and register functions are done
	$uid = 1;

	include('header.php'); 
?>
     <!-- start wrapper -->
       <div class="row">
       <!-- content -->
       
        <div id="post-comments-container" class="col m8">
        	
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
          
          <!-- start comments -->
          <div id="comments-container" style="display:none;">
              
              <h5 id="comments-heading"></h5>
               <div class="col m12">
                  <table class="comments-table">
                   <tbody>
                 </tbody>
                 </table>
                </div>
                
             </div><!-- end of comments container-->
          
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
  $(document).ready(function() {
		
		//get comments by USER ID
		$.ajax({
			  type: 'POST',
			  url: '../controller/listener.php',
			  dataType: 'json',
			  type: 'GET',
			  data: { phase: 0, uid: <?php echo $uid; ?> },
			  beforeSend: function(){
					$('#post-loading').show();
					$('#comments-container').hide();
				},
			  success: function(post) {
					$('#post-loading').hide();
					$('#comments-container').show();
				}
			})
			.done(function(commentsObj){
				
				//will change when function is done
			  console.log(commentsObj);
			  var comment = ""; 
			  var num_comments = commentsObj.length;
			  var nullFlag = false;
			  
			  $(".comments-table tbody").empty();
			  if (commentsObj[0].cid === null)
			  {
				  num_comments = "no";
				  nullFlag = true;
			  }
			  $("#comments-heading").text( "You've made "+num_comments+" comments since you became a Noni lover");
			  
			  if (!nullFlag) 
			  {
					for(var i in commentsObj)
				  {
					if (i % 2 == 0)
						comment = '<tr class="odd-row">';
					else comment = '<tr class="even-row">';
					comment = comment + '<td class="user-avatar-td"> <img src="'+commentsObj[i].profile_img+'" alt="" class="circle user-avatar"></td><td>'+commentsObj[i].username+'</td></tr><tr><td colspan="2" class="commentsbox">'+commentsObj[i].comment+'</td></tr>';
					$(".comments-table tbody").append(comment);
				  }  
			  }
			  
			})
			.fail(function(err){
			  console.log(err);
			});
			
			
		});
</script>
</body>
</html>