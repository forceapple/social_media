   <!-- start wrapper -->
	   
       <!-- content -->
       <div id="register" class="valign-wrapper">
          <form id="registerForm" class="col s12" method="POST">
             <h5 class="center-align function-heading">Sign Up for Fun</h5>
            <div class="row">
              <div class="input-field col s6">
                <input id="first_name" type="text" required data-parsley-error-message="Required.">
                <label for="first_name">First Name</label>
              </div>
              <div class="input-field col s6">
                <input id="last_name" type="text" required data-parsley-error-message="Required.">
                <label for="last_name">Last Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="username" type="text" required data-parsley-error-message="Required.">
                <label for="username">Username</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password1" type="password" required data-parsley-error-message="Required.">
                <label for="password">Password</label>
              </div>
            </div>
             <div class="row">
              <div class="input-field col s12">
                <input id="password2" type="password" class="validate" data-parsley-equalto="#password1" required data-parsley-error-message="Both passwords have to match.">
                <label for="password">Confirm Password</label>
              </div>
             </div>
              <div class="row">
              <div class="input-field col s12">
                <input id="email" type="email" required data-parsley-error-message="Required.">
                <label for="email">Email</label>
              </div>
            </div>
            <div class="row">
             	<div class="input-field col s12">
                <input id="profilePic" type="text" required data-parsley-error-message="Required.">
                <label for="profilePic">Profile Picture (http://)</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="location" type="text" required data-parsley-error-message="Required.">
                <label for="location">Location</label>
              </div>
            </div>
            <div class="row">
              <div class="center-align col s12" style="padding-top:1.5rem;">
                <button type="button" id="registerButton" class="waves-effect waves-light btn-large">Register</button>
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
		
		$("#registerButton").click(function() {
			$("#registerForm").parsley().validate();
			$.listen('parsley:form:success', function(){
				$.ajax({
					url: 'controller/listener.php',
					dataType:"json",
					type: "POST",
					data: {
						  phase:      8,
						  f_name:     $("#first_name").val(),
						  l_name:     $("#last_name").val(),
						  username:   $("#username").val(),
						  password:   $("#password1").val(),
						  email:      $("#email").val(),
						  profilePic: $("#profilePic").val(),
						  location:   $("#location").val()
						},
					}).done(function(resp) {
						if (resp.success) 
					{
						toast(resp.message, 3000);
						setInterval(function(){ location.href = "<?php echo ROOT_FOLDER; ?>"; }, 1000);
					} else {
						toast(resp.errors, 3000);
						$("#registerForm").parsley().reset();
					}
				}); 
			});
			
		});
    });
</script>
</body>
</html>