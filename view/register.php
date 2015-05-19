   <!-- start wrapper -->

	   
       <!-- content -->
       <div id="login" class="valign-wrapper">
          <form id="loginForm" class="col s12">
             <h5 class="center-align function-heading">Sign Up for Fun</h5>
            <div class="row">
              <div class="input-field col s6">
                <input id="first_name" type="text">
                <label for="first_name">First Name</label>
              </div>
              <div class="input-field col s6">
                <input id="last_name" type="text">
                <label for="last_name">Last Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="username" type="text" required>
                <label for="username">Username</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password1" type="password" required>
                <label for="password">Password</label>
              </div>
            </div>
             <div class="row">
              <div class="input-field col s12">
                <input id="password2" type="password" class="validate" data-parsley-equalto="#password1" required>
                <label for="password">Confirm Password</label>
              </div>
             </div>
              <div class="row">
              <div class="input-field col s12">
                <input id="email" type="email" required>
                <label for="email">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="location" type="text" required>
                <label for="location">Location</label>
              </div>
            </div>
             
            <div class="row">
              <div class="center-align col s12">
                <button type="submit" id="registerButton" class="waves-effect waves-light btn-large">Register</button>
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

		  
    });
</script>
</body>
</html>