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
    <body>

<div class ="container-fluid text-center" id="custom_header">
        <nav class="navbar navbar-light navbar-fixed-top my-navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button>
                <a href="index.php"><img src="/img/pollenalert.png" alt="PollenAlert" class="navbar-brand"/></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="download.php">Download</a></li> 
                    <li><a href="about.php">About me</a></li>
                    <li><a href="" data-toggle="modal" data-target="#contact" data-original-title>Support</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                     <?php
                        if (isset($_SESSION['username'])) {
                            echo '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong>';
                        echo $_SESSION['username'];
                        echo '</strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-center"><strong>';
                                        echo $_SESSION['username'];
                                        echo '</strong></p>
                                        <p class="text-center small">';
                                        echo $_SESSION['email'];
                                        echo '</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="include/logout.php" class="btn btn-danger btn-block">Log out</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>';
                            /*echo '<li><p class="glyphicon glyphicon-user" id="logged-user" style="color:white;  margin:15px 10px 0px 0px; font-weight:bold; font-size:14px"> ';
                            echo $_SESSION['username'];
                            echo '</p></li>';
                            echo '<li><a href="include/logout.php"><span class="glyphicon glyphicon-log-out"></span> <span><b>Logout</b></span></a></li>
                            <li><a href="my-account.php"><span class="glyphicon glyphicon-cog"></span> <span><b>My Account</b></span></a></li>';*/
                        } else {
                            echo ' <li><a id="sign-up-btn" data-toggle="modal" data-target="#signUpModal" onclick="getPollenData()"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a id="sign-up-btn" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                        }

                    ?>
                </ul>
                </div>
            </div>
        </nav>
<div class="modal fade" id="loginModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h4 class="modal-title">Login to PollenAlert</h4>
                    </div>
                    <div class="modal-body">
                        <div class="main-login main-center">
                            <form role="form" class="form-horizontal" action="login.php" method="POST">
                                <div class="form-group">
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="username" id="login-username"  placeholder="Enter your Username"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                            <input type="password" class="form-control" name="password" id="login-password"  placeholder="Enter your Password"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block login-button">Login</button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
            </div>
     </div>

     <div class="modal fade" id="signUpModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h4 class="modal-title">Sign up to PollenAlert</h4>
                    </div>
                    <div class="modal-body">
                        <div class="main-login main-center">
					<form class="form-horizontal" action="register_web.php" method="POST">
						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span><span id="email-result"></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="E-mail" onkeyup="validate()"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="sign-up-username" id="sign-up-username"  placeholder="Username" onkeyup="checkAvailability()"/>
								</div>
                                <label id="username-available"></label>
							</div>
						</div>

						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="sign-up-password" id="sign-up-password"  placeholder="Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">  
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirm your password" onChange="checkPasswordMatch()"/>
								</div>
							</div>
						</div>
                        
                         <div class="form-group">
                            <label >Select plants that you're allergic to:</label>
                            <select id="pollen" name="pollen[]" multiple class="form-control" >
                               
                        </select>
                        </div>

   
						<div class="form-group ">
							<button type="submit" name="submit" id="signUp" disabled class="btn btn-primary btn-lg btn-block login-button">Register</button>
						</div>
					</form>
				</div>
                </div>
            </div>
            </div>
     </div>
      <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span> Any questions? Feel free to contact us.</h4>
                    </div>
                    <form action="" method="post" accept-charset="utf-8">
                    <div class="modal-body" style="padding: 5px;">
                          <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                    <input class="form-control" name="firstname" placeholder="Firstname" type="text" required autofocus />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                    <input class="form-control" name="lastname" placeholder="Lastname" type="text" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                    <input class="form-control" name="email" placeholder="E-mail" type="text" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                    <input class="form-control" name="subject" placeholder="Subject" type="text" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea style="resize:vertical;" class="form-control" placeholder="Message..." rows="6" name="comment" required></textarea>
                                </div>
                            </div>
                        </div>  
                        <div class="panel-footer" style="margin-bottom:-14px;">
                            <input type="submit" class="btn btn-success" value="Send"/>
                            <input type="reset" class="btn btn-danger" value="Clear" />
                            
                            <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        

        <div class="jumbotron">
                <h1>Don't be afraid of pollen!</h1>
                <p>PollenAlert is a software that will warn you about high concentration of pollen in your area.</p>
                <a href="#section-about" class="btn btn-lg my-button" id="read-more">Read more</a>
                <a href="#download-section" class="btn btn-lg my-button" id="download">Download now</a>
            </div>
    </div>
  
    
    <section id="section-about">
    <div class="container-fluid">
        <div class="row">
             <h2 style="margin-top:50px">Welcome to PollenAlert website</h2>
        </div>
        <div class="row">
            <div class="col-sm-4 col-centered" id="location-col">
                <img src="/img/track_location.png" class="img-circle img-responsive center-block" alt="Track Location" width="300" height="300">
                <h3>Tracking location</h3>
                <p>PollenAlert gives you pollen information based on your location.</p>
            </div>
            <div class="col-sm-4 col-centered" id="protection-col">
                <img src="/img/protection.png" class="img-circle img-responsive center-block" alt="Track Location" width="300" height="300">
                <h3>Protecting</h3>
                <p>PollenAlert protects you wherever you go, it warns you about high level of pollen count.</p>
            </div>
            <div class="col-sm-4 col-centered" id="connection-col">
                <img src="/img/world_connection.png" class="img-circle img-responsive center-block" alt="Track Location" width="300" height="300">
                <h3>Connection</h3> 
                <p>With PollenAlert you can see what is bothering users around your location.</p>
            </div>
        </div>
    </div>
    </section>

    <section id="download-section">
        <div class="container">
        <div class="row" id="download_row">
            <div class="col-sm-4 col-centered" id="screenshots-col">
                <img src="/img/pollen_alert_screenshots.jpg" class="img-rounded img-responsive center-block" alt="PollenAlert Download">
            </div>
            <div class="col-sm-8 col-centered">
                <h2 style="margin:30px 0px 30px 0px" id="download-heading">PollenAlert download</h2>
                <p style="margin-bottom:30px" id="download-paragraph">PollenAlert is an Android application that gives you information about pollen levels around you (or any city you want to know about). Based on your allergies and location it warns you that you might experience some symptoms. You can even see posts from other people nearby, their symptoms and common allergies so you can be even more careful. <br>If you're allergic and afraid for your health click on the button bellow and download PollenAlert for free! </p>  
                    <a href="#" class="btn btn-lg download-button">Download now!</a>
            </div>
        </div>
        </div>
    </section>

    <section id="about-me-section">
        <div class="container-fluid img-responsive col-centered" id="about-me-container">
            <div class="col-sm-9 col-md-7 col-xs-12 about-me">
                <h3>Kristijan Štefančić</h3>
                <p>A software engineering student on an university in Croatia. His goal is to become a great software developer and make applications that will help people.<br><br>"PollenAlert will help many of my friends, family and even me. That's why I hope other people will try it too."</p>
            </div>
        </div>
    </section>
    
    
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <script src="/js/js_functions.js"></script>
  <script>



        var $root = $('html, body');
        $('#read-more').click(function() {
            $root.animate({
                scrollTop: $( $.attr(this, 'href') ).offset().top
            }, 500);
            return true;
        });
         var $root = $('html, body');
        $('#download').click(function() {
            $root.animate({
                scrollTop: $( $.attr(this, 'href') ).offset().top
            }, 500);
            return true;
        });


        window.sr = ScrollReveal();

        if ($(window).width() < 500) {

         sr.reveal('#protection-col', {
            duration: 2000,
            distance:'300px',
            origin:'top'
        });
         sr.reveal('#connection-col', {
            duration: 2000,
            distance:'300px',
            origin:'right'
        });
    
        sr.reveal('.download-button', {
            duration: 2000,
            origin:'bottom'
        });
            $(".about-me").css({"margin": "10px 0px 10px 0px", "positionX": "-10px"});
            $("#about-me-container").css('background-image','url(/img/me_xs.png)');
            $(".jumbotron").css("margin-top","30px");
            $(".modal").css("height", $(window).height());
            $(".btn-group").css("width","300px !important");
             $(".multiselect .dropdown-toggle .btn .btn-default").css("width","300px !important");
        }
        else {
            sr.reveal('.jumbotron', {
            duration: 2000,
            delay:500,
            distance:'300px',
            origin:'left'
        });
        

        }
        sr.reveal('.navbar', {
          duration: 2000,
          origin:'bottom'
        });
       
         sr.reveal('#section-about .container-fluid h2', {
            duration: 2000,
            distance:'300px',
            origin:'top'
        });
         sr.reveal('#location-col', {
            duration: 2000,
            distance:'300px',
            origin:'left'
        });

         sr.reveal('#protection-col', {
            duration: 2000,
            delay:500,
            distance:'300px',
            origin:'top'
        });
         sr.reveal('#connection-col', {
            duration: 2000,
            delay:1000,
            distance:'300px',
            origin:'right'
        });
        sr.reveal('#download-heading', {
            duration: 2000,
            distance:'300px',
            origin:'top'
        });
        sr.reveal('#download-paragraph', {
            duration: 2000,
            distance:'300px',
            origin:'right'
        });
        sr.reveal('.download-button', {
            duration: 2000,
            delay:1000,
            origin:'bottom'
        });
        sr.reveal('#screenshots-col', {
            duration: 2000,
            distance:'300px',
            origin:'left'
        });
           sr.reveal('#about-me-section', {
            duration: 2000,
            distance:'1000px',
            origin:'right'
        });

         sr.reveal('.about-me', {
            duration: 2000,
            delay:500,
            distance:'300px',
            origin:'left'
        });

      
    </script>
    </body>
</html>