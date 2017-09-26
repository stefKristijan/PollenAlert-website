<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Kristijan Štefančić">
        <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1" />
        <title>Pollen Alert</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto%7CJosefin+Sans:100,300,400,500" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
 </head>
    </head>
    <body>

<div class ="container-fluid text-center" id="custom_header">
        <nav class="navbar navbar-light navbar-fixed-top my-navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button
                <a href="index.php"><img src="/img/pollenalert.png" alt="PollenAlert" class="navbar-brand"/></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="">Download</a></li> 
                    <li><a href="">About us</a></li>
                    <li><a href="">Support</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                     <?php
                        if (isset($_SESSION['username'])) {
                            echo '<li><p class="glyphicon glyphicon-user" id="logged-user" style="color:white;  margin:15px 10px 0px 0px; font-weight:bold; font-size:14px"> ';
                            echo $_SESSION['username'];
                            echo '</p></li>';
                            echo '<li><a href="include/logout.php"><span class="glyphicon glyphicon-log-out"></span> <span><b>Logout</b></span></a></li>
                            <li><a href=""><span class="glyphicon glyphicon-cog"></span> <span><b>My Account</b></span></a></li>';
                        } else {
                            echo ' <li><a id="sign-up-btn" data-toggle="modal" data-target="#signUpModal" onclick="getPollenData()"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a id="sign-up-btn" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                        }

                    ?>
                </ul>
                </div>
            </div>
        </nav>
        </div>

    
   
    
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

   
    <script>
       
      
       
      
    </script>
    </body>
</html>