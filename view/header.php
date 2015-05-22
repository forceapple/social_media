<!doctype html>
<html>
<head>
<!--Import materialize.css-->
  <?php $folder = "/social_media/"; 
    $server_path = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $folder;
    define("ROOT_FOLDER", $server_path);
   ?>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_FOLDER; ?>css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="<?php echo ROOT_FOLDER; ?>css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Let browser know website is optimized for mobile-->
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <title>Reddit? No. It's Noni.</title>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo ROOT_FOLDER; ?>js/materialize.min.js"></script>
    <script src="<?php echo ROOT_FOLDER; ?>js/parsley.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
</head>

<body>

	<div id="wrapper">
    	<header>
        	<div class="col s12" id="header"><a href="<?php echo ROOT_FOLDER; ?>">NONI</a></div>
        </header>
        
        <!-- Menu: when not in session -->
<nav class="light-green darken-1">
  <div class="nav-wrapper">
  	 <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
  	  <ul id="nav-mobile" class="left hide-on-med-and-down">
      	<?php if (isset($_SESSION['username'])) { ?>
        	  <li>&nbsp;&nbsp;Welcome, <?php echo $_SESSION['username']; ?>&nbsp;&nbsp;</li>
              <li><a href="<?php echo ROOT_FOLDER; ?>">Home</a></li>
              <li><a href="<?php echo ROOT_FOLDER; ?>post/create">Create Post</a></li>
              <li><a href="<?php echo ROOT_FOLDER; ?>logout">Log Out</a></li>
            <?php } else { ?>
              <li><a href="<?php echo ROOT_FOLDER; ?>">Home</a></li>
              <li><a href="<?php echo ROOT_FOLDER; ?>register">Register</a></li>
              <li><a href="<?php echo ROOT_FOLDER; ?>login">Log In</a></li>
            <?php  } ?>  
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="<?php echo ROOT_FOLDER; ?>">Home</a></li>
          <li><a href="<?php echo ROOT_FOLDER; ?>register">Register</a></li>
          <li><a href="<?php echo ROOT_FOLDER; ?>login">Log In</a></li>
      </ul>
  	<ul class="right hide-on-med-and-down">
    	<li style="padding-left: 10px;"><form action="<?php echo ROOT_FOLDER; ?>search.php" method="get">
        <div class="input-field">
          <input id="for" name="for" type="text" required>
          <label for="for"><i class="mdi-action-search"></i></label>
        </div>
      </form></li>
    </ul>
  </div>
</nav>

