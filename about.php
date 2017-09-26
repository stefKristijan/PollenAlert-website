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
        <title>Pollen Alert - About me</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto%7CJosefin+Sans:100,300,400,500" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/css/about-style.css">
         <link rel="stylesheet" type="text/css" href="/css/style.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
    </head>
    <body>

<div class ="container-fluid text-center" >
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
                    <li><a href="about.php" class="active">About me</a></li>
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
        </div>
</div>


 
        <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="info-card">
					<img src="/img/profile_pic.png" class="img-responsive" />
					<div class="info-card-details animate">
						<div class="info-card-header">
							<h3> Kristijan Štefančić </h3>
                            <h4> bacc. ing. comp. </h4>
						</div>
						<div class="info-card-detail">
							<div class="bs-callout bs-callout-danger">
                                <h4 style="color:rgb(32,132,172)">Language and Platform Skills</h4>
                                <ul class="list-group">
                                <a class="list-group-item inactive-link" href="">
                                    <div class="progress">
                                    <div data-placement="top" style="width: 80%;" 
                                    aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">80%</span>
                                        <span class="progress-type">Android / Java </span>
                                    </div>
                                    </div>
                                    <div class="progress">
                                    <div data-placement="top" style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="1" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">70%</span>
                                        <span class="progress-type">C#</span>
                                    </div>
                                    </div>
                                    <div class="progress">
                                    <div data-placement="top" style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="1" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">70%</span>
                                        <span class="progress-type">SQL/ MySQL </span>
                                    </div>
                                    </div>
                                    <div class="progress">
                                    <div data-placement="top" style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="1" role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only">60%</span>
                                        <span class="progress-type">HTML/ HTML5/ CSS/ CSS3</span>
                                    </div>
                                    </div>
                                    <div class="progress">
                                    <div data-placement="top" style="width: 50%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="1" role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only">50%</span>
                                        <span class="progress-type">JavaScript/ Bootstrap</span>
                                    </div>
                                    </div>
                                    <div class="progress">
                                    <div data-placement="top" style="width: 50%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only">50%</span>
                                        <span class="progress-type">C++</span>
                                    </div>
                                    </div>
                                    <div class="progress">
                                    <div data-placement="top" style="width: 40%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only">40%</span>
                                        <span class="progress-type">C</span>
                                    </div>
                                    </div>

                                </a>

                                </ul>
                            </div>
							<div class="social">
								<a href="http://www.facebook.com/kristijan.stefancic" class="social-icon facebook animate"><span class="fa fa-facebook"></span></a>

								<a href="http://github.com/stefKristijan" class="social-icon github animate"><span class="fa fa-github-alt"></span></a>

								<a href="http://linkedin.com/in/kristijan-štefančić-b090b0100/" class="social-icon linkedin animate"><span class="fa fa-linkedin"></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

   

    
   
    
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <script src="/js/js_functions.js"></script>

    </body>
</html>