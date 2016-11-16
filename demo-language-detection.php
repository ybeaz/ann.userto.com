<?php
header('Access-Control-Allow-Origin: *');
header('HTTP/1.1 200 OK');
header('Date: '.date('l'));
header('Server: Apache/2.0 (Unix)');
header('Cache-Control: max-age=0, must-revalidate');
header('Expires: '.date('l'));
header('Last-Modified: '.date('l'));
header('ETag: "3e86-410-3596fbbc"');
header('Content-Length: ');
header("Content-Type: text/html; charset=UTF-8");

?>

<!DOCTYPE html>
<html 	ng-app="langDetectModule">
<head>


		<title>Ann.UserTo.com</title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="index, follow">
		<meta name="" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" 	content="width=device-width, minimum-scale=1, initial-scale=1">
		
		<link rel="icon" type="image/png" href="http://my.yacontent.com/services/Dashboard/img/Chat_Bubbles@2x_fb.png">

		<!-- ***************  S t a r t CSS files **************  -->
				<!-- Wysiwyg BBcode editor Easy to Use & Powerful http://www.wysibb.com/getting-started/ -->
					<link rel="stylesheet" href="http://my.yacontent.com/services/Wysibb/theme/default/wbbtheme.css" />
				
				<!-- Languages bootstrap-formhelpers-languages js + css
						Read: 	http://bootstrapformhelpers.com/gettingstarted/#jquery-plugins
								https://github.com/vlamanna/BootstrapFormHelpers 
					<link href="http://my.yacontent.com/services/BootstrapFormHelpers/dist/css/bootstrap-formhelpers.min.css" rel="stylesheet">
				-->
				
				
		<!-- ***************  S t a r t  Head Javascript inclusions ************** --> 

			<!-- S t a r t external providers -->
				<!-- Google CDN https://developers.google.com/speed/libraries/devguide -->
			
				<!-- Jquery.js -->
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>	
				
				
				<!-- Include bootstrap http://getbootstrap.com/getting-started/#download 			
					<!-- Latest compiled and minified CSS -->
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

					
					<!-- Latest compiled and minified JavaScript -->
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

				<!-- font-awesome CSS -->
					<script src="https://use.fontawesome.com/ae1fc5930c.js"></script>					
					
					
			<!-- S t a r t Scripts and css from our system -->
				<!--Turn on our style css files-->
					<link href="../css/annCss00.css" type="text/css"  rel="stylesheet" />
					
				<!--Включаем скрипты подлежащие загрузке в тэге head-->									
					<script src="../js/annHead.js"></script>

				<!-- Включаем скрипты подлежащие загрузке в тэге head	-->								
					<script src="http://r1.userto.com/js/r1Head.js"></script>
					
					
	<style>
		.p-t-2{
			padding-top:	2em;
		}
		.p-b-2{
			padding-bottom:	2em;
		}		
		textarea.form-control {
			height:			100%;
		}
		.marginTopBottom0em{
			margin-top:		0px !important;
			margin-bottom:	0px !important;
		}
	</style>
	

	
					
</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>	
		<h1 class="col-md-10 col-sm-12 col-xs-12 text-center">
			Demo: language detection with artificial neuro network
		</h1>
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>		
	</div>
	
	<div class="row p-t-2" ng-controller="langSelectDetectController">
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>
		<div class="col-md-7 col-sm-12 col-xs-12">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 text-center">
						<textarea id="textarea01" class="form-control" rows="8" placeholder="Paste a text here..."></textarea>
					</div>
				</div>
				<div class="row p-t-2 p-b-2">
					<div class="col-md-1"></div>
					<div class="col-md-2 text-center">
						<div class="btn-group-vertical">
							<button id="button01" type="button" class="btn btn-primary" 
								ng-click="langDetect.cleanTextTable();">Clean all</button>
						</div>
					</div>
					<div class="col-md-2 text-center">
						<div class="btn-group-vertical">
							<!--	-->
							<button id="button01" type="button" class="btn btn-primary" 
								ng-click="langDetect.cleanTable();">Clean table</button>
						</div>
					</div>					
					<div class="col-md-2 text-center">
						<div class="btn-group-vertical">
							<!--	-->
							<button id="button01" type="button" class="btn btn-primary" 
								ng-click="langDetect.allChecked();">Select All</button>
						</div>
					</div>
					<div class="col-md-2 text-center">
						<div class="btn-group-vertical">
							<!--	-->
							<button id="button01" type="button" class="btn btn-primary" 
								ng-click="langDetect.allUnChecked();">Deselect All</button>
						</div>
					</div>						
					<div class="col-md-2 text-center">
						<div class="btn-group-vertical">
							<button id="button01" type="button" class="btn btn-danger" 
								ng-click="langDetect.detectLanguage()">Test language</button>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>				
				
			</div>
		</div>

		<div class="col-md-4 col-sm-12 col-xs-12">
			<div id="langDetect" class="container-fluid">
				<div class="row">
					  <table class="table table-striped">
						<tbody>
							<tr>
								<td>Language</td>
								<td>Relevance</td>
								<td>Epoches</td>
								<td>MSE</td>							
							</tr>
						  <tr ng-repeat="item in langDetect.selectLang" ng-init="">						  
							<td>
								<label>
									<input class="inputLang" type="checkbox" value="" 
									ng-model	=	"langDetect.selectLang[$index].checked" 
									ng-checked	=	"langDetect.selectLang[$index].checked">&nbsp;{{item.langName}}
								</label>
							</td>
							<td>{{item.relNum}}%</td>
							<td>{{item.epoch}}</td>
							<td>{{item.mse}}%</td>
						  </tr>					  
					  
						</tbody>
					  </table>
					
					
					
					<!--
					<div class="col-md-4 col-sm-4 col-xs-6"				>
						<div class="checkbox marginTopBottom0em">
							<label>
								<input class="inputLang" type="checkbox" value="" 
								ng-model	=	"langDetect.selectLang[$index].checked" 
								ng-checked	=	"langDetect.selectLang[$index].checked">{{item.langName}}
							</label>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-6 text-left">{{item.relNum}}%</div>
					<div class="col-md-4 col-sm-4 col-xs-0"></div>
					-->
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>	
		<h2 class="col-md-10 col-sm-12 col-xs-12 text-left">
			Technologies used
		</h2>
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>
	</div>

	<div class="row">
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>
		<div class="col-md-10 col-sm-12 col-xs-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th></th>					
						<th>CSS</th>
						<th>JS</th>
						<th>PHP</th>
						<th>SQL</th>						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><strong>Graphical User Interface</strong></td>
						<td>bootstrap 3.3.6</td>
						<td>angularjs 1.4.9<br />
							jquery 2.1.1<br />
							bootstrap 3.3.6<br />
							AJAX, JSON
						</td>
						<td>-</td>
						<td>-</td>						
					</tr>
					<tr>
						<td><strong>Server part</strong></td>
						<td>-</td>
						<td>-</td>
						<td>FANN library 2.2<br />
							PHP 5.5.38-1+deb.sury.org~xenial+12<br />
							POST requests, Regexp, OOP
						</td>
						<td>-</td>					
					</tr>					
				</tbody>
			</table>
		</div>
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>  
	</div>	

	
	<div class="row p-t-4">
		<!-- Div to add contact details -->
		<div id="contact" class="col-lg-12">
		</div>	
	</div>	
	
</div>	
	
	

<!-- S t a r t Начальные скрипты от сторонних провайдеров -->

	<!-- Angular.js https://docs.angularjs.org/api
		CDN source: https://developers.google.com/speed/libraries/
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular-sanitize.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
		<script src="http://my.yacontent.com/services/CdnInternal/angular.min-1.5.0.js"></script>
	-->	
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
	
	<!-- Angular.UI.Bootstrap http://angular-ui.github.io/bootstrap/ 
		<script    src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.2.js"></script>
		<script    src="http://my.yacontent.com/services/CdnInternal/ui-bootstrap-tpls-1.1.1.min.js"></script>
		<script    src="http://my.yacontent.com/services/CdnInternal/ui-bootstrap-tpls-1.1.2.js"></script>
	-->			
		<script    src="http://my.yacontent.com/services/CdnInternal/ui-bootstrap-tpls-1.1.2.js"></script>

	<!-- S t a r t Начальные скрипты от нашей системы -->

		<!--Включаем скрипты подлежащие загрузке перед закрытием тэга body-->
			<script src=""></script>	
	
		<!-- dashboardApp.js это Angular .js file that defines applications - modules - controllers -->
			<script src="../js/annAngular.js"></script>

		<!--Turn on scripts for body-->
			<script src="http://r1.userto.com/js/r1Body.js"></script>				

<!-- *****************  E n d  Head Javascript inclusions **************** -->';		
		
		

</body>
</html>			
												
	
					