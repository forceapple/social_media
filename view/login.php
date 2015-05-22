
     <!-- start wrapper -->
	   
       <!-- content -->
       <div id="login" class="valign-wrapper">
          <form id="loginForm" class="col s12">
             <h5 class="center-align function-heading">Welcome Back</h5>
            <div class="row">
              <div class="input-field col s12">
                <input id="username" type="text" required>
                <label for="username">Username</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" required>
                <label for="password">Password</label>
              </div>
            </div>
            <div class="row">
              <div class="center-align col s12">
                <button type="button" id="loginButton" class="waves-effect waves-light btn-large">Log In</button>
              </div>
            </div>
           
          </form>
</div>
            
      <!-- /content-->
        

     
     <!-- start footer -->
     <!-- end footer -->
     
     <!-- end wrapper -->
     
  
  </div><!-- end of container-->

	  <!--Import jQuery before materialize.js-->
      <script>
	  $('#loginForm').parsley();
  $(document).ready(
    function() {
		$("#loginForm").click(function(e) {
			e.preventDefault();
			$.ajax({
				url: 'controller/listener.php',
				data: { phase: 7, username: $("#username").val(), password: $("#password").val() },
				dataType: "json",
				type: "POST",
				success: function(resp) {
					console.log(resp);
					//store user data in session
				}
			}).done(function(resp) {
				if (resp.success) 
				{
					toast(resp.message, 4000);
    				setInterval(function(){ location.href = "<?php echo ROOT_FOLDER; ?>"; }, 2000);
				} else {
					toast(resp.errors, 4000);
					$("#username").val("");
					$("#password").val("")
				}
				
			});  	
		}); 	
		
    });
</script>
</body>
</html>