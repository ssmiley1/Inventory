<!DOCTYPE html>

<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    	<meta name="description" content="">
    	<meta name="author" content="">
    	<link rel="icon" href="../../favicon.ico">
    	
   	 	<!-- Bootstrap core CSS -->
    	<link href="/www/css/bootstrap.min.css" rel="stylesheet">
    	<!-- <link href="/www/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->
    	<link href="/www/css/navbar-fixed-top.css" rel="stylesheet">
    	
    	
	</head>
	
	<body>
	
	<!-- Navbar -->
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php?page=" id="home">Claire's Inventory</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="menu" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">View User</li>
                <li><a href="index.php?page=users/allusershe">All HE Users</a></li>
                <li><a href="index.php?page=users/allusersfield">All Field Users</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Add User</li>
                <li><a data-toggle="modal" href="/www/php/users/adduserhe.php" data-target="#modal">Add HE User</a></li>
                <li><a data-toggle="modal" href="/www/php/users/adduserfield.php" data-target="#modal">Add Field User</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Hardware <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">View Hardware</li>
                <li><a href="index.php?page=hardware/allcomputers">All Computers</a></li>
                <li><a href="index.php?page=hardware/allmobile" id="allmobile">All Mobile</a></li>
                <li><a href="index.php?page=hardware/allaccessories" id="allaccessories">All Accessories</a></li>
                <li><a href="index.php?page=hardware/allciscovoip" id="allciscovoip">All Cisco VOIP</a></li>
                <li><a href="index.php?page=hardware/allxerox" id="allxerox">All XEROX</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Add Hardware</li>
                <li><a data-toggle="modal" href="/www/php/hardware/addcomputer.php" data-target="#modal">Add Computer</a></li>
                <li><a data-toggle="modal" href="/www/php/hardware/addmobile.php" data-target="#modal">Add Mobile</a></li>
                <li><a data-toggle="modal" href="/www/php/hardware/addaccessory.php" data-target="#modal">Add Accessory</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Software <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">View Software</li>
                <li><a href="#">All Software</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Add Software</li>
                <li><a href="#">Add Software</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Reports <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">User Reports</li>
                <li><a href="#">HE User Report</a></li>
                <li><a href="#">Field User Report</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Hardware Reports</li>
                <li><a href="#">Computer Report</a></li>
                <li><a href="#">Mobile Report</a></li>
                <li><a href="#">Accessory Report</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Menu</a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">Sign Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    <!-- Bootstrap core JavaScript -->
    <!-- ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/www/js/bootstrap.min.js"></script>
    -->
	</body>
</html>