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
//phpinfo();
?>

<!DOCTYPE html>
<html 	ng-app="appPpppDataProcessingModule">
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

	</style>
					
</head>
<body ng-controller="pppp01Controller">

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="col-md-1"></div>
		<div class="navbar-header col-md-2">
			<a class="navbar-brand" href="#">PPPP + FANN</a>
		</div>
		<!--
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Page 1</a></li>
			<li><a href="#">Page 2</a></li> 
			<li><a href="#">Page 3</a></li> 
		</ul>
		-->
		<div class="btn-group col-md-8 p-t-0p6">
			<button type="button" class="btn btn-info widthMainMenuButton"	
				ng-click="pppp.runServerFunction('getBulkDataFile','getFileReport');">DATA-File</button>
			<button id="getFileRowButton" ng-click="pppp.showHide('getFileRow')" type="button" 
				class="btn btn-info btn-infoShort marginLeft01emRight03em width4em">
				Hide</button>
				
			<button type="button" class="btn btn btn-success widthMainMenuButton" 	
				ng-click="pppp.runServerFunction('getBulkTrainFile','getTrainReport');">TRAIN-File</button>
			<button id="getTrainRowButton" ng-click="pppp.showHide('getTrainRow')" type="button" 
				class="btn btn btn-success btn-successShort marginLeft01emRight03em width4em">
				Hide</button>
				
			<button type="button" class="btn btn-danger widthMainMenuButton"	
				ng-click="pppp.runServerFunction('getBulkTestReport','getBulkTestReport');">TEST-Report</button>
			<button id="getTestReportRowButton" ng-click="pppp.showHide('getTestReportRow')" type="button" 
				class="btn btn-danger btn-dangerShort marginLeft01emRight03em width4em">
				Hide</button>
				
			<button type="button" class="btn btn-warning widthMainMenuButton"	
				ng-click="pppp.runServerFunction('getBulkTestTable','getBulkTestTable');">TEST-Table</button>
			<button id="getTestTableRowButton" ng-click="pppp.showHide('getTestTableRow')" type="button" 
				class="btn btn-warning btn-warningShort marginLeft01emRight03em width4em">
				Hide</button>				
		</div>			
		<div class="col-md-1"></div>
	</div>
</nav>



<div class="container-fluid">

	<!--
	<div class="row p-b-2">
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>	
		<h1 class="col-md-10 col-sm-12 col-xs-12 text-center">
			PPP project data processing with artificial neuro network
		</h1>
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>		
	</div>
	-->
	
	<div class="row p-t-4">
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>	
		<div class="col-md-10 col-sm-12 col-xs-12">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
																
								</div>					
							</div>						
						</div>
					</div>
				</div>				
			</div>
			<div class="container-fluid p-t-0p5">
				<div class="row">
					<div class="form-group">
						<table class="table table-condensed">
							<!--
							<thead>
								<tr>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Email</th>
								</tr>
							</thead> -->
							<tbody>
								<tr>
									<td><label for="fileNameData" class="btn-infoColor">Data file:</label></td>
									<td><input type="text" class="form-control" id="fileNameData" value=""></td>									
									<td><label for="dateStartTrain" class="btn-successColor">Date start:</label></td>			
									<td><input type="text" class="form-control" id="dateStartTrain" value=""></td>
									<td><label for="fileNameTest" class="btn-dangerColor">Data file:</label></td>
									<td><input type="text" class="form-control" id="fileNameTest" value=""></td>									
								</tr>
								<tr>
									<td><label for="ticketOutData" class="btn-infoColor">Ticket:</label></td>
									<td><input type="text" class="form-control" id="ticketOutData" value=""></td>
									<td><label for="dateFinishTrain" class="btn-successColor">Date finish:</label></td>			
									<td><input type="text" class="form-control" id="dateFinishTrain" value=""></td>
									<td><label for="ticketOutTest" class="btn-dangerColor">Ticket:</label></td>
									<td><input type="text" class="form-control" id="ticketOutTest" value=""></td>								
								</tr>
								<tr>
									<td><label for="dateStartData" class="btn-infoColor">Date start:</label></td>			
									<td><input type="text" class="form-control" id="dateStartData" value=""></td>
									<td><label for="intervalRun" class="btn-successColor">Interval (mc):</label></td>
									<td><input type="text" class="form-control" id="intervalRun" value=""></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td><label for="dateFinishData" class="btn-infoColor">Date finish:</label></td>			
									<td><input type="text" class="form-control" id="dateFinishData" value=""></td>
									<td><label for="numCycle" class="btn-successColor">Num. cycles:</label></td>
									<td><input type="text" class="form-control" id="numCycle" value=""></td>
									<td><label for="numNeuronsHidden" class="btn-successColor">Neurons hidden:</label></td>
									<td><input type="text" class="form-control" id="numNeuronsHidden" value=""></td>
								</tr>								
								<tr>
									<td><label for="depthData" class="btn-infoColor">Depth (years):</label></td>			
									<td><input type="text" class="form-control" id="depthData" value=""></td>
									<td><label for="minEpoch" class="btn-successColor">Min epoch:</label></td>
									<td><input type="text" class="form-control" id="minEpoch" value=""></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td></td>			
									<td></td>
									<td><label for="maxEpoch" class="btn-successColor">Max epoch:</label></td>
									<td><input type="text" class="form-control" id="maxEpoch" value=""></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td></td>			
									<td></td>
									<td><label for="acceptedError" class="btn-successColor">Accepted error:</label></td>
									<td><input type="text" class="form-control" id="acceptedError" value=""></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td></td>			
									<td></td>
									<td><div class="checkbox">
											<label class="btn-successColor" style="padding-left:0;"><b>Add files T/F</b></label><input id="addFilesYN" type="checkbox" style="margin-left: 3em;" checked>
										</div>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>								
							</tbody>
						</table>											
					</div>
				</div>				
			</div>	

			
		</div>
		<div class="col-md-1 col-sm-0 col-xs-0">
		</div>		
	</div>

	<div id="getTestReportRow" class="row collapse p-t-2">
		<div class="col-md-1 col-sm-1 col-xs-1"></div>		
		<div id="getTest" 	class="col-md-10 col-sm-10 col-xs-10 text-left">
			<div class="container-fluid">		
				<div id="getTestReportRowIn" class="row">		
					<div id="getBulkTestReport" class="col-md-12 col-sm-12 col-xs-12 text-left">
					</div>
				</div>
			</div>		
		</div>
		<div class="col-md-1 col-sm-1 col-xs-1"></div>
	</div>

	<div id="getTestTableRow" class="row collapse p-t-2">
		<div class="col-md-1 col-sm-1 col-xs-1"></div>		
		<div id="getTest" 	class="col-md-10 col-sm-10 col-xs-10 text-left">
			<div class="container-fluid">		
				<div id="getTestTabletRowIn" class="row">		
					<div id="getBulkTestTable" class="col-md-12 col-sm-12 col-xs-12 text-left">
					</div>
				</div>
			</div>		
		</div>
		<div class="col-md-1 col-sm-1 col-xs-1"></div>
	</div>	
	
	
	<div id="getTrainRow" class="row collapse p-t-2">
		<div class="col-md-1 col-sm-1 col-xs-1"></div>		
		<div id="getTrainData" 	class="col-md-10 col-sm-10 col-xs-10 text-left">
			<div class="container-fluid">		
				<div id="getTrainReportRow" class="row">
					<div class="col-md-3 col-sm-3 col-xs-3 text-left">
						<div id="getTrainFileList" ng-repeat="item in pppp.listFileDataHtml">
							{{$index+1}}. {{item.fileData}}
						</div>
					</div>
					<div id="getTrainReport" class="col-md-9 col-sm-9 col-xs-9 text-left"></div>
				</div>
			</div>			
		</div>
		<div class="col-md-1 col-sm-1 col-xs-1"></div>
	</div>
	
	<div id="getFileRow" class="row collapse p-t-2 p-b-15">
		<div class="col-md-1 col-sm-1 col-xs-1"></div>
		<div id="getFile"		class="col-md-10 col-sm-10 col-xs-10 text-left">
			<div class="container-fluid">		
				<div id="getFileReportRow" class="row">		
					<div id="getFileReport" class="col-md-12 col-sm-12 col-xs-12 text-left">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1 col-sm-1 col-xs-1"></div>
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
						<td><strong>User Interface</strong></td>
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
	

<!-- Modal -->
<div id="myModal" class="modal" role="dialog" style="opacity: 0.1; ">
	<div class="modal-dialog" style="width: 30em;">

		<!-- Modal content-->
		<div class="modal-content text-center">
			<div class="modal-body" style="background: rgba(0, 0, 0, 0.1);">
				<div id="animatedClock" class="animatedClock" style="margin: 9em 0em 9em 0em;">
					<img class="animatedClock" src="http://www.animatedimages.org/data/media/137/animated-clock-image-0179.gif"
					border="0" alt="animated-clock-image-0174" style="height: 7em;">
				</div>
			</div>
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
		<script    src="../js/ui-bootstrap-tpls-2.1.3.min.js"></script>

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
												
	
					