<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");


//**********************************************************
// Шаг   Фабрика загрузки внешних классов
//**********************************************************	

	/*
		// Does not work now
		ini_set('include_path', '/var/www/ann.userto.com/Includes/');
		spl_autoload_extensions(".php");
		spl_autoload_register();
	*/
	
	//See more: https://habrahabr.ru/post/136761/
	function autoloader($className){
		$factoryRequire 	= array();
		$factoryRequire[0] 	= 'commonAnn';
		$factoryRequire[1] 	= 'ann';

		foreach($factoryRequire as $key0 => $str){
			require_once ( '/var/www/ann.userto.com/Includes/'.$factoryRequire[$key0].'.class.php' );
		}
	}
	spl_autoload_register('autoloader');

	
	/*	Old working versioin for loading classes
		$factoryRequire 	= array();
		$factoryRequire[0] 	= 'commonAnn';
		$factoryRequire[1] 	= 'ann';
		
		foreach($factoryRequire as $key0 => $str){
			require_once ( '/var/www/ann.userto.com/Includes/'.$factoryRequire[$key0].'.class.php' );
		}
	*/
	
//**********************************************************
// Шаг   Creating new objects of a classes
//**********************************************************

	$securityFunctions	=	new securityFunctions();	
	$microFunctionsAnn	=	new microFunctionsAnn();


//**********************************************************
// Шаг   Returning server variables
//**********************************************************

	$ip_visitor			= $_SERVER['REMOTE_ADDR']; //Информация об IP-адресе посетителя
	//$ct_url				= $microFunctionsFm::getUrlServer(); //Unused. Alternative way of ct_url returning
	


//**********************************************************
// Шаг   Получение данных по GET запросу
//**********************************************************

		//$optGet		 		=	securityFunctions::stringSpecCharEscape($_GET['opt']);
		//$id_profGet			=	securityFunctions::stringSpecCharEscape($_GET['id_prof']);
		//echo $optPostHttp;
	
//**********************************************************
// Шаг   Получение данных по POST запросу
//**********************************************************		
		$optPost			=	'';
		$optPostHttp		=	'';
	
	
	if(!empty($_POST['optPost'])){		$optPost	=	securityFunctions::stringSpecCharEscape($_POST['optPost']);}
	if(!empty($_POST['txt'])){			$txt		=	securityFunctions::stringSpecCharEscape($_POST['txt']);}
	if(!empty($_POST['langSelect'])){	$langSelect	=	securityFunctions::stringSpecCharEscape($_POST['langSelect']);}

/*
	if(!empty($_POST['dateStart'])){	
		$dateStart	=	securityFunctions::stringSpecCharEscape($_POST['dateStart']);
		$dateStart	=	preg_replace('/[-]/imxuU', '', $dateStart);}
	if(!empty($_POST['dateFinish'])){	
		$dateFinish	=	securityFunctions::stringSpecCharEscape($_POST['dateFinish']);
		$dateFinish	=	preg_replace('/[-]/imxuU', '', $dateFinish);}
	if(!empty($_POST['fileNameData'])){	$fileNameData	=	securityFunctions::stringSpecCharEscape($_POST['fileNameData']);}
		//echo $optPostHttp.' '.$txt.' '.$langSelect;
*/		
		//print_r($_POST);
		$data 				= 	file_get_contents("php://input");
		$dataJsonDecode 	= 	json_decode($data);
		$optPostHttp		= 	!empty($dataJsonDecode->optPost) 			? $dataJsonDecode->optPost			: '';
		$fileNameIn			= 	!empty($dataJsonDecode->fileNameIn) 		? $dataJsonDecode->fileNameIn		: '';
		$ticketOut			= 	!empty($dataJsonDecode->ticketOut) 			? $dataJsonDecode->ticketOut		: '';
		$depthData			= 	!empty($dataJsonDecode->depthData) 			? $dataJsonDecode->depthData		: '';
		$dateStart			= 	!empty($dataJsonDecode->dateStart) 			? $dataJsonDecode->dateStart		: '';
		$dateStart			=	 date('Y-m-d',strtotime($dateStart));
		$dateFinish			= 	!empty($dataJsonDecode->dateFinish) 		? $dataJsonDecode->dateFinish		: '';
		$dateFinish			=	 date('Y-m-d',strtotime($dateFinish));
		$numNeuronsHidden	=	!empty($dataJsonDecode->numNeuronsHidden) 	? $dataJsonDecode->numNeuronsHidden	: '';
		$minEpoch			=	!empty($dataJsonDecode->minEpoch) 			? $dataJsonDecode->minEpoch			: '';
		$maxEpoch			=	!empty($dataJsonDecode->maxEpoch) 			? $dataJsonDecode->maxEpoch			: '';
		$acceptedError		=	!empty($dataJsonDecode->acceptedError) 		? $dataJsonDecode->acceptedError	: '';
		$addFilesYN			=	!empty($dataJsonDecode->addFilesYN) 		? $dataJsonDecode->addFilesYN		: '';
		$fileNameData		= 	!empty($dataJsonDecode->fileNameData) 		? $dataJsonDecode->fileNameData		: '';
		$cycle				= 	!empty($dataJsonDecode->cycle) 				? $dataJsonDecode->cycle			: '';
	/*	*/
		
	
		//print_r($optPostHttp);
		//print_r($txt);
		//print_r($dataJsonDecode);

	if( !empty($optPostHttp) ){
		//echo $data;		
		//**********************************************************
		// Step	Initial settings
		//**********************************************************
		
		//Namespace for folder and files
			$annParam['dirNameIn']				=	'/var/www/ann.userto.com/AnnFann/HeadgeFundMoex/';
			$annParam['fileNameIn']				=	$fileNameIn;
			
			//$annParam['dirName']				=	'/var/www/ann.userto.com/AnnFann/HeadgeFundMoex/approach01/';
			$annParam['dirData']				=	'/var/www/ann.userto.com/AnnFann/HeadgeFundMoex/approach01/aaaData/';			
			$annParam['fileNameData']			=	!empty($fileNameData) ? $fileNameData	: 'data.data';
			
			$annParam['dirAnn']					=	'/var/www/ann.userto.com/AnnFann/HeadgeFundMoex/approach01/bbbAnn/';			
			$annParam['fileNameAnn']			=	'ann.data';
			
			$annParam['dirTest']				=	'/var/www/ann.userto.com/AnnFann/HeadgeFundMoex/approach01/cccTest/';			
			$annParam['fileNameTest']			=	'test.data';

		//Meta data: input and data management
			$annParam['ticketOut']				=	$ticketOut;
			$annParam['depthData']				=	$depthData;
			$annParam['dateBottom']				=	'';
			$annParam['dateStartDTT']			=	!empty($dateStart) 	? $dateStart	: '';	//Defined earlier. DTT stands 
			$annParam['dateFinishDTT']			=	!empty($dateFinish) ? $dateFinish	: '';	//$dateFinish;Defined earlier. DTT stands for Data, Train, Testing 20120109 20111226
			$annParam['dateTop']				=	'';
			$annParam['cycle']					=	$cycle;
			$annParam['treshold']				=	0.01;
			$annParam['numInputData']			=	'';		//Calculated later
			$annParam['numOutputData']			=	'';		//Calculated later
			$annParam['numTrainPair']			=	'';		//Calculated later
			
		//Data normalization settings
			$annParam['normalizYN']				=	'Y';
			$annParam['kExtends']				=	0.15;
			$annParam['minModelIn']				=	-1;
			$annParam['maxModelIn']				=	1;
			$annParam['minModelOut']			=	-0.8;
			$annParam['maxModelOut']			=	0.8;
			
		//Training parameters #1
			$annParam['numLayers']				=	3;
			$annParam['numNeuronsHidden']		=	(int) $numNeuronsHidden;
		//Training parameters #2
			$annParam['activationFunctionHidden']=	FANN_SIGMOID_SYMMETRIC;
			$annParam['activationFunctionOutput']=	FANN_SIGMOID_SYMMETRIC;
			$annParam['activationSteepnessHidden']=	0.2;
			$annParam['activationSteepnessOutput']=	0.2;
			$annParam['learningRate']			=	0.7;	
			$annParam['learningMomentum']		=	0.90;
			$annParam['sarpropTemperature']		=	0.015;
		//Training parameters #3
			$annParam['minEpoch']				=	(int) $minEpoch;
			$annParam['maxEpoch']				=	(int) $maxEpoch;
			$annParam['epochsBetweenReports']	=	1000;
			$annParam['desiredError']			=	0.0001;	
			$annParam['acceptedError']			=	(float) $acceptedError; //0.04;
	}	

	//print_r($annParam); return; acceptedError
	
	
//**********************************************************
// Opt. Bulk case 'getBulkDataFile', 'getBulkTrainFile', 'getBulkTestReport', 'getBulkTestTable'
//**********************************************************
	
	if( $optPostHttp == 'getBulkDataFile' ){
		
		//print_r($annParam);
		$annLog					=	$microFunctionsAnn->ppppGetBulkDataFile($annParam);
		echo $annLog['reportBulkDataFile'];

		//echo $optPostHttp.' '.$dateStart.' '.$dateFinish;
	}

	
	if( $optPostHttp == 'getBulkTrainFileList' ){
	
		if($addFilesYN	== 'N'){
			$microFunctionsAnn->deleteFileDir($annParam['dirAnn']);
		}
				$string				=	$microFunctionsAnn->getJsonListFileDir($annParam['dirData'],'test');		
		echo 	$string;

	}


	if( $optPostHttp == 'getBulkTrainFile'){
	
		//ANN create and adjust
			$ann				=	$microFunctionsAnn->fannCreateAdjust($annParam);
			
		//ANN train			
			$annLog				=	$microFunctionsAnn->ppppTrainData01($ann, $annParam);
		
		//print_r($annLog['reportBulkTrainFile']);
		echo 	$annLog['reportBulkTrainFile']; //$report;

	}	
	
	
	if( $optPostHttp == 'getBulkTestReport' ){

		//Run bulk tests to form  and enreach annParam array
			$annParam	=	$microFunctionsAnn->ppppBulkTest4AnnParam($annParam);
				//print_r($annParam['dataAnnTest']['dataSet']); return;

		//Test dataSet interpretation
			$annParam	=	$microFunctionsAnn->testDateInterptetation2dataArray($annParam);
				//print_r($annParam['dataAnnTest']['dataSet']); return;

				
		//Test dataSet interpretation summary to enreach data array
			$annParam	=	$microFunctionsAnn->testInterptetationSummary($annParam);
				//print_r($annParam['dataAnnTest']['dataSet']); return;				
								
				
		//Form bulk test report
			$annParam	=	$microFunctionsAnn->ppppBulkTestReport($annParam);
				//print_r($annParam['dataAnnTest']['dataSet']); return;				

			
		echo 	$annParam['dataAnnTest']['bulkTestReport']; //$report;;
	}


	if( $optPostHttp == 'getBulkTestTable' ){

		//Run bulk tests to form  and enreach annParam array
			$annParam	=	$microFunctionsAnn->ppppBulkTest4AnnParam($annParam);
			//print_r($annParam['dataAnnTest']['dataSet']); return;

			
		//Test dataSet interpretation by date to enreach data array
			$annParam	=	$microFunctionsAnn->testDateInterptetation2dataArray($annParam);
				//print_r($annParam['dataAnnTest']['dataSet']); return;

				
		//Form bulk test report
			$annParam	=	$microFunctionsAnn->ppppBulkTestTable($annParam);
				//print_r($annParam['dataAnnTest']['dataSet']); return;				

			
		echo 	$annParam['dataAnnTest']['bulkTestTable']; //$report;;
	}
	
		
//**********************************************************
// Opt. 'LangDetectA01' - approach 01
//**********************************************************
	
	if( $optPost == 'LangDetectA01' ){

		$langSelect				=	preg_replace('/(\&quot\;)/imxuU', '"', $langSelect);
		$langSelectArray 		=	json_decode($langSelect);	//get_object_vars ()
		
		//print_r($optPostHttp);
		//print_r($txt);
		//print_r($langSelect);
		
	/*		
$Abc123			=	'{"0":"1","1":"2","2":"3"}';
$Abc123			=	'{&quot0&quot:&quot1&quot,&quot1&quot:&quot2&quot,&quot2&quot:&quot3&quot}';
$arrayAbc123	=	array(0 => 1, 1 => 2, 2 => 3);
echo <<<END
<script>
	console.info('Hello');
</script>
	$langSelect

END;
	*/				
		//Ini settings

			//Always! Quatity of rows for training
			$rowSample	=	array(0 => 0);

		//Namespace for folder and files
			$annParam['dirName']				=	'/var/www/ann.userto.com/AnnFann/LangDetect/approach01/';
			$annParam['fileNameIn']				=	'';
			$annParam['dirData']				=	'/var/www/ann.userto.com/AnnFann/LangDetect/approach01/';
			$annParam['dirAnn']					=	'/var/www/ann.userto.com/AnnFann/LangDetect/approach01/';			
			$annParam['dirTest']				=	'/var/www/ann.userto.com/AnnFann/LangDetect/approach01/';			
			$annParam['fileNameData']			=	'data-0.data';
			$annParam['fileNameAnn']			=	'annSave.data';
			$annParam['fileNameTest']			=	'test.data';

						
		//Data normalization settings
			$annParam['normalizYN']				=	'Y';
			$annParam['kExtends']				=	0;
			$annParam['minModelIn']				=	-1;
			$annParam['maxModelIn']				=	1;

		//Training parameters #1
			$annParam['numLayers']				=	3;
			$annParam['numInputData']			=	256;
			$annParam['numNeuronsHidden']		=	128;
			$annParam['numOutputData']			=	8;		//Should be equal to the data4file.php
		//Training parameters #2
			$annParam['activationFunctionHidden']=	FANN_SIGMOID_SYMMETRIC;
			$annParam['activationFunctionOutput']=	FANN_SIGMOID_SYMMETRIC;
			$annParam['activationSteepnessHidden']=	0.5;
			$annParam['activationSteepnessOutput']=	0.5;
			$annParam['learningRate']			=	0.7;	
			$annParam['learningMomentum']		=	0.5;
			$annParam['sarpropTemperature']		=	0.015;
		//Training parameters #3
			$annParam['minEpoch']				=	50;
			$annParam['maxEpoch']				=	100000;
			$annParam['epochsBetweenReports']	=	1000;
			$annParam['desiredError']			=	0.00001;	
			$annParam['acceptedError']			=	0.005;
						
					//ANN data file creation
		$annParam			=	$microFunctionsAnn->langDetectionDataA01($rowSample, $annParam['dirName'], $langSelectArray, $annParam);
						
					//ANN create and adjust
		$ann				=	$microFunctionsAnn->fannCreateAdjust($annParam);
						
					//ANN train			
		$trainReportArray	=	$microFunctionsAnn->langDetectionTrainA01($ann, $rowSample, $annParam['dirName'], $annParam);
						
					//Run ANN prediction test
							//echo 'annGetPost.php $txt: '.$txt.'<br />';
							//print_r($langSelectArray);
		$rowNum			=	0;
		$outputTxt		= 	$microFunctionsAnn->langDetectionRunA01($txt, $annParam['dirName'], 
							$langSelectArray, $rowNum, $trainReportArray, $annParam);
		
		//print_r($output);
		
		echo 	$outputTxt;				
		
		
	/*	
		echo 	'  Deuch: '.round($output[0]*100,1).
				'  English: '.round($output[1]*100,1).
				'  Espanol: '.round($output[2]*100,1).			
				'  French: '.round($output[3]*100,1).
				'  Italian: '.round($output[4]*100,1).
				'  Polish: '.round($output[5]*100,1).
				'  Portuguese: '.round($output[6]*100,1).
				'  Russian: '.round($output[7]*100,1).'<br />';
	*/			
				

	}


	
	
?>