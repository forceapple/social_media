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
    <title>Reddit?</title>

</head>

<body>

	<div class="container">
    	<header>
        	<div class="col s12" id="header"><a href="index.php">NONI</a></div>
        </header>
        
        <!-- Menu: when not in session -->
<nav>
  <div class="nav-wrapper">
  	<ul class="left hide-on-med-and-down">
    	<li style="padding-left: 10px;"><form>
        <div class="input-field">
          <input id="search" type="text" required>
          <label for="search"><i class="mdi-action-search"></i></label>
        </div>
      </form></li>
    </ul>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="#">Menu for unregistered users<i class="mdi-action-trending-neutral right"></i></a></li>
      <li><a href="index.php">Home</a></li>
      <li><a href="#">Register</a></li>
      <li><a href="#">Log In</a></li>
    </ul>
  </div>
</nav>

        <!-- Menu: Make visible only when in session -->
<nav>
  <div class="nav-wrapper">
  	<ul class="left hide-on-med-and-down">
    	<li style="padding-left: 10px;"><form>
        <div class="input-field">
          <input id="search" type="text" required>
          <label for="search"><i class="mdi-action-search"></i></label>
        </div>
      </form></li>
    </ul>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="#">Menu when Logged In <i class="mdi-action-trending-neutral right"></i></a></li>
      <li><a href="index.php">Home</a></li>
      <li><a href="#">My Posts</a></li>   
      <li><a href="#">Liked Posts</a></li> 
      <li><a href="#">Disliked Posts</a></li>
      <li><a href="#">Comments</a></li>
      <li><a href="#">Log Out</a></li>
    </ul>
  </div>
</nav>
        