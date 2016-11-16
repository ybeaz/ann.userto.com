		
	//console.info('we are here');		

	
	
	
//angular.module('appPpppDataProcessingModule', ['ui.bootstrap']);
var	appPpppDataProcessing =	angular.module('appPpppDataProcessingModule', ['ui.bootstrap']).run(	function($rootScope) {
		$rootScope.modelBidOffer = {
			ur:					[]
		};

		
		//Конфигурация для вывода или не вывода логов
		appPpppDataProcessing.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider, $logProvider){
			$locationProvider.html5Mode(true).hashPrefix('!');
			$routeProvider
				.when('/', {
				  templateUrl: '/partials/template1.html', 
				  controller: 'ctrl1'
				})
				.when('/tags/:tagId', {
				  templateUrl: '/partials/template2.html', 
				  controller:  'ctrl2'
				})
				.when('/another', {
				  templateUrl: '/partials/template1.html', 
				  controller:  'ctrl1'
				})
				.otherwise({ redirectTo: '/' });
			
			$logProvider.debugEnabled(true);
		}]);

		//Код для вывода логов в любой точке приложения
		appPpppDataProcessing.run(['$rootScope', '$log', 			function($rootScope, $log){
			 $rootScope.$log = $log;
		}]);
		/*Упрощенная версия
		appPpppDataProcessing.run(function($rootScope, $log){
			$rootScope.$log	= $log;
		});*/
	
});
	
	
	//Контроллер 
	appPpppDataProcessing.controller('pppp01Controller', function ($scope, $http, $templateCache, $log) {

		$scope.pppp		=	{};
		
		$scope.pppp.setting4DataTeachTest = function () {
			//For data preparation
			document.getElementById('fileNameData').value		=	'Data-OHLC-NE-USD.txt';
			document.getElementById('ticketOutData').value		=	'DJIA_OHLC_NE';
			document.getElementById('dateStartData').value		=	'2008-01-01'; // 2008-01-01 2011-10-31
			document.getElementById('dateFinishData').value		=	'2016-10-01'; // 2016-10-01 2011-11-14		
			document.getElementById('depthData').value			=	'5';
			
			//For data training
			document.getElementById('dateStartTrain').value		=	document.getElementById('dateStartData').value;
			document.getElementById('dateFinishTrain').value	=	document.getElementById('dateFinishData').value;
			document.getElementById('intervalRun').value		=	'1000';
			document.getElementById('numCycle').value			=	'1000';
			document.getElementById('numNeuronsHidden').value	=	'35';
			document.getElementById('minEpoch').value			=	'1000';
			document.getElementById('maxEpoch').value			=	'10000';
			document.getElementById('acceptedError').value		=	'0.04';
			document.getElementById('addFilesYN').checked 		=	true;			

			//For data testing
			document.getElementById('fileNameTest').value		=	document.getElementById('fileNameData').value;
			document.getElementById('ticketOutTest').value		=	document.getElementById('ticketOutData').value;
			
			return;
		}	
	
	
		//Fill name with 0 if the number less than n digits
		$scope.pppp.nameFilledZeroNumDigits	= function(key, maxLength){
			/*	input	(string, array, nothing)  
				output	(nothing) except a file
				$scope.pppp.nameFilledZeroNumDigits(key, length);	*/
			
			var zeroSource	=	'000000000000000000000000000000000';
			var leftPart	=	'';
			
			if		(key >= 0		&& key <10)		{ leftPart	=	zeroSource.substring(0, maxLength -1);}
			else if	(key >= 10		&& key <100)	{ leftPart	=	zeroSource.substring(0, maxLength -2);}
			else if	(key >= 100		&& key <1000)	{ leftPart	=	zeroSource.substring(0, maxLength -3);}
			else if	(key >= 1000	&& key <10000)	{ leftPart	=	zeroSource.substring(0, maxLength -4);}
			else if	(key >= 10000	&& key <100000)	{ leftPart	=	zeroSource.substring(0, maxLength -5);}
			else if	(key >= 100000 	&& key <1000000){ leftPart	=	zeroSource.substring(0, maxLength -6);}		

			var zKey	=	leftPart + key.toString();
			return zKey;
		}		

		
		//Fill name with 0 if the number less than n digits
		$scope.pppp.getDateFromDataFile	= function(fileName){
			/*	input	(string, array, nothing)  
				output	(nothing) except a file
				$scope.pppp.getDateFromDataFile(string);	*/
			
			var		string	=	fileName.replace(/^data-([\d\-]*?)(\.data)$/gim, '$1');
			
			return	string;
		}		

		
		//Cutting array by period or limit within limitValueBottom and limitValueTop
		$scope.pppp.cutArrayByPeriod	= function(array, limitValueBottom, limitValueTop){
			/*	input	(string, array, nothing)
						limitKey			example		'date'
						limitValueBottom	example		'2010-01-01'  	>=	Ok
						limitValueTop		example		'2010-04-01'	<	Ok
				output	(nothing) except a file
				var = cutArrayByPeriod(array, limitKey, limitValueBottom, limitValueTop);	*/						

			var tempArray	=	array;
			var n			=	0;
			var array		=	[];
				
			for (var i = 0; i < tempArray.length; ++i) {
			
				//Limit ANN teaching only within dateStart and dateFinish
					var dateLimit				=	false;
					var dateStartJsFormatDate	=	new Date(limitValueBottom);
					var dateFinishJsFormatDate	=	new Date(limitValueTop);
					var nameData				=	$scope.pppp.getDateFromDataFile(tempArray[i].fileData);
					var dateCurrentJsFormatDate	=	new Date(nameData);
						
					if( (dateCurrentJsFormatDate < dateStartJsFormatDate) ||
						(dateCurrentJsFormatDate > dateFinishJsFormatDate)
					){
						/*	console.info(	' dateStart:',$scope.pppp.dateStartData,
											' dateFinish:',$scope.pppp.dateFinishData,
											' date outside limits:',tempArray[i].fileData);
						*/
					}
					else{
						array[n]	=	tempArray[i];

						/*	console.info(	' dateStart:',$scope.pppp.dateStartData,
											' dateFinish:',$scope.pppp.dateFinishData,
											' date inside limits:',array[n].fileData);
						*/
						++n;									
					}
			}						
		
			return	array;
		
		}


		//Finction to toggle Show Hide sign on the buttons
		//To show at the beginning look at the code at the bottom
		$scope.pppp.showHide = function(id){
			$("#"+id).collapse('toggle');
			var elementById	=	document.getElementById(id);
			var buttonById	=	document.getElementById(id+'Button');
				//console.info(' elementById.aria-expanded:',$("#"+id).attr('aria-expanded'));
			
			var show	=	$("#"+id).attr('aria-expanded');
			if(	show	==	'false'){
				buttonById.innerHTML	= 'Show';	
			}
			else{
				buttonById.innerHTML	= 'Hide';
			}

			return;
		}

		
		//Объявляем функцию загрузки POST
		$scope.pppp.httpAjax	=	function(){
					
			//console.info('$scope.pppp.http:',$scope.pppp.http);
			$("#myModal").modal("show");
			document.getElementsByClassName("modal-backdrop in")[0].style.display	=	'none';
			
			$http({	'method':	$scope.pppp.http.method, 
					'url':		$scope.pppp.http.getPostUrl, 
					'data':		$scope.pppp.http.data, 
					'headers':	''}).
				success(function(responce, status) {
					//console.info('responce0: ',responce);
					
				//General
				if(		$scope.	pppp.optPost	==	'getBulkDataFile'	||
						$scope.	pppp.optPost	==	'getBulkTestReport'	||
						$scope.	pppp.optPost	==	'getBulkTestTable'	){

						$scope.	pppp.output.innerHTML	=	responce;
						
						$("#myModal").modal("hide");							
						
				}
				//Get files list from data directory for the following ANN teaching
				if(		$scope.pppp.http.optPost	==	'getBulkTrainFileList'){
						//console.info(' listFileData:',responce);

					//Cutting array by period or limit within limitValueBottom and limitValueTop	
						$scope.pppp.listFileData	=	
							$scope.pppp.cutArrayByPeriod(responce, $scope.pppp.dateStartTrain, $scope.pppp.dateFinishTrain);
						
							//console.info(' $scope.pppp.listFileData:',$scope.pppp.listFileData);

						
				}
				//Teach ANN file by file
				if(		$scope.pppp.http.optPost	==	'getBulkTrainFile'){
						$scope.	pppp.reportBulkTrainFile	=	responce;
						
						$scope.pppp.i	+=	1;
						$scope.pppp.zI	=	$scope.pppp.nameFilledZeroNumDigits($scope.pppp.i, 3);
						
					/*	
						console.info(
							' i:',$scope.	pppp.i,
							' interval:',				$scope.	pppp.intervalRun,
							' $scope.pppp.reportBulkTrainFile:',$scope.	pppp.reportBulkTrainFile);
					*/	
						
						var outputInnerHTMLPrevious			=	$scope.	pppp.output.innerHTML;
						if(outputInnerHTMLPrevious.length > 10000){
							outputInnerHTMLPrevious			=	outputInnerHTMLPrevious.substring(0, 3000);
							outputInnerHTMLPrevious			=	outputInnerHTMLPrevious
													.replace(/^([\s\S]*?)(<br>|<br\s\/>)([^<]*?)$/gim, '$1');
						}
						
						if(	$scope.	pppp.reportBulkTrainFile	!= undefined && 
							$scope.	pppp.reportBulkTrainFile	!=	''){
							$scope.	pppp.output.innerHTML	=	$scope.pppp.zI +'. ' + 
																$scope.	pppp.reportBulkTrainFile + '<br />' +
																outputInnerHTMLPrevious;
						}

						if ($scope.	pppp.i > $scope.	pppp.numFile){
							$("#myModal").modal("hide");								
						}

				}

				//Get test report after running ANN test
				if(		$scope.pppp.http.optPost	==	'getBulkTestReport'){
						//console.info(' reportBulkTestReport:',responce);
											//See more: http://jimhoskins.com/2012/12/17/angularjs-and-apply.html
						
						$scope.	pppp.reportBulkTestReport			=	responce;
						document.getElementById('getBulkTestReport').innerHTML	=	$scope.pppp.reportBulkTestReport;
						
						
						//Hide modal window indicated process of data obtaining
						$("#myModal").modal("hide");
						
						//Assign toggle function to the performance button
						$("#performanceButton").click(function(){
							$("#performanceTitle").collapse('toggle');
							$("#performanceValue").collapse('toggle');
						});
						$("#probabilityButton").click(function(){
							$("#probabilityTitle").collapse('toggle');
							$("#probabilityValue").collapse('toggle');
						});
						$("#metaDataButton").click(function(){
							$("#metaDataTitle").collapse('toggle');
							$("#metaDataValue").collapse('toggle');
						});						
				}				
				
	
				}).
				error(function(response, status) {
				  $scope.response		= response || "Request failed";
				  $scope.status 		= status;
			  });
		}


		//Loop for each data file with delay
		//Look more: http://stackoverflow.com/questions/3583724/how-do-i-add-a-delay-in-a-javascript-loop		
		$scope.pppp.loopCycleAroundLoopList = function(i, n) {          
			setTimeout(function () { 
								
				if (i <= $scope.	pppp.numFile	&&	n < $scope.pppp.numCycle){
					
					/*	console.info(
							' i:',$scope.	pppp.i,
							' interval:',				$scope.	pppp.intervalRun,
							' $scope.pppp.reportBulkTrainFile:',$scope.	pppp.reportBulkTrainFile);				
					*/
								
				//$http ajax request to run the next data file for ANN to learn
					$scope.pppp.http				=	{};
					$scope.pppp.http.method		=	'POST';
					$scope.pppp.http.getPostUrl	=	'http://ann.userto.com/php/annGetPost.php';
					$scope.pppp.http.data		=	{	optPost:			'getBulkTrainFile',
														fileNameData: 		$scope.pppp.listFileData[i].fileData,
														cycle:				n,
														numNeuronsHidden:	$scope.pppp.numNeuronsHidden,
														minEpoch:			$scope.pppp.minEpoch,
														maxEpoch:			$scope.pppp.maxEpoch,
														acceptedError:		$scope.pppp.acceptedError
													};
					$scope.pppp.http.optPost	=	'getBulkTrainFile';
					$scope.pppp.http.action		=	'';

					//console.info(' i:',i,' n:',n,' fileNameData:',$scope.pppp.listFileData[i].fileData);					
					$scope.pppp.httpAjax();

					i	+=	1;
					
				if(i > $scope.	pppp.numFile && n < $scope.pppp.numCycle){
						i	=	0;
						n	+=	1;
					}	

					$scope.pppp.loopCycleAroundLoopList(i, n);
				}
				
			}, $scope.pppp.intervalRun);
		};

		
		//Unused now. Loop for each data file with delay
		//Look more: http://stackoverflow.com/questions/3583724/how-do-i-add-a-delay-in-a-javascript-loop		
		$scope.pppp.loopListFileData = function(i) {          
			setTimeout(function () { 
				
				//$http ajax request to run the next data file for ANN to learn
					$scope.pppp.http				=	{};
					$scope.pppp.http.method		=	'POST';
					$scope.pppp.http.getPostUrl	=	'http://ann.userto.com/php/annGetPost.php';
					$scope.pppp.http.data		=	{	optPost:		'getBulkTrainFile',
														fileNameData: 	$scope.pppp.listFileData[i].fileData
													};
					$scope.pppp.http.optPost		=	'getBulkTrainFile';
					$scope.pppp.http.action		=	'';
					
					$scope.pppp.httpAjax();
				
				if (i < $scope.	pppp.numFile){
					i	+=	1;
					
					$scope.pppp.LoopListFileData(i);
				} //  increment i and call myLoop again if i > 0

			}, $scope.pppp.intervalRun);
		};

		
		$scope.pppp.runServerFunction = function (optPost, id) {
				
			$scope.pppp.optPost					=	optPost;
			
			//For data preparation
			$scope.pppp.fileNameData			=	document.getElementById('fileNameData').value;
			$scope.pppp.ticketOutData			=	document.getElementById('ticketOutData').value;
			$scope.pppp.dateStartData			=	document.getElementById('dateStartData').value;
			$scope.pppp.dateFinishData			=	document.getElementById('dateFinishData').value;			
			$scope.pppp.depthData				=	document.getElementById('depthData').value;
			
			//For data training
			$scope.pppp.dateStartTrain			=	document.getElementById('dateStartTrain').value;
			$scope.pppp.dateFinishTrain			=	document.getElementById('dateFinishTrain').value;
			$scope.pppp.intervalRun				=	document.getElementById('intervalRun').value;
			$scope.pppp.numCycle				=	document.getElementById('numCycle').value;
			$scope.pppp.numNeuronsHidden		=	document.getElementById('numNeuronsHidden').value;
			$scope.pppp.minEpoch				=	document.getElementById('minEpoch').value;
			$scope.pppp.maxEpoch				=	document.getElementById('maxEpoch').value;
			$scope.pppp.acceptedError			=	document.getElementById('acceptedError').value;
			$scope.pppp.addFilesYN				=	document.getElementById('addFilesYN').checked == true ? 'Y' : 'N';			

			//For data testing
			$scope.pppp.fileNameTest			=	document.getElementById('fileNameTest').value;
			$scope.pppp.ticketOutTest			=	document.getElementById('ticketOutTest').value;
			

			//console.info('$scope.pppp.addFilesYN:',$scope.pppp.addFilesYN);
			
			$scope.pppp.output					=	document.getElementById(id);
			$scope.pppp.listFileData			=	[];
			$scope.pppp.output.innerHTML		=	'';
			$scope.pppp.getFileReportRow		=	document.getElementById('getFileReportRow');
			$scope.pppp.getTrainFileListRow		=	document.getElementById('getTrainFileListRow');
			$scope.pppp.getTrainReport			=	document.getElementById('getTrainReport');
			$scope.pppp.getBulkTestReport		=	document.getElementById('getBulkTestReport');
			$scope.pppp.getBulkTestTable		=	document.getElementById('getBulkTestTable');
			 
			
			/*	Old animated clock
				'<div id="animatedClock" class="animatedClock" style="display: none; height: 3em; margin: 0em 0em 2em 3em;">'+
					'<img class="animatedClock" src="http://www.animatedimages.org/data/media/137/animated-clock-image-0179.gif" '+
					'border="0" alt="animated-clock-image-0174">'+
				'</div>';
			*/
			
			if(		$scope.	pppp.optPost	==	'getBulkDataFile'	){
					
					$scope.pppp.http				=	{};
					$scope.pppp.http.method		=	'POST';
					$scope.pppp.http.getPostUrl	=	'http://ann.userto.com/php/annGetPost.php';
					$scope.pppp.http.data		=	{	optPost:		$scope.pppp.optPost,
														fileNameIn:		$scope.pppp.fileNameData,
														ticketOut:		$scope.pppp.ticketOutData,
														depthData:		$scope.pppp.depthData,
														dateStart:		$scope.pppp.dateStartData,
														dateFinish:		$scope.pppp.dateFinishData														
													};
					$scope.pppp.http.optPost		=	$scope.	pppp.optPost;
					$scope.pppp.http.action		=	'';
					
					$scope.pppp.httpAjax();
					
			}
			else if($scope.pppp.optPost		==	'getBulkTrainFile'	){
					//$scope.	pppp.getFileReportRow.style.display		=	'none';
					//$scope.	pppp.getTrainFileListRow.style.display	=	'block';
				
				//$http ajax request to get list of files in aaaData directory
					$scope.pppp.http				=	{};
					$scope.pppp.http.method		=	'POST';
					$scope.pppp.http.getPostUrl	=	'http://ann.userto.com/php/annGetPost.php';
					$scope.pppp.http.data		=	{	optPost:	'getBulkTrainFileList',	
														addFilesYN:	$scope.	pppp.addFilesYN
													};
					$scope.pppp.http.optPost		=	'getBulkTrainFileList';
					$scope.pppp.http.action		=	'';
					
					$scope.pppp.httpAjax();
					
					//See more: http://jimhoskins.com/2012/12/17/angularjs-and-apply.html
					setTimeout(function () {						
						$scope.$apply(function () {
							$scope.	pppp.listFileDataHtml	=	$scope.	pppp.listFileData;
						});
					}, 500);

					
				setTimeout(function () {
					var i					=	0;
					$scope.	pppp.i			=	0;
					$scope.	pppp.numFile	=	parseInt($scope.	pppp.listFileData.length)-1;
					/*
					console.info(	'$scope.	pppp.numFile:',		$scope.	pppp.numFile,
									' $scope.	pppp.listFileData:',$scope.	pppp.listFileData);
					*/
					
					
					$scope.pppp.loopCycleAroundLoopList(0, 0);
					
					
				}, 1000);

			}
			else if($scope.	pppp.optPost	==	'getBulkTestReport'	||
					$scope.	pppp.optPost	==	'getBulkTestTable'	){
					
					$scope.pppp.http				=	{};
					$scope.pppp.http.method		=	'POST';
					$scope.pppp.http.getPostUrl	=	'http://ann.userto.com/php/annGetPost.php';
					$scope.pppp.http.data		=	{	optPost:			$scope.pppp.optPost,
														fileNameIn:			$scope.pppp.fileNameTest,
														ticketOut:			$scope.pppp.ticketOutTest,
														dateStart:			$scope.pppp.dateStartData,
														dateFinish:			$scope.pppp.dateFinishData,
														depthData:			$scope.pppp.depthData,
														numNeuronsHidden:	$scope.pppp.numNeuronsHidden,														
														minEpoch:			$scope.pppp.minEpoch,
														maxEpoch:			$scope.pppp.maxEpoch,
														acceptedError:		$scope.pppp.acceptedError														
													};
					$scope.pppp.http.optPost		=	$scope.	pppp.optPost;
					$scope.pppp.http.action		=	'';
					
					$scope.pppp.httpAjax();
					
			}



			
		};

		
		//To run at the beginning
		$('#getFileRow').		collapse('show');
		$('#getTrainRow').		collapse('show');
		$('#getTestReportRow').	collapse('show');
		$('#getTestTableRow').	collapse('show');
		
		
		//To set ini data in the GUI for Data Teach Test blocks
		$scope.pppp.setting4DataTeachTest();
		
		//Run the tooltips
	
	});	
	
	
			
//angular.module('langDetectModule', ['ui.bootstrap']);
var	appLangDetect =	angular.module('langDetectModule', ['ui.bootstrap']).run(	function($rootScope) {
		$rootScope.modelBidOffer = {
			ur:					[]
		};

		
		//Конфигурация для вывода или не вывода логов
		appLangDetect.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider, $logProvider){
			$locationProvider.html5Mode(true).hashPrefix('!');
			$routeProvider
				.when('/', {
				  templateUrl: '/partials/template1.html', 
				  controller: 'ctrl1'
				})
				.when('/tags/:tagId', {
				  templateUrl: '/partials/template2.html', 
				  controller:  'ctrl2'
				})
				.when('/another', {
				  templateUrl: '/partials/template1.html', 
				  controller:  'ctrl1'
				})
				.otherwise({ redirectTo: '/' });
			
			$logProvider.debugEnabled(true);
		}]);

		//Код для вывода логов в любой точке приложения
		appLangDetect.run(['$rootScope', '$log', 			function($rootScope, $log){
			 $rootScope.$log = $log;
		}]);
		/*Упрощенная версия
		appLangDetect.run(function($rootScope, $log){
			$rootScope.$log	= $log;
		});*/
	
});
	
	
	//Контроллер выбора языков для последующего анализа
	appLangDetect.controller('langSelectDetectController', function ($scope, $http, $templateCache, $log) {

		//Using ngModel in ngRepeat  http://jsfiddle.net/sirhc/z9cGm/
		$scope.	langDetect	=	{};
		$scope.	langDetect.selectLangInit	= 
			[	{ langName:		"Germain",		langNameS:	"de",	selected: "1", checked: true, relNum: "--", epoch: "--", mse: "--" }, 
				{ langName:		"English",		langNameS:	"en",	selected: "1", checked: true, relNum: "--", epoch: "--", mse: "--" }, 
				{ langName:		"Espanol",		langNameS:	"es",	selected: "1", checked: true, relNum: "--", epoch: "--", mse: "--" },
				{ langName:		"French",		langNameS:	"fr",	selected: "1", checked: true, relNum: "--", epoch: "--", mse: "--" },
				{ langName:		"Italian",		langNameS:	"it",	selected: "1", checked: true, relNum: "--", epoch: "--", mse: "--" },
				{ langName:		"Polish",		langNameS:	"pl",	selected: "1", checked: true, relNum: "--", epoch: "--", mse: "--" },
				{ langName:		"Portuguese",	langNameS:	"pt",	selected: "1", checked: true, relNum: "--", epoch: "--", mse: "--" },
				{ langName:		"Russian",		langNameS:	"ru",	selected: "1", checked: true, relNum: "--", epoch: "--", mse: "--" }
			];		

		$scope.	langDetect.selectLang		=	$scope.	langDetect.selectLangInit;	
			
		//To clean and to restore main textArea and right panel of outputs	
		$scope.	langDetect.cleanTextTable	=	function(){
			
			var txt			=	document.getElementById('textarea01');
				txt.value	=	'';			
			
			$scope.	langDetect.selectLang		=	$scope.	langDetect.selectLangInit;
			
			
			return;
		};

		//Function to check all See more: http://jsfiddle.net/thr3ee/83cvu/
		$scope.	langDetect.allChecked = function() {
			for (var i = 0; i < $scope.langDetect.selectLang.length; ++i) {
				$scope.langDetect.selectLang[i].checked = true;
			}
		}

		$scope.	langDetect.allUnChecked	= function() {

			for (var i = 0; i < $scope.langDetect.selectLang.length; ++i) {
				$scope.langDetect.selectLang[i].checked = false;
			}
		}

		//To clean and to restore main textArea and right panel of outputs	
		$scope.	langDetect.cleanTable	=	function(){
					
			
			$scope.	langDetect.selectLang		=	$scope.	langDetect.selectLangInit;
			
			
			return;
		};

		/* Watch for language choice */
		$scope.$watch('langDetect.selectLang', 			function() {

			for (var i = 0; i < $scope.langDetect.selectLang.length; ++i) {
				if(		$scope.langDetect.selectLang[i].checked		==	true){
						$scope.langDetect.selectLang[i].selected	=	1;
				}
				else if($scope.langDetect.selectLang[i].checked		==	false){
						$scope.langDetect.selectLang[i].selected	=	'';
				}
			}
			//console.info('$scope.langDetect.selectLang 2: ',$scope.langDetect.selectLang);

			//console.info(' JSON.stringify($scope.langDetect.selectLang): ',JSON.stringify($scope.langDetect.selectLang));
			//var selectAllInput = document.querySelectorAll('.inputLang ');
			//console.info(' selectAllInput: ',selectAllInput);
		}, true);

		/*
		$scope.$apply(function () {
			
		});
		*/
		
	
		$scope.langDetect.detectLanguage = function () {

			var optPost		=	'LangDetectA01';
			var langDetect	=	document.getElementById('langDetect');
				//langDetect.innerHTML	=	'';
			var txt			=	document.getElementById('textarea01').value;
		
		
			//console.info(' $scope.langDetect.selectLang 1:',$scope.langDetect.selectLang);
		
			//Unused. Перебор массива $scope.langDetect.selectLang по елементам
			for(var key0 in $scope.langDetect.selectLang) { 

				if(key0	!= 'contains' && key0 != '__proto__'){
					$scope.langDetect.selectLang[key0];

				}
			}
		
			//console.info(' optPost 1:',optPost,' txt: ',txt);
			//console.info('$scope.langDetect.selectLang:',$scope.langDetect.selectLang);
			//console.info('$scope.langDetect.selectLang stringify:',JSON.stringify($scope.langDetect.selectLang));
			
			$.ajax({
				type: 			'POST',
				url: 			'http://ann.userto.com/php/annGetPost.php',
				data: {
					optPost:		optPost,
					txt:			txt,
					langSelect:		JSON.stringify($scope.langDetect.selectLang) 
				},
				dataType: 'text',
				success: function(echo){
						//console.info('echo: ',echo);
						
						//See more: http://jimhoskins.com/2012/12/17/angularjs-and-apply.html
						$scope.$apply(function () {
							//console.info('echo: ',echo);
							$scope.	langDetect.selectLang	=	JSON.parse(echo);
							//console.info('echo: ',echo);
							//console.info('$scope.langDetect.selectLang: ',$scope.	langDetect.selectLang);
							
							for (var i = 0; i < $scope.langDetect.selectLang.length; ++i) {
								
								if(		$scope.langDetect.selectLang[i].checked	==	1){
										$scope.langDetect.selectLang[i].checked =	true;
								}
								else if($scope.langDetect.selectLang[i].checked	==	''){
										$scope.langDetect.selectLang[i].checked =	false;
								}
							}
							
							//$scope.	langDetect.allChecked();
						});

						//langDetect.innerHTML	=	echo;
						//console.info('echo: ',$scope.	langDetect.selectLang);
					}
			});
		
		};

	
	
	});	
	
		
	
	
	
	
	
	
	