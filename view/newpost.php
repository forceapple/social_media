<?php include('header.php'); ?>
        	
     <!-- start wrapper -->
       <div class="row">
	       
       <!-- content -->
        <div id="content" class="col m8">
        	<h1>New Post</h1>
	        <form action="../controller/listener.php" class="col l12 m12 s12 container" id="linkform" method="POST">
			    <div class="row">
			      <div class="input-field col l12 m12 s12">
			        <input id="link_title" name="link_title" type="text" class="validate">
			        <label for="link_title">Title</label>
			      </div>
			    </div>
			    <div class="row">
			      <div class="input-field col l12 m12 s12">
			        <input id="link_url" name="link_url" type="text" class="validate">
			        <label for="link_url">URL</label>
			      </div>
			    </div>
			    <div class="row">
			      <div class="input-field col l12 m12 s12">
			        <p>[[ Some information about submitting ]]</p>
			      </div>
			    </div>
			    <div class="row">
					<button class="btn waves-effect waves-light" type="submit" name="link_submit">Submit
					    <i class="mdi-content-send right"></i>
					</button>
			    </div>
			 </form>
       
          
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
<script type="text/javascript">

$(document).ready(function(){
	$('#linkform').submit(function(e){
		var formData = {
			'phase' : 0,
			'uid' : 1,
			'title' : $('#link_title').val(),
			'url' : $('#link_url').val(),
			'type' : 1
		}

		console.log(formData);
		$.ajax({
			type: "POST",
			url: '../controller/listener.php',
			data: formData,
			dataType: 'json'
		})
		.done(function(resp){
			console.log(resp);
		})
		.fail(function(err){
			console.log(err);
		})
		e.preventDefault();
	})

})
	
</script>
</body>
</html>