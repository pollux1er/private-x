<?php
session_start();

include_once "config.inc.php";

//include_once __includes_path__."/dao/config.inc.php";
//include_once __includes_path__."/dao/db.class.php";
//include_once __includes_path__."/dao/entity.class.php";

?>

<!DOCTYPE html>
<html>
  <head>
    <title>SMS4EVER - Send unlimited SMS everyday | Worldwide SMS Solution</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Send Free SMS (Text Messages) to any Mobile Worldwide in Cameroon, Ghana, Ivory Coast, Benin and more... Send Free International SMS Texting without Registration."  />
	<meta NAME="keywords" CONTENT="sms,gratuit,free,unlimited,web,worldwide,envoyer,send">
	<link rel="stylesheet" type="text/css" media="all" href="css/font-awesome-ie7.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/font-awesome.min.css" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#message").keyup(function(){
				var box=$(this).val();
				var main = box.length *100;
				var value= (main / 145);
				var count= 145 - box.length;

				if(box.length <= 145){
					$('#count').html(count);
					$('#bar').animate({
						"width": value+'%',
					}, 1);
				} else {
					alert(' Full ');
				}
				return false;
			});
		});
	</script>
  </head>
  <body>
  <?php include_once("content/analyticstracking.php"); ?>
		<header>
		    <div id="header">
					<div class="navbar navbar-fixed-top">
						<div class="navbar-inner">
							<div class="container-fluid">
								<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</a>
								<a class="brand" href="#">SMS4Ever</a>
								<div class="btn-group pull-right">
									<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
										<i class="icon-user"></i> Membres
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li><a href="index.php?step=3"><i class="icon-signin"></i> Connexion</a></li>
										<li class="divider"></li>
										<li><a href="#">Inscription</a></li>
									</ul>
								</div>
								<div class="nav-collapse">
									<ul class="nav">
										<li><a href="active">Envoyer un sms</a></li>
										<li><a href="#"><img alt="Sens free SMS" src="img/gb.png"/> English</a></li>
										<li><a href="#"><img alt="Envoie de sms gratuit" src="img/fr.png"/> French</a></li>
									</ul>
								</div><!--/.nav-collapse -->
							</div>
						</div>
					</div>
			  </div>
		</header>
		
		<div id="logo" class="content">
		  <div class="container-fluid">
        <div class="row-fluid">
          <div class="span6">				
						<a href="index.html"><img src="img/sms4ever2.png" alt="SMS for EVER"/></a>
		      </div>
          <div class="span6">	
				<?php include('content/banners/banner-haut.php'); ?>	
						
		      </div>
				</div>
			</div>
		</div>
		
		<div id="corps">
		  <div class="container-fluid content corps effect">
			  <div class="row-fluid">
				  <div class="span5">
					  <div class="sidebar-nav">
						  <div class="menu_gauche">
								<?php include('content/banners/banner-gauche.php'); ?>
								
						  </div>
						</div>
					</div>
					<div class="span6 form">
						<?php include('content/steps.php'); ?>
						<h1 class="frontpageHeadline">Envoyez des SMS &agrave; vos amis! (C'est gratuit!)</h1>
					</div>
					<div class="span7 main">
					</div>
				</div>
			</div>
		</div>
		
    <footer>
        <div id="footer" class="effect container-fluid clearfix content">
				  <div class="row-fluid">
					  <div class="footer">
							<div class="span4">
								<a href="index.html"><img src="img/sms4ever2.png" alt="SMS for EVER"/></a>
								<p>&copy; 2013 sms4ever all rights reserved.</p>
							</div>
							<div class="span2">
								<h1 class="colophon">
								  SMS4EVER
								</h1>
								<ul>
								  <li><a href="#"><a href="#">About SMS 4 EVER</a></li>
									<li><a href="#"><a href="#">SMS 4 EVER Team</a></li>
									<li><a href="#"><a href="#">SMS 4 EVER Membership</a></li>					
								</ul>
							</div>
							<div class="span2">
								<h1 class="colophon">
								  Parnership
								</h1>
								<ul>
								  <li><a href="#">Developers</a></li>
									<li><a href="#">Our SMS Provider</a></li>
									<li><a href="#">SMS Solutions</a></li>				
								</ul>
							</div>
							<div class="span2">
								<h1 class="colophon">
								  Community
								</h1>
								<ul>
								  <li><a href="#">Contact us</a></li>
									<li><a href="#">Facebook</a></li>
									<li><a href="#">Become a Partner</a></li>					
								</ul>
							</div>
							<div class="span2">
								<h1 class="colophon">
								  Support
								</h1>
								<ul>
									<li><a href="#">Terms of service</a></li>
									<li><a href="#">Privacy policy</a></li>
									<li><a href="#">Copyright</a></li>					
								</ul>
							</div>
						</div>
					</div>
		    </div>
    </footer>  
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slideScript.js"></script>
		<script type="text/javascript">
			
			function DropDown(el) {
				this.dd = el;
				this.placeholder = this.dd.children('span');
				this.opts = this.dd.find('ul.dropdown > li');
				this.input = this.dd.find('input');
				this.val = '';
				this.index = -1;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						return false;
					});

					obj.opts.on('click',function(){
						var opt = $(this);
				    spanOpt = opt.find(".indicatif");
						obj.val = opt.text();
						obj.indicatif = spanOpt.text();
						obj.index = opt.index();
						obj.placeholder.text(obj.val);
						obj.input.val(obj.val);
						$("#expediteur").val(obj.indicatif);
						$("#ind_num").val(obj.indicatif);
					});
				},
				getValue : function() {
					return this.val;
				},
				getIndex : function() {
					return this.index;
				}
			}

			$(function() {
				
				var dd = new DropDown( $('#dd') );				
                
				$(document).click(function() {
					
					$('.wrapper-dropdown').removeClass('active');
				});

			});

		</script>
  </body>
</html>