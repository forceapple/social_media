<!doctype html>
<html>
<head>
<!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Let browser know website is optimized for mobile-->
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <title>Reddit? No. It's Noni.</title>

</head>

<body>

	<div id="wrapper">
    
    	<header>
        	<div class="col s12" id="header"><a href="index.php">NONI</a></div>
        </header>
        
        <!-- Menu: when not in session -->
<nav>
  <div class="nav-wrapper">
  	 <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
  	  <ul id="nav-mobile" class="left hide-on-med-and-down">
      	    <li><a href="#">Menu when Logged In <i class="mdi-action-trending-neutral right"></i></a></li>
              <li><a href="index.php">Home</a></li>
              <li><a href="newpost.php">New Post</a></li>
              <li><a href="myposts.php">My Posts</a></li>   
              <li><a href="mylikedposts.php">Liked</a></li> 
              <li><a href="mydislikedposts.php">Disliked</a></li>
              <li><a href="savedposts.php">Saved</a></li>
              <li><a href="mycomments.php">Comments</a></li>
              <li><a href="#">Log Out</a></li>
              
              <li><a href="#">Gordon<i class="mdi-action-trending-neutral right"></i></a></li>
              <li><a href="index.php">Home</a></li>
              <li><a href="register.php">Register</a></li>
              <li><a href="login.php">Log In</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="index.php">Home</a></li>
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Log In</a></li>
      </ul>
  	<ul class="right hide-on-med-and-down">
    	<li style="padding-left: 10px;"><form action="search.php" method="get">
        <div class="input-field">
          <input id="for" name="for" type="text" required>
          <label for="for"><i class="mdi-action-search"></i></label>
        </div>
      </form></li>
    </ul>
  </div>
</nav>

        