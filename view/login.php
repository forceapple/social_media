
     <!-- start wrapper -->
	   
       <!-- content -->
       <div id="login" class="valign-wrapper">
          <form id="loginForm" class="col s12">
             <h5 class="center-align function-heading">Welcome Back</h5>
            <div class="row">
              <div class="input-field col s12">
                <input id="username" type="text" required data-parsley-error-message="Required.">
                <label for="username">Username</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" required data-parsley-error-message="Required.">
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
  $(document).ready(
    function() {
		$("#loginButton").click(function() {
			$("#loginForm").parsley().validate();
			$.listen('parsley:form:success', function(){
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
						toast(resp.message, 2000);
						setInterval(function(){ location.href = "<?php echo ROOT_FOLDER; ?>"; }, 1000);
					} else {
						toast(resp.errors, 2000);
						$("#loginForm").parsley().reset();
					}
					
				});  	
			});
		}); 	
		
    });
</script>
</body>
</html>