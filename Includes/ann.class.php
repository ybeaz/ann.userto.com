<?php


abstract class Ann { 
	private $name;


	
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	#       Public functions						        			#
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #	

	//Class method: cutting array by period
		//See more http://stackoverflow.com/questions/676824/how-to-calculate-the-difference-between-two-dates-using-php
	public function timeDifference($dateBegin, $dateEnd){
		/*	input	(string, array, nothing)
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $this->timeDifference($dateBegin, $dateBegin);	*/		
		
			$diff		=	abs((int) $dateEnd - (int) $dateBegin);
			//print_r(' $dateBegin:'.$dateBegin.' $dateEnd:'.$dateEnd.'<br />');
			
			$years   = floor( $diff / (365*24*60*60)); 
			$months  = floor(($diff - $years * 365*24*60*60) / (30*24*60*60)); 
			$days    = floor(($diff - $years * 365*24*60*60 - $months*30*24*60*60)/ (24*60*60));
			$hours   = floor(($diff - $years * 365*24*60*60 - $months*30*24*60*60 - $days*24*60*60)/ (60*60)); 
			$minuts  = floor(($diff - $years * 365*24*60*60 - $months*30*24*60*60 - $days*24*60*60 - $hours*60*60)/ 60); 
			$seconds = floor(($diff - $years * 365*24*60*60 - $months*30*24*60*60 - $days*24*60*60 - $hours*60*60 - $minuts*60)); 

			$years   = 	$diff / (365*24*60*60); 
			$months  =	$diff / ( 30*24*60*60); 
			$days    =	$diff / (    24*60*60);
			$hours   =	$diff / (       60*60); 
			$minuts  = 	$diff /            60; 
			$seconds = 	$diff; 
			
			
			//printf("%d years, %d months, %d days, %d hours, %d minuts\n, %d seconds\n", $years, $months, $days, $hours, $minuts, $seconds); 

			$difference['years']	=	$years;
			$difference['months']	=	$months;
			$difference['days']		=	$days;
			$difference['hours']	=	$hours;
			$difference['minutes']	=	$minuts;
			$difference['seconds']	=	$seconds;
						
		return $difference;
	}
	
	
	//Class method: cutting array by period
	public function cutArrayByPeriod($array, $limitKey, $limitValueBottom, $limitValueTop){
		/*	input	(string, array, nothing)
					$limitKey			example		'date'
					$limitValueBottom	example		'2010-01-01'  	>=	Ok
					$limitValueTop		example		'2010-04-01'	<	Ok
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $this->cutArrayByPeriod($array, $limitKey, $limitValueBottom, $limitValueTop);	*/
			
		//print_r($array);	
			
		if(empty($array)	OR	empty($limitKey)	OR	empty($limitValueBottom)	OR	empty($limitValueTop)){			
			//print_r('Bad use function cutArrayByPeriod '); 
			return $array;
		}
		
		foreach($array as $key0 => $str0){

			/*	//Debugging	
					print_r('[$key0]: '.			$key0.' <br />  ');
					print_r('$array[$key0][$limitKey]:	'.$array[$key0][$limitKey].' <br /> ');
					print_r('$limitKey: '.			$limitKey.' <br />  ');				
					print_r('$limitValueBottom: '.	$limitValueBottom.' <br />  ');
					print_r('$limitValueTop: '.		$limitValueTop.' <br />  ');
					print_r('count($array): '.	count($array).' <br />  ');
			*/
			
			if(	empty($array[$key0]))	{continue;}
		
			if(	$array[$key0][$limitKey]	< $limitValueBottom	OR
				$array[$key0][$limitKey]	>= $limitValueTop){
				//print_r('$array[$key0][$limitKey]	> $limitValue'.'<br />  ');
				//print_r( '<br />  ');
				unset($array[$key0]);
			}
	
		}

		return $array;
	}
		
	
	//Class method: cutting dataArray with time limit
	public function cutArrayByLimit($dataArray, $limitKey, $limitValue, $direction){
		/*	input	(string, array, nothing)
					$limitKey	example		'date'
					$limitValue	example		'2011-10-14'
					$direction	example		'up' or 'down'
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->cutArrayByLimit($annParam, $dataArray);	*/
		
		if(empty($dataArray)	OR	empty($limitKey)	OR	empty($limitValue)	OR	empty($direction)){			
			//print_r('Bad use function cutArrayByLimit '); 
			return $dataArray;
		}
		
		$cut	=	false;
		foreach($dataArray as $key0 => $str0){

			/*	//Debugging	
				if(			$direction	== 'up'){
					print_r('[$key0]: '.$key0.' <br />  ');
					print_r('$dataArray[$key0][$limitKey]:	'.$dataArray[$key0][$limitKey].' <br /> ');
					print_r('$limitKey: '.$limitKey.' <br />  ');				
					print_r('$limitValue: '.$limitValue.' <br />  ');
					print_r('count($dataArray): '.count($dataArray).' <br />  ');	
				}		
			*/
		
			if(	empty($dataArray[$key0]) OR $limitValue	==	'')	{continue;}
		

			if(			$direction	== 'up'		AND	$dataArray[$key0][$limitKey]	> $limitValue){
				//print_r('$dataArray[$key0][$limitKey]	> $limitValue'.'<br />  ');
				//print_r( '<br />  ');
				$cut	=	true;
			}
			else if (	$direction	== 'up'		AND	$dataArray[$key0][$limitKey]	< $limitValue){
				$cut	=	false;
				//print_r( '<br />  ');
			}

			
			if(			$direction	== 'down'	AND	$dataArray[$key0][$limitKey]	<= $limitValue){
				$cut	=	true;
			}
			else if (	$direction	== 'down'	AND	$dataArray[$key0][$limitKey]	> $limitValue){				
				$cut	=	false;
			}

			
			//Delete the element of the array
			if(	$cut == true)		{	unset($dataArray[$key0]);}

			
		}
		
		return $dataArray;
	}
		

	//Class method: Form bulk test table
	public function ppppBulkTestTable($annParam){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->ppppBulkTestTable($annParam);;	*/	
	
			$reportByDate	=	'<table class="table table-hover">'.
				'<thead>'.
					'<tr>'.
						'<th>Date:</th>'.					
						'<th>Num:</th>'.
						'<th>S:</th>'.
						'<th>O:</th>'.
						'<th>B:</th>'.
						'<th>Market:</th>'.
						'<th>Test:</th>'.
						'<th>P/L:</th>'.
						'<th>Aka:</th>'.
						'<th>Coeff.:</th>'.
					'</tr>'.
				'</thead>'.
				'<tbody>';

			//Preparing a table Report by date
			foreach($annParam['dataAnnTest']['dataSet'] as $key0 => $str0){

				$tempDate	=	$annParam['dataAnnTest']['dataSet'][$key0]['date'];
				//$tempDate	=	$this->restoreDateHyphen($annParam['dataAnnTest']['dataSet'][$key0]['date']);
			
				$reportByDate				.=	'<tr>';
							
				$reportByDate				.=
'<td>'.$tempDate.'</td>'.
'<td>'.$annParam['dataAnnTest']['dataSet'][$key0]['summaryByDate']['numTotal'].'</td>'.
'<td>'.$annParam['dataAnnTest']['dataSet'][$key0]['summaryByDate']['voteRound']['sell'].'</td>'.
'<td>'.$annParam['dataAnnTest']['dataSet'][$key0]['summaryByDate']['voteRound']['out'].'</td>'.
'<td>'.$annParam['dataAnnTest']['dataSet'][$key0]['summaryByDate']['voteRound']['buy'].'</td>'.
'<td>'.$annParam['dataAnnTest']['dataSet'][$key0]['summaryByDate']['testIntpr']['verbal'].'</td>';

				$reportByDate				.=
'<td>'.$annParam['dataAnnTest']['dataSet'][$key0]['summaryByDate']['outcome']['rateRound'].'</td>'.		
'<td>'.$annParam['dataAnnTest']['dataSet'][$key0]['summaryByDate']['outcome']['valueRound'].'</td>'.
'<td>'.$annParam['dataAnnTest']['dataSet'][$key0]['summaryByDate']['outcome']['verbal'].'</td>'.
'<td>'.$annParam['dataAnnTest']['dataSet'][$key0]['summaryByDate']['outcome']['valuePlusOne'].'</td>';

				
				
				
				$reportByDate				.=	'</tr>';
			}
			
			$reportByDate					.=	'<tbody></table>';

		$annParam['dataAnnTest']['bulkTestTable']	=	$reportByDate;
		
		return $annParam;
	}
	
	
	//Class method: Form bulk test report
	public function ppppBulkTestReport($annParam){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->ppppBulkTestReport($annParam);;	*/	
	

		//Preparing a tables the Summary for the whole data set
		$string				=	'';
		$string				.=	
		'<div class="container">'.
            '<div class="row">'.
                '<div class="col-lg-3">';

				
		$string				.=
			'<table class="table table-hover text-left">'.
				'<thead>'.
					'<tr>'.
						'<th class="col-md-12">Total and overal</th>'.
					'</tr>'.
				'</thead>'.
				'<tbody>';

		$string				.=
	'<!-- SECTION "TOTAL RESULTS TITLES" -->'.
		'<td>'.
			'<table class="table table-hover">'.	
				'<tr>'.
					'<td class="col-md-12">'.'Number cases ttl'.'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.'Number votes avg'.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.'Performance to year'.''.'</td>'.
				'</tr>'.				
				'<tr>'.
					'<td class="col-md-12">'.'Performance ttl'.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.'Probability true ttl'.'</td>'.
				'</tr>'.
			'</table>'.
		'</td>'.
	'</tr>'.				
	'<!-- /SECTION "TOTAL RESULTS TITLES" -->'.
	
	
	'<!-- SECTION "PERFORMANCE TITLES" -->'.
	'<tr>'.
		'<td class="col-md-12">'.
			'<div>'.'<span class="h4">Performance</span>&nbsp;&nbsp;'.'</div>'.
		'</td>'.
	'</tr>'.	
	'<tr id="performanceTitle" class="collapse">'.
		'<td>'.
			'<table class="table table-hover">'.	
				'<tr>'.
					'<td class="col-md-12">'.''.'2017'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'2016'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'2015'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'2014'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'2013'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'2012'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'2011'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'2010'.''.'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.''.'2009'.''.'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.''.'2008'.''.'</td>'.
				'</tr>'.	
			'</table>'.
		'</td>'.
	'</tr>'.
	'<!-- /SECTION "PERFORMANCE TITLES" -->'.
	
	
	'<!-- SECTION "PROBABILITY TITLES" -->'.
	'<tr>'.
		'<td class="col-md-12">'.
			'<div>'.'<span class="h4">Probability true</span>&nbsp;&nbsp;'.'</div>'.
		'</td>'.
	'</tr>'.
	'<tr id="probabilityTitle" class="collapse">'.
		'<td>'.
			'<table class="table table-hover">'.	
				'<tr>'.
					'<td class="col-md-12">'.''.'2017'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'2016'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'2015'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'2014'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'2013'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'2012'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'2011'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'2010'.''.'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.''.'2009'.''.'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.''.'2008'.''.'</td>'.
				'</tr>'.
			'</table>'.
		'<td>'.
	'</tr>'.
	'<!-- /SECTION "PROBABILITY TITLES" -->'.


	'<!-- SECTION "META DATA TITLES" -->'.
	'<tr>'.
		'<td class="col-md-12">'.
			'<div>'.'<span class="h4">Meta data</span>&nbsp;&nbsp;'.'</div>'.		
		'</td>'.
	'</tr>'.	
	'<tr id="metaDataTitle" class="collapse">'.
		'<td>'.
			'<table class="table table-hover">'.	
				'<tr>'.
					'<td class="col-md-12">'.''.'Data file'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'Ticket'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'Date start'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'Date finish'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'Period in days'.''.'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.''.'Depth (years)'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'Treshold'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'normalizYN'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'kExtends'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'minModelIn'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'maxModelIn'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'minModelOut'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'maxModelOut'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'numLayers'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'numNeuronsHidden'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'activationFunctionHidden'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'activationFunctionOutput'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'activationSteepnessHidden'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'activationSteepnessOutput'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'learningRate'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'learningMomentum'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'sarpropTemperature'.''.'</td>'.
				'</tr>'.				
				'<tr>'.
					'<td class="col-md-12">'.''.'Min epoch'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.'Max epoch'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.'Accepted error'.''.'</td>'.
				'</tr>'.	
			'</table>'.
		'</td>'.
	'</tr>'.
	'<!-- /SECTION "META DATA TITLES" -->'	
	;
	
		$string				.=	
				'</tbody></table>';			

		$string				.=
				'</div>';

		$string				.=
                '<div class="col-lg-2 text-center">';
				
		$string				.=
			'<table class="table table-hover">'.
				'<thead>'.
					'<tr>'.				
						'<th class="col-md-12 text-center">Value</th>'.
					'</tr>'.
				'</thead>'.
				'<tbody>';

				
		$string				.=
	'<!-- SECTION "TOTAL RESULTS VALUES" -->'.
	'<tr id="" class="">'.
		'<td>'.
			'<table class="table table-hover">'.		
				'<tr>'.
					'<td class="col-md-12">'.$annParam['dataAnnTest']['summary'][0]['numCase'].'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.$annParam['dataAnnTest']['summary'][0]['numVote'].'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.$annParam['dataAnnTest']['summary'][0]['prof2Year'].''.'</td>'.
				'</tr>'.				
				'<tr>'.
					'<td class="col-md-12">'.$annParam['dataAnnTest']['summary'][0]['perf'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.$annParam['dataAnnTest']['summary'][0]['probProf'].''.'</td>'.
				'</tr>'.
			'</table>'.
		'</td>'.
	'</tr>'.
	'<!-- /SECTION "TOTAL RESULTS VALUES" -->'.
	
	
	'<!-- SECTION "TOTAL PERFORMANCE VALUES" -->'.
	'<tr>'.
		'<td class="col-md-12">'.
			'<div>'.'<span class="h4"></span>&nbsp;&nbsp;'.
				'<button id="performanceButton" class="btn btn-info btn-xs btn-xsCustom">toggle</button>'.
			'</div>'.
		'</td>'.
	'</tr>'.
	'<tr id="performanceValue" class="collapse">'.
		'<td>'.
			'<table class="table table-hover">'.	
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2017]['perf'].'<!--2017-->'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2016]['perf'].'<!--2016-->'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2015]['perf'].'<!--2015-->'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2014]['perf'].'<!--2014-->'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2013]['perf'].'<!--2013-->'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2012]['perf'].'<!--2012-->'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2011]['perf'].'<!--2011-->'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2010]['perf'].'<!--2010-->'.''.'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2009]['perf'].'<!--2009-->'.''.'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2008]['perf'].'<!--2008-->'.''.'</td>'.
				'</tr>'.	
			'</table>'.	
		'</td>'.
	'</tr>'.
	'<!-- /SECTION "TOTAL PERFORMANCE VALUES" -->'.	
	
	
	'<!-- SECTION "TOTAL PROBABILITY VALUES" -->'.	
	'<tr>'.
		'<td class="col-md-12">'.
			'<div>'.'<span class="h4"></span>&nbsp;&nbsp;'.
				'<button id="probabilityButton" class="btn btn-info btn-xs btn-xsCustom">toggle</button>'.
			'</div>'.
		'</td>'.
	'</tr>'.	
	'<tr id="probabilityValue" class="collapse">'.
		'<td>'.
			'<table class="table table-hover">'.	
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2017]['probProf'].'<!--2017-->'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2016]['probProf'].'<!--2016-->'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2015]['probProf'].'<!--2015-->'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2014]['probProf'].'<!--2014-->'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2013]['probProf'].'<!--2013-->'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2012]['probProf'].'<!--2012-->'.''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2011]['probProf'].'<!--2011-->'.''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2010]['probProf'].'<!--2010-->'.''.'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2009]['probProf'].'<!--2009-->'.''.'</td>'.
				'</tr>'.	
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dataAnnTest']['summary'][2008]['probProf'].'<!--2008-->'.''.'</td>'.
				'</tr>'.
			'</table>'.
		'</td>'.
	'</tr>'.	
	'<!-- /SECTION "TOTAL PROBABILITY VALUES" -->'.	


	'<!-- SECTION "META DATA VALUES" -->'.
	'<tr>'.
		'<td class="col-md-12">'.
			'<div>'.'<span class="h4"></span>&nbsp;&nbsp;'.
				'<button id="metaDataButton" class="btn btn-info btn-xs btn-xsCustom">toggle</button>'.
			'</div>'.
		'</td>'.
	'</tr>'.	
	'<tr id="metaDataValue" class="collapse">'.
		'<td>'.
			'<table class="table table-hover">'.	
				'<tr>'.
					'<td class="col-md-12 noWrap">'.''.$annParam['fileNameIn'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12 noWrap">'.''.$annParam['ticketOut'].''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dateBegin'].''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dateEnd'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['dateDays'].''.'</td>'.
				'</tr>'.				
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['depthData'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['treshold'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['normalizYN'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['kExtends'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['minModelIn'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['maxModelIn'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['minModelOut'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['maxModelOut'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['numLayers'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['numNeuronsHidden'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['activationFunctionHidden'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['activationFunctionOutput'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['activationSteepnessHidden'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['activationSteepnessOutput'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['learningRate'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['learningMomentum'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['sarpropTemperature'].''.'</td>'.
				'</tr>'.				
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['minEpoch'].''.'</td>'.
				'</tr>'.		
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['maxEpoch'].''.'</td>'.
				'</tr>'.
				'<tr>'.
					'<td class="col-md-12">'.''.$annParam['acceptedError'].''.'</td>'.
				'</tr>'.	
			'</table>'.
		'</td>'.
	'</tr>'.
	'<!-- /SECTION "META DATA VALUES" -->'
	;	
		$string				.=
				'</div>';

		$string				.=
                '<div class="col-lg-7 text-center">';	
		$string				.=
				'</div>';
	
		$string				.=	
            '</div>'.
		'</div>';				
			
		$annParam['dataAnnTest']['bulkTestReport']	=	$string;
	
		
		return $annParam;
	}


	//Class method: Run bulk tests to form  and enreach annParam array
	public function ppppBulkTest4AnnParam($annParam){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->ppppBulkTest4AnnParam($annParam);	*/	
	
		//Getting cutted by 'dateFinishDTT' array from file with our standard
		$annParam['dataArray'] 		=	$this->fileTitlesDates2Array($annParam, '', '');
		//print_r($annParam['dataArray']);			
			
		//Enriching or update array with normalization data
			//Should be after $annParam['numInputData'] is defined
		$annParam['dataArray'] = $this->normalizationVertical($annParam['dataArray'], $annParam);
			//print_r($annParam['dataArray']); return;
		
		//Creating array on the basis of saved ANN files
			$fileDir			=	array_slice(scandir($annParam['dirAnn']), 2); 
			
			$fileDirArray		=	array();
			foreach($fileDir as $key0 => $str0){
				
				$fileNameInfo						=	$this->getAnnFileNameInfo($fileDir[$key0]);
				
				$fileDirArray[$key0]['date']		=	$fileNameInfo['date'];		
				$fileDirArray[$key0]['cycle']		=	$fileNameInfo['cycle'];	
				$fileDirArray[$key0]['epoch']		=	$fileNameInfo['epoch'];		
				$fileDirArray[$key0]['mse']			=	$fileNameInfo['mse'];
				$fileDirArray[$key0]['timeTeach']	=	$fileNameInfo['timeTeach'];
				$fileDirArray[$key0]['fileNameAnn']	=	$fileDir[$key0];
			}
			//print_r($fileDirArray); return;

			//Reform $fileDirArray to date key array
			$fileDirArrayRef	=	array();
			$i					=	0;
			$n					=	0;
			$dateTemp			=	$fileDirArray[0]['date'];
			
			foreach($fileDirArray as $key0 => $str0){
				
				if($dateTemp 	!=	$fileDirArray[$key0]['date']){ 
					$dateTemp							=	$fileDirArray[$key0]['date'];
					$i++;
					$n	=	0;
					$fileDirArrayRef[$i]['dataItem']				=	array();
				}

				$fileDirArrayRef[$i]['date']			=	$fileDirArray[$key0]['date'];
	
				$fileDirArrayRef[$i]['dataItem'][$n]['cycle']		=	$fileDirArray[$key0]['cycle'];	
				$fileDirArrayRef[$i]['dataItem'][$n]['epoch']		=	$fileDirArray[$key0]['epoch'];		
				$fileDirArrayRef[$i]['dataItem'][$n]['mse']			=	$fileDirArray[$key0]['mse'];
				$fileDirArrayRef[$i]['dataItem'][$n]['timeTeach']	=	$fileDirArray[$key0]['timeTeach'];
				$fileDirArrayRef[$i]['dataItem'][$n]['fileNameAnn']	=	$fileDirArray[$key0]['fileNameAnn'];					
				$n++;
			}
			//print_r($fileDirArrayRef); return;

			
			//Make left join $fileDirArray with $annParam['dataArray'] to $annParam['dataAnnTestArray']
			$annParam['dataAnnTest']['dataSet'] 		=	
				$this->arrayJoinLeft($fileDirArrayRef, $annParam['dataArray'], 'date');
			//print_r($annParam['dataAnnTest']['dataSet']); return;

			
		//Enriching dataAnnTest array with data about testing data
			unset($fileDir);
			unset($fileDirArray);
			unset($fileNameInfo);
			
			$fileDir	=	array_slice(scandir($annParam['dirData']), 2); 
			//print_r($fileDir);
			
			foreach($fileDir as $key0 => $str0){
				
				$regExp4Exclude	=		'/^('.'data-'.')([\s\S]*)$/imxuU';
				if(preg_match($regExp4Exclude, $fileDir[$key0])){continue;}								
				$fileNameInfo						=	$this->getAnnFileNameInfo($fileDir[$key0]);
				
				foreach($annParam['dataAnnTest']['dataSet'] as $key1 => $str1){
					
					if($fileNameInfo['date'] == $annParam['dataAnnTest']['dataSet'][$key1]['date']){
						$annParam['dataAnnTest']['dataSet'][$key1]['fileNameTest']	=	$fileDir[$key0];
					}
					
				}
			}
			//print_r($annParam['dataAnnTest']['dataSet']); return;
			
			
		//Running the test with the set of saved ANN files and create $annParam['dataAnnTest'] array
			foreach($annParam['dataAnnTest']['dataSet'] as $key0 => $str0){
				
				$annParam['tempDate']			=	$annParam['dataAnnTest']['dataSet'][$key0]['date'];
				$annParam['fileNameTest']		=	$annParam['dataAnnTest']['dataSet'][$key0]['fileNameTest'];
				
				
				foreach($annParam['dataAnnTest']['dataSet'][$key0]['dataItem']  as $key1 => $str1){
					
					$annParam['fileNameAnn']	=	
						$annParam['dataAnnTest']['dataSet'][$key0]['dataItem'][$key1]['fileNameAnn'];
					$annParam['dataAnnTest']['dataSet'][$key0]['dataItem'][$key1]['dataTest']	=	
						$this->ppppRunTest($annParam);
						
				/*	if(max(array_keys($annParam['dataAnnTest']['dataSet'])) == $key0){
						print_r($key0.'<br />');
						print_r($annParam['dataAnnTest']['dataSet'][$key0]['dataItem'][$key1]['dataTest']);	
					}	
				*/

				}
			}
		
		return $annParam;
	}	
	
	
	//Class method: Make left join $leftArray and $rightArray by $fieldJoin
	public function restoreDateHyphen($input){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->restoreDateHyphen($input);	*/	
	
		$input		=	(string) $input;
		$string		=	preg_replace('/^([\d]{4,4})([\d]{2,2})([\d]{2,2})$/imxuU', '$1-$2-$3', $input);
		
		return $string;
	}
		
	
	//Class method: Calculate summary statistics for probability for a period
	public function periodCaseVote($array, $dateStart, $dateFinish, $precision){
		/*	input	(string, array, nothing)
				$dateStart 		period date start
				$dateFinish		period date finish	
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $this->periodProbabilityProf($array, $dateStart, $dateFinish, $precision);
		*/		
		
		
		$tempArray	=	$this->cutArrayByPeriod($array, 'date', $dateStart, $dateFinish);
		//print_r($tempArray);

		$outcome['numCase']		=	0;
		$outcome['numVote']	=	0;	

		foreach(	$tempArray as $key0 => $str0){
			
			//Does the code if rate exist, other wise make it blank
			if (!array_key_exists('prof', $tempArray[$key0]['summaryByDate']['outcome'])) {
				continue;
			}
			
			$outcome['numVote']	+= 
				$tempArray[$key0]['summaryByDate']['numTotal'];
		}

		
		//Return number of cases
			$outcome['numCase']	=	count($tempArray);
		
		//Return avg number of votes per a case
			if($outcome['numCase']	!=	0){
				$outcome['numVote']	=	$outcome['numVote']/$outcome['numCase'];
			}
			else{
				$outcome['numVote']	=	0;
			}
			$outcome['numVote']	=	round($outcome['numVote'], 0);	
			
		return	$outcome;
	}
	
	
	//Class method: Calculate summary statistics for probability for a period
	public function periodProbabilityProf($array, $dateStart, $dateFinish, $precision){
		/*	input	(string, array, nothing)
				$dateStart 		period date start
				$dateFinish		period date finish	
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $this->periodProbabilityProf($array, $dateStart, $dateFinish, $precision);
		*/		
		
		
		$tempArray	=	$this->cutArrayByPeriod($array, 'date', $dateStart, $dateFinish);
		//print_r($tempArray);

		$profNumTtl	=	0;
		$outNumTtl	=	0;
		$lossNumTtl	=	0;		

		foreach(	$tempArray as $key0 => $str0){
			
			//Does the code if rate exist, other wise make it blank
			if (!array_key_exists('prof', $tempArray[$key0]['summaryByDate']['outcome'])) {
				continue;
			}
			
			if( $tempArray[$key0]['summaryByDate']['outcome']['prof']	== 1){
				$profNumTtl	+=	1;}
			if( $tempArray[$key0]['summaryByDate']['outcome']['out']	== 1){	
				$outNumTtl	+=	1;}
			if( $tempArray[$key0]['summaryByDate']['outcome']['loss']	== 1){	
				$lossNumTtl	+=	1;}
		}

		//Return probability of profit
			$numTtl	=	$profNumTtl+$lossNumTtl;
			if($numTtl	!=	0){
				$outcome	=	$profNumTtl/($profNumTtl+$lossNumTtl);
			}
			else{
				$outcome	=	0;
			}
			
			$outcome	=	round(	$outcome*100,$precision);	
			
		return	$outcome;
	}
	
		
	//Class method: Calculate summary statistics for performance for a period
	public function periodPerformance($array, $dateStart, $dateFinish, $precision){
		/*	input	(string, array, nothing)
				$dateStart 		period date start
				$dateFinish		period date finish	
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$number = $this->periodPerformance($annParam, $dateStart, $dateFinish, $precision);	*/		
		
		
		$tempArray	=	$this->cutArrayByPeriod($array, 'date', $dateStart, $dateFinish);
		//print_r($tempArray);
		
		$outcome		=	1;
		
		//Caculate summary by data set data
		foreach(	$tempArray as $key0 => $str0){
			
			//Does the code if rate exist, other wise make it blank
			if (!array_key_exists('rate', $tempArray[$key0])) {
				continue;
			}
			
			$outcome	=
				$outcome*
				$tempArray[$key0]['summaryByDate']['outcome']['valuePlusOne'];		
		}			
			
		//Return rounded performance (coefficient growth, melting of the portfolio)
			$outcome			=
				round(	($outcome-1)*100, $precision);

			
		return	$outcome;
	}
	
	
	//Class method: Calculate summary statistics data
	public function testInterptetationSummary($annParam){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$annParam = $microFunctionsAnn->testInterptetationSummary($annParam);	*/	
				
			//Return rounded performance (coefficient growth, melting of the portfolio)
			
		$dateNameArr[0]		=	array('dateStart' => '2000-01-01', 'dateFinish' => '2100-01-01', 'precision' => 1);
		$dateNameArr[2008]	=	array('dateStart' => '2008-01-01', 'dateFinish' => '2009-01-01', 'precision' => 1);
		$dateNameArr[2009]	=	array('dateStart' => '2009-01-01', 'dateFinish' => '2010-01-01', 'precision' => 1);
		$dateNameArr[2010]	=	array('dateStart' => '2010-01-01', 'dateFinish' => '2011-01-01', 'precision' => 1);
		$dateNameArr[2011]	=	array('dateStart' => '2011-01-01', 'dateFinish' => '2012-01-01', 'precision' => 1);
		$dateNameArr[2012]	=	array('dateStart' => '2012-01-01', 'dateFinish' => '2013-01-01', 'precision' => 1);
		$dateNameArr[2013]	=	array('dateStart' => '2013-01-01', 'dateFinish' => '2014-01-01', 'precision' => 1);
		$dateNameArr[2014]	=	array('dateStart' => '2014-01-01', 'dateFinish' => '2015-01-01', 'precision' => 1);
		$dateNameArr[2015]	=	array('dateStart' => '2015-01-01', 'dateFinish' => '2016-01-01', 'precision' => 1);
		$dateNameArr[2016]	=	array('dateStart' => '2016-01-01', 'dateFinish' => '2017-01-01', 'precision' => 1);
		$dateNameArr[2017]	=	array('dateStart' => '2017-01-01', 'dateFinish' => '2018-01-01', 'precision' => 1);
		
		foreach($dateNameArr as $key0 => $str0){
		
			$dateStart	=	$dateNameArr[$key0]['dateStart']; 
			$dateFinish	=	$dateNameArr[$key0]['dateFinish'];
			
				$precision	=	0;
				
			//Calculate number of cases and avg number of votes per a case
			$periodCaseVote	=	
					$this->periodCaseVote($annParam['dataAnnTest']['dataSet'], $dateStart, $dateFinish, $precision);
			$annParam['dataAnnTest']['summary'][$key0]['numCase']	=	$periodCaseVote['numCase'];
			$annParam['dataAnnTest']['summary'][$key0]['numVote']	=	$periodCaseVote['numVote'];
			
				$precision	=	1;
			
			//Calculate performance for periods
			$annParam['dataAnnTest']['summary'][$key0]['perf']	=	
				$this->periodPerformance($annParam['dataAnnTest']['dataSet'], $dateStart, $dateFinish, $precision);
			//Calculate probability for periods
			$annParam['dataAnnTest']['summary'][$key0]['probProf']	=	
				$this->periodProbabilityProf($annParam['dataAnnTest']['dataSet'], $dateStart, $dateFinish, $precision);						
		}
		
		
		//Calculate performance powered by year
			//Return array key with max value 
				//$minKeyArr		=	max(array_keys($annParam['dataAnnTest']['dataSet']));
				$minKey			=	min(array_keys($annParam['dataAnnTest']['dataSet']));
				//$maxKeyArr		=	array_keys($annParam['dataAnnTest']['dataSet'], max($annParam['dataAnnTest']['dataSet']));
				$maxKey			=	max(array_keys($annParam['dataAnnTest']['dataSet']));
					//print_r($minKey.'<br />');
					//print_r($maxKey.'<br />');

			
			
			$annParam['dateBegin']	=	strtotime((string)$annParam['dataAnnTest']['dataSet'][$minKey]['date']);			
			$annParam['dateEnd']	=	strtotime((string)$annParam['dataAnnTest']['dataSet'][$maxKey]['date']);

				//print_r($annParam['dataAnnTest']['dataSet'][$minKey]['date'].'<br />');
				//print_r($annParam['dataAnnTest']['dataSet'][$maxKey]['date'].'<br />');	
				//print_r($annParam['dateBegin'].'<br />');		
				//print_r($annParam['dateEnd'].'<br />');	
			
			$timeDifference			=	$this->timeDifference($annParam['dateBegin'], $annParam['dateEnd']);

			$annParam['dataAnnTest']['summary'][0]['prof2Year']	= 
				$annParam['dataAnnTest']['summary'][0]['perf']/( $timeDifference['days']/365);
			$annParam['dataAnnTest']['summary'][0]['prof2Year']	=
				round($annParam['dataAnnTest']['summary'][0]['prof2Year'],1);

			$annParam['dateBegin']	=	date('Y-m-d',$annParam['dateBegin']);
			$annParam['dateEnd']	=	date('Y-m-d',$annParam['dateEnd']);
			$annParam['dateDays']	=	$timeDifference['days'];
			
		/*	print_r($timeDifference['days'].'<br />');				
			print_r($annParam['dataAnnTest']['summary'][0]['perf'].'<br />');		
		*/
		return $annParam;
	}	
	
	
	//Class method: Make left join $leftArray and $rightArray by $fieldJoin
	public function testDateInterptetation2dataArray($annParam){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->testDateInterptetation2dataArray($annParam);	*/	

			//print_r($annParam); return;
			
			foreach(	$annParam['dataAnnTest']['dataSet'] as $key0 => $str0){
				
				$summaryByDate['numTotal']			=	count($annParam['dataAnnTest']['dataSet'][$key0]['dataItem']);
				$summaryByDate['vote']['sell']						=	0;
				$summaryByDate['vote']['out']						=	0;
				$summaryByDate['vote']['buy']						=	0;
				$summaryByDate['testIntpr']['digit']['sell']		=	0;
				$summaryByDate['testIntpr']['digit']['out']			=	0;
				$summaryByDate['testIntpr']['digit']['buy']			=	0;
				$summaryByDate['outcome']['prof']					=	0;
				$summaryByDate['outcome']['out']					=	0;
				$summaryByDate['outcome']['loss']					=	0;

				
				foreach($annParam['dataAnnTest']['dataSet'][$key0]['dataItem'] as $key1 => $str1){
				
					//print_r($annParam['dataAnnTest']['dataSet']); return;
				
					$summaryByDate['vote']['sell']	+=	
						$annParam['dataAnnTest']['dataSet'][$key0]['dataItem'][$key1]['dataTest']['testIntpr']['digit']['sell'];
					$summaryByDate['vote']['out']	+=	
						$annParam['dataAnnTest']['dataSet'][$key0]['dataItem'][$key1]['dataTest']['testIntpr']['digit']['out'];
					$summaryByDate['vote']['buy']	+=	
						$annParam['dataAnnTest']['dataSet'][$key0]['dataItem'][$key1]['dataTest']['testIntpr']['digit']['buy'];
				}


					$summaryByDate['voteRound']['sell']	=	
						round(	$summaryByDate['vote']['sell']	/$summaryByDate['numTotal']*100,0);
					$summaryByDate['voteRound']['out']	=	
						round(	$summaryByDate['vote']['out']	/$summaryByDate['numTotal']*100,0);
					$summaryByDate['voteRound']['buy']	=	
						round(	$summaryByDate['vote']['buy']	/$summaryByDate['numTotal']*100,0);

					//Return array key with max value 
					$maxKey		=	array_keys($summaryByDate['vote'], max($summaryByDate['vote']));
					
					$summaryByDate['testIntpr']['digit'][$maxKey[0]]	=	1;
					$summaryByDate['testIntpr']['verbal']				=	$maxKey[0];
					
					//print_r($annParam['dataAnnTest']['dataSet'][0]); return;
					
					//Does the code if rate exist, other wise make it blank
					if (!array_key_exists('rate', $annParam['dataAnnTest']['dataSet'][$key0])) {
						$summaryByDate['outcome']['rateRound']					=	'';
						$summaryByDate['outcome']['valueRound']					=	'';
						$summaryByDate['outcome']['verbal']						=	'';
						$summaryByDate['outcome']['valuePlusOne']				=	1;						
					}
					else{
						if(	($annParam['dataAnnTest']['dataSet'][$key0]['rate']	>	0 AND 
							 $summaryByDate['testIntpr']['digit']['buy']		==	1) OR
							($annParam['dataAnnTest']['dataSet'][$key0]['rate'] <	0 AND 
							 $summaryByDate['testIntpr']['digit']['sell']		==	1)){
							 
							 $summaryByDate['outcome']['value']				=	abs($annParam['dataAnnTest']['dataSet'][$key0]['rate']);
							 $summaryByDate['outcome']['verbal']			=	'prof';
							 $summaryByDate['outcome']['prof']				=	1;
						}
						else if(
							($annParam['dataAnnTest']['dataSet'][$key0]['rate'] >	0 AND 
							 $summaryByDate['testIntpr']['digit']['sell']		==	1) OR
							($annParam['dataAnnTest']['dataSet'][$key0]['rate'] <	0 AND 
							 $summaryByDate['testIntpr']['digit']['buy']		==	1)){
								 
							 $summaryByDate['outcome']['value']				=	(-1)*abs($annParam['dataAnnTest']['dataSet'][$key0]['rate']);						
							 $summaryByDate['outcome']['verbal']			=	'loss';
							 $summaryByDate['outcome']['loss']				=	1;
						 }
						else{
							$summaryByDate['outcome']['value']				=	0;	
							$summaryByDate['outcome']['verbal']				=	'null';
							$summaryByDate['outcome']['out']				=	1;
						}
							
							$summaryByDate['outcome']['rateRound']			=
								round(	$annParam['dataAnnTest']['dataSet'][$key0]['rate'],4);							
							$summaryByDate['outcome']['valueRound']			=
								round(	$summaryByDate['outcome']['value'],4);
							$summaryByDate['outcome']['valuePlusOne']		=
								1+$summaryByDate['outcome']['value'];
					}
				//See more about union operator: http://stackoverflow.com/questions/5783750/php-add-item-to-beginning-of-associative-array
				$annParam['dataAnnTest']['dataSet'][$key0] 	= 	
					array('summaryByDate' 	=> $summaryByDate) 	+ $annParam['dataAnnTest']['dataSet'][$key0];
			}
			
			
			
		
		//print_r($annParam['dataAnnTest']); return;
		
		return $annParam;
	}
	
	
	//Class method: Make 
	public function testItemInterptetation01($array){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->testItemInterptetation01($array);	*/	
	
		$testIntpr						=	array();
		$testIntpr['digit']['sell']		=	0;
		$testIntpr['digit']['out']		=	0;
		$testIntpr['digit']['buy']		=	0;
		
		$temp['sell']					=	($array[0] + $array[1])/2;
		$temp['out']					=	 $array[2];
		$temp['buy']					=	($array[3] + $array[4])/2;
		
		//Return array key with max value 
		$maxKey 						=	array_keys($temp, max($temp));
		//print_r($maxKey[0]);
		
		$testIntpr['digit'][$maxKey[0]]	=	1;
		$testIntpr['verbal']			=	$maxKey[0];
		
		return $testIntpr;
	}

	
	//Class method: Make left join $leftArray and $rightArray by $fieldJoin
	public function arrayJoinLeft($leftArray, $rightArray, $fieldJoin){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->arrayJoinLeft($leftArray, $rightArray, $fieldJoin);	*/
		
		foreach($leftArray as $key0	=>	$str0){
			
			foreach($rightArray as $key1	=>	$str1){
			
				if($leftArray[$key0][$fieldJoin] == $rightArray[$key1][$fieldJoin]){
					
					//Add main array to a new array
					$outputArray[$key0]					=	$leftArray[$key0];					
					
					//Get keys of "right" array
					$arrayKeysRightArray	=	array_keys($rightArray[$key1]);
					
					foreach($arrayKeysRightArray as $key2	=>	$str2){
						
						$outputArray[$key0][$str2]	=	$rightArray[$key1][$str2];

					}

				}
			}
		}
		
		return $outputArray;
	}
		

	//Class method: getting info from ANN file name
	public function getAnnFileNameInfo($fileName){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->getAnnFileNameInfo($fileName);	*/
			
		$outArray['date']		=			preg_replace('/^([\S]*)([\d]{4,4})-([\d]{2,2})-([\d]{2,2})([\S]*)$/imxuU', '$2-$3-$4', $fileName);
		$outArray['date']		=			date('Y-m-d',strtotime($outArray['date']));
		$outArray['cycle']		=	(int)	preg_replace('/^([\S]*)-c([\d]{1,})-([\S]*)$/imxuU', '$2', $fileName);
		$outArray['epoch']		=	(int)	preg_replace('/^([\S]*)-e([\d]{1,})-([\S]*)$/imxuU', '$2', $fileName);
		$outArray['mse']		=	(float)	preg_replace('/^([\S]*)-m([\d\.]{1,})-([\S]*)$/imxuU', '$2', $fileName);
		$outArray['timeTeach']	=			preg_replace('/^([\S]*)-\#([\d]{4,4})-([\d]{2,2})-([\d]{2,2})&([\d]{2,2})-([\d]{2,2})-([\d]{2,2})([\S]*)$/imxuU', '$2-$3-$4 $5:$6:$7', $fileName);
		
		return $outArray;
	}

	
	//Class method: getting json string of file names from certain directory
	public function getJsonListFileDir($dirName,$namePartExclude){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->getJsonListFileDir($dirName);	*/
			
		$fileDir	=	array_slice(scandir($dirName), 2); 
		//print_r($fileDir);

		//Формируем JSON строку
		$string		= '';
		$string		= '[';
		
		//for ($key0=0; $key0<=100; $key0++) {		

		$key1	= 0;
		foreach($fileDir as $key0 => $str0){
			
			if(!empty($namePartExclude)){
				$regExp4Exclude	=		'/^('.$namePartExclude.')([\s\S]*)$/imxuU';
				if(preg_match($regExp4Exclude, $fileDir[$key0])){continue;}
			}
		
			$string .= '{';
			$string .= '"fileData":"'.	$fileDir[$key0]	.'"';	//
			$string .= '},';

		}
			/*	That does not work now
				$string	.= '{';
				$string .= '"msetrainReportArray":"'.	round($trainReportArray*100,1)	.'"';	
				$string	.= '}';
			*/
		$string	    .= ']';		
		$string		 = preg_replace("/^([\s\S]*)(,\])$/imxuU", "$1]", $string);
		
		return $string;
	}
	
	
	//Class method: delete all files in a certain directory
	public function deleteFileDir($dirName){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->deleteFileDir($dirName);	*/
			
			//Delete all files in data directory
		$fileDir	=	array_slice(scandir($dirName), 2); 
		//print_r($fileDir);

		foreach($fileDir as $key0 => $str0){
			if(is_readable	($dirName.$fileDir[$key0]) )
			{	unlink		($dirName.$fileDir[$key0]);}
		}
		return;
	}

	
	//Class method: fill name with 0 if the number less than n digits
	public function nameFilledZeroNumDigits($key, $maxLength){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->nameFilledZeroNumDigits($key, $length);	*/
		
		$key		=	(int)$key;
		$maxLength	=	(int)$maxLength;
				
		$leftPart	=	'';
		$zeroSource	=	'000000000000000000000000000000000';
		
		if		($key >= 0		AND $key <10		AND $maxLength > 0)	{ $leftPart	=	substr($zeroSource, 0, $maxLength -1);}
		else if	($key >= 10		AND $key <100		AND $maxLength > 1)	{ $leftPart	=	substr($zeroSource, 0, $maxLength -2);}
		else if	($key >= 100	AND $key <1000		AND $maxLength > 2)	{ $leftPart	=	substr($zeroSource, 0, $maxLength -3);}
		else if	($key >= 1000	AND $key <10000		AND $maxLength > 3)	{ $leftPart	=	substr($zeroSource, 0, $maxLength -4);}
		else if	($key >= 10000	AND $key <100000	AND $maxLength > 4)	{ $leftPart	=	substr($zeroSource, 0, $maxLength -5);}
		else if	($key >= 100000 AND $key <1000000	AND $maxLength > 5)	{ $leftPart	=	substr($zeroSource, 0, $maxLength -6);}		

		
		$key		=	strval($key);
		$xZeroKey	=	$leftPart.$key;
		return $xZeroKey;
	}


	//Class method: counting lines in a file. See: http://stackoverflow.com/questions/2162497/efficiently-counting-the-number-of-lines-of-a-text-file-200mb
	public function getNumLineFile($dirName, $fileName){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->getNumLineFile($dirName, $fileName);	*/
		
		if(!is_readable	($dirName.$fileName)){ return 'File unreadable: no lines';}
		
		$file=$dirName.$fileName;
		$linecount = 0;
		$handle = fopen($file, "r");
		while(!feof($handle)){
		  $line = fgets($handle);
		  $linecount++;
		}

		fclose($handle);	
		
		return $linecount;
	}
		
		
	//Class method: fileTitlesDates2Array
	public function fileTitlesDates2Array($annParam){
		/*	input	(string)  
			output	(array)
			$microFunctionsAnn	= new microFunctionsAnn();
			$array = $microFunctionsAnn->fileTitlesDates2Array($annParam);	*/

		if(!is_readable($annParam['dirNameIn'].$annParam['fileNameIn'])){	return 'Ini file not readable'; }
			
		//Read a file into the string
			$string	=	$this->file_get_contents_utf8($annParam['dirNameIn'].$annParam['fileNameIn']);
		//Delete new line at the end of the file if it is
			$string	=	preg_replace('/([\s\S]*?)([\n\r]{1,})($)/imxuU', '$1$3', $string);
		
		
		$stringArrayNewLine	=	array();
		$stringArrayNewLine	=	explode("\n",$string);
		
		//Creating initial array from input data file
		$array0	=	array();
		foreach($stringArrayNewLine as $key0	=>	$str0){
			$array0[$key0]	=	explode(" ",$stringArrayNewLine[$key0]);
	
			foreach($array0[$key0] as $key1	=>	$str1){
				
				if($key0									==	0){continue;}
				
				$array1[$key0-1]['date']					=	date('Y-m-d',strtotime($array0[$key0][0]));	
				
				if($key1									==	0){continue;}
				
				$array1[$key0-1]['in'][$key1-1]['label']	=	$array0[0][$key1];
				$array1[$key0-1]['in'][$key1-1]['status']	=	'';
				$array1[$key0-1]['in'][$key1-1]['value']	=	(float) $array0[$key0][$key1];
							
			}
			
		}		
		

		//Cutting arrayData with dateBottom and dateTop limits
			//print_r('Before cutArrayByLimit:  '); print_r($array1); return;		
			if(		!empty($annParam['dateBottom'])){	$direction = 'down';}
			else	{$annParam['dateBottom']	=	'';	$direction = '';}
			
			$array1 = $this->cutArrayByLimit($array1, 'date', $annParam['dateBottom'], $direction);	
			
			if(		!empty($annParam['dateTop'])){		$direction = 'up';}
			else	{$annParam['dateTop']	=	'';		$direction = '';}
			
			$array1 = $this->cutArrayByLimit($array1, 'date', $annParam['dateTop'], $direction);
				/*	//Debugging	
					if(	!empty($annParam['dateBottom'])){	
						print_r('After cutArrayByLimit up:  '.'<br />  ');  
						print_r('  Date bottom: '.$annParam['dateBottom'].' <br />  ');
						print_r('  Date top: '.$annParam['dateTop'].' <br />  ');
						print_r('  Direction: '.$direction.' <br />  ');
						print_r('  Array:  ');
						print_r($array1); return;
					}	
				*/

			
		//Add output for array 
		foreach($array1 as $key0 => $str0){
			

			foreach($array1[$key0]['in'] as $key1 => $str1){
				
				if($array1[$key0]['in'][$key1]['label']	!=	$annParam['ticketOut']){continue;}
				//print_r('I5_OHLC_NE'.'<br />');//'I5_OHLC_NE'
				//print_r($annParam['ticketOut'].'<br />');
				
				if(empty($array1[$key0]['in'][$key1]['value']) OR empty($array1[$key0+1]['in'][$key1]['value'])){continue;}	
				$rate	=	($array1[$key0+1]['in'][$key1]['value']-$array1[$key0]['in'][$key1]['value'])/
																	$array1[$key0]['in'][$key1]['value'];				
										
				if(													$rate	<=	-2.5*$annParam['treshold']){
					$array1[$key0]['out'][0]['value']	=	$annParam['maxModelOut'];

					$array1[$key0]['out'][1]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][2]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][3]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][4]['value']	=	$annParam['minModelOut'];					
				}
				else if($rate	>	-2.5*$annParam['treshold']	AND	$rate <= -$annParam['treshold']){
					$array1[$key0]['out'][0]['value']	=	$annParam['minModelOut'];
					
					$array1[$key0]['out'][1]['value']	=	$annParam['maxModelOut'];

					$array1[$key0]['out'][2]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][3]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][4]['value']	=	$annParam['minModelOut'];					
				}
				else if($rate	>	-$annParam['treshold']		AND	$rate <= $annParam['treshold'] ){
					$array1[$key0]['out'][0]['value']	=	$annParam['minModelOut'];					
					$array1[$key0]['out'][1]['value']	=	$annParam['minModelOut'];
					
					$array1[$key0]['out'][2]['value']	=	$annParam['maxModelOut'];
					
					$array1[$key0]['out'][3]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][4]['value']	=	$annParam['minModelOut'];
				}				
				else if($rate	>	$annParam['treshold']		AND	$rate <= 2.5*$annParam['treshold']){
					//print_r($array1[$key0]['date'].' '.$rate.'<br />');
					$array1[$key0]['out'][0]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][1]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][2]['value']	=	$annParam['minModelOut'];
					
					$array1[$key0]['out'][3]['value']	=	$annParam['maxModelOut'];
					
					$array1[$key0]['out'][4]['value']	=	$annParam['minModelOut'];					
				}				
				else if($rate > 2.5*$annParam['treshold']){
					//print_r($array1[$key0]['date'].' '.$rate.'<br />');
					$array1[$key0]['out'][0]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][1]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][2]['value']	=	$annParam['minModelOut'];
					$array1[$key0]['out'][3]['value']	=	$annParam['minModelOut'];					
					
					$array1[$key0]['out'][4]['value']	=	$annParam['maxModelOut'];
				}

				
				//See more about union operator: http://stackoverflow.com/questions/5783750/php-add-item-to-beginning-of-associative-array
					$label								=	'rate '.$array1[$key0]['in'][$key1]['label'];				
					$rate								=	(float) $rate;
					$array1[$key0] 						= 	array('rate' 	=> $rate) 	+ $array1[$key0];
					$array1[$key0] 						= 	array('label' 	=> $label) 	+ $array1[$key0];
					
			}
		}
		
		
		//Reindex the array
		$array	=	array_values($array1);
		
		//print_r($array1);
		return $array;
	}
	
	
	//Class method: file2Array
	public function file2Array($filename){
		/*	input	(string)  
			output	(array)
			$microFunctionsAnn	= new microFunctionsAnn();
			$array = $microFunctionsAnn->file2Array($filename);	*/
			
		//Read a file into the string
			$string	=	$this->file_get_contents_utf8($filename);
		//Delete new line at the end of thhe file if it is
			$string	=	preg_replace('/([\s\S]*?)([\n\r]{1,})($)/imxuU', '$1$3', $string);

		$arrayOutput	=	explode(" ",$string);

		return $arrayOutput;
	}
	
		
	//Class method: handling the text
	public function textHandling($text){
		/*	input	(string)  
			output	(array)
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->textHandling($text);	*/
			
		$text = preg_replace("/[^\p{L}]/iu", "", strtolower($text));			
			
			
		return $text;
	}


	//Class method: generation of frequencies
	public function generateFrequencies($text){
		/*	input	(string)  
			output	(array)
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->generateFrequencies($text);	*/
			
		// Удалим все кроме букв
		$text = $this->textHandling($text);

		// Найдем параметры для расчета частоты
		$total 	= strlen($text);
		$data 	= count_chars($text,0);
		
		//print_r($data);
			
		// Ну и сам расчет
		array_walk($data, function (&$item, $key, $total){
			$item = round($item/$total, 6);
		}, $total);

		return array_values($data);
		//print_r($data1);
		//echo '<br />'.'<br />';
		
	}


	//Class method: calculate and enrich array with minimum and maximum
	public function multiArrayMinMaxEnrich($arrayData, $annParam){
		/*	input	(string)  
			output	(array)
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->multiArrayMinMaxEnrich($arrayData, $annParam);	*/
			
		//Calculate and enrich array with minimum and maximum
		for ($key1 = 0; $key1 < $annParam['numInputData']; $key1++) {
			
			foreach($arrayData as $key0 => $str0){

				$arrayData[0]['in'][$key1]['min']	=	$arrayData[0]['in'][$key1]['value'];
				$arrayData[0]['in'][$key1]['max']	=	$arrayData[0]['in'][$key1]['value'];
				
				if(			$key0 == 0){continue;}
				
				//Calculate minimum
				if(	(float) $arrayData[$key0]['in'][$key1]['value'] <	(float) $arrayData[$key0-1]['in'][$key1]['min']){
							$arrayData[$key0]['in'][$key1]['min']	=	(float) $arrayData[$key0]['in'][$key1]['value'];
				}
				else{
							$arrayData[$key0]['in'][$key1]['min']	=	(float) $arrayData[$key0-1]['in'][$key1]['min'];
				}

				//Calculate maximum
				if(	(float) $arrayData[$key0]['in'][$key1]['value'] >	(float) $arrayData[$key0-1]['in'][$key1]['max']){
							$arrayData[$key0]['in'][$key1]['max']	=	(float) $arrayData[$key0]['in'][$key1]['value'];
				}
				else{
							$arrayData[$key0]['in'][$key1]['max']	=	(float) $arrayData[$key0-1]['in'][$key1]['max'];
				}
			}
		}

		for ($key1 = 0; $key1 < $annParam['numInputData']; $key1++) {
			
			foreach($arrayData as $key0 => $str0){

				$arrayData[$key0]['in'][$key1]['min']	=	$arrayData[$annParam['numTrainPair']]['in'][$key1]['min'];
				$arrayData[$key0]['in'][$key1]['max']	=	$arrayData[$annParam['numTrainPair']]['in'][$key1]['max'];
				
			}
		}
		
		return $arrayData;
	}


	//Class method: normalizationHorisontal
	public function normalizationVertical($arrayData, $annParam){
		/*	input		(array, array)  
			output	(array)
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->normalizationVertical($array, $annParam);	*/
		
		$arrayData	=	$this->multiArrayMinMaxEnrich($arrayData, $annParam);
		
				
		$arrNorm['kExtends']		=	$annParam['kExtends']; //0.1;
		$arrNorm['minModelIn']		=	$annParam['minModelIn']; //0;
		$arrNorm['maxModelIn']		=	$annParam['maxModelIn']; //1;		

		for ($key1 = 0; $key1 < $annParam['numInputData']; $key1++) {
			
			foreach($arrayData as $key0 => $str0){

				$arrNorm['minSource']		=	$arrayData[$key0]['in'][$key1]['min'];
				$arrNorm['maxSource']		=	$arrayData[$key0]['in'][$key1]['max'];		
				$arrNorm['minSourceK']		=	
					$arrNorm['minSource'] - ($arrNorm['maxSource'] - $arrNorm['minSource'])*$arrNorm['kExtends'];
				$arrNorm['maxSourceK']		=	
					$arrNorm['maxSource'] + ($arrNorm['maxSource'] - $arrNorm['minSource'])*$arrNorm['kExtends'];
			
				$arrayData[$key0]['in'][$key1]['valueNorm'] = 
					$arrNorm['minModelIn'] + ($arrayData[$key0]['in'][$key1]['value'] - $arrNorm['minSourceK'])*($arrNorm['maxModelIn'] - $arrNorm['minModelIn'])/
						($arrNorm['maxSourceK'] - $arrNorm['minSourceK']);			
			
				//$arrayData[$key0]['in'][$key1]['min']	=	$arrayData[$annParam['numTrainPair']+1]['in'][$key1]['min'];
				//$arrayData[$key0]['in'][$key1]['max']	=	$arrayData[$annParam['numTrainPair']+1]['in'][$key1]['max'];
				
			}
		}
		
		return $arrayData;
	}

	
	//Class method: normalizationHorisontal
	public function normalizationHorisontal($data, $annParam){
		/*	input		(array, array)  
			output	(array)
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->normalizationHorisontal($array, $param);	*/
			
		$arrNorm['kExtends']		=	$annParam['kExtends']; //0.1;
		$arrNorm['minModelIn']		=	$annParam['minModelIn']; //0;
		$arrNorm['maxModelIn']		=	$annParam['maxModelIn']; //1;
		$arrNorm['minSource']		=	min($data);
		$arrNorm['maxSource']		=	max($data);
		$arrNorm['minSourceK']		=	$arrNorm['minSource'] - ($arrNorm['maxSource'] - $arrNorm['minSource'])*$arrNorm['kExtends'];
		$arrNorm['maxSourceK']		=	$arrNorm['maxSource'] + ($arrNorm['maxSource'] - $arrNorm['minSource'])*$arrNorm['kExtends'];
		//echo $minSource.' '.$maxSource.' '.$minSourceK.' '.$maxSourceK.'<br />'.'<br />';
		//print_r($data);
		//echo '<br />'.'<br />';

		array_walk($data, function (&$item, $key, 
			$arrNorm){
				$item = $arrNorm['minModelIn'] + ($item - $arrNorm['minSourceK'])*($arrNorm['maxModelIn'] - $arrNorm['minModelIn'])/
						($arrNorm['maxSourceK'] - $arrNorm['minSourceK']);
				//echo $key.' => '.$item.'<br />'.'<br />';
		},	$arrNorm);
			
		//print_r($data);
		
		return array_values($data);
	}


	//Class method: converting array into a string and writing into the file
	public function arrayWriteString($dir, $filename, $array, $field){
		/*	input		(array)  
			output		(string)
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->arrayWriteString($dir, $filename, $array);	*/
		
		$filename	=	$dir.$filename;
		$dataFile	=	fopen($filename, 'a+') or die("Unable to open file!");
		
		//print_r($array);
		//echo $filename.'<br />';
		
		$maxArray	=	count($array)-1;
		//echo('$maxArray: '.$maxArray);
		
		foreach($array as $key0 => $str){
			
			//Avoid looping through not integer keys
			if(!is_int ( $key0 )){ 
				//print_r($key0);
				continue;}
			
			if(!$field OR $field == ''){
				$arrayKey0	= $array[$key0];
			}
			else{
				$arrayKey0	= $array[$key0][$field];
			}
				
			if		($key0 		<	$maxArray){
				$arrayKey0	=	$arrayKey0.' ';
				//echo('$array[$key0]: '.$array[$key0]);
			}
			else if	($key0		==	$maxArray){
				$arrayKey0	=	$arrayKey0."\n";
			}
			fwrite($dataFile, 	$arrayKey0);
		}

		fclose($dataFile);	

		return;
	}


	//Метод класса: Uploading http:// file with php function file_get_contents
	public function phpFileGetContents($href){
		//input		(string) href
		//output	(string) html string
		// $microFunctionsDb->phpFileGetContents($href);


		//Получаем файл с помощью php file_get_contents()
			$output = file_get_contents($href);
				//print_r(' href: '.$href.' output: '.$output);

		//Определяем кодировку файла
			$charsetArray 			= mb_list_encodings();	
			$mb_detect_encoding 	= mb_detect_encoding($output, $charsetArray, true);
		
		//Определяем исходящую кодировку
			$outCharset				= 'UTF-8';
		
		//Выдираем из файла то, что следует после 'charset='
			$outputCharset = iconv($mb_detect_encoding, $outCharset, $output);
		//$outputCharset = mb_convert_encoding ( $output, $outCharset, $mb_detect_encoding );
		
		function mb_convert_encoding_custom($string, $outCharset, $inCharset) {
			if ($mb_detect_encoding == NULL) {
				$string 			= mb_convert_encoding($string, $outCharset);
				return $string;
			} 
			else {
				$string 			= mb_convert_encoding($string, $outCharset, $inCharset);
				return $string;
			}
		}	

		preg_match('/(charset="|charset=)([\S]*)("|;|\s)/imuxU', $outputCharset, $charsetMatch);
		$charsetMatch = str_replace('charset=','',$charsetMatch);
		$charsetMatch = str_replace('"','',$charsetMatch);
		$charsetMatch = str_replace(';','',$charsetMatch);
		$charsetMatch = str_replace(' ','',$charsetMatch);
		
		
		if ($charsetMatch[0]	!=	"UTF-8") {	
			//Конвертируем файл из кодировки обозначенной после 'charset=' в кодировку "UTF-8"
				$output = mb_convert_encoding_custom($output, $mb_detect_encoding, $inCharset);		
				// Также работает код ниже. Мнения программистов расходятся, что применять
				//$output = iconv($charsetMatch[0], "UTF-8", $output);

			//Меняем с помощью регулярного выражения то, что идет после 'charset=' на UTF-8
			$regExp =   "/".'charset=([\s\S]*)("|\s|;)'."/"."imuxU"; 
			$newSubStr = 'charset=UTF-8$2';	
			$output = preg_replace($regExp, $newSubStr, $output);
		}
		
		//Подставляем domen к link вида href="/abc/..."
		$output				= preg_replace('/(href=")\/([^\/][\S]*")/imxU', 		"$1$linkAdd/$2", 	$output); 
		//Подставляем domen к link вида href="abc/..."
		$output				= preg_replace('/(href=")([^:\/\/][\S]*")/imxU', 		"$1$linkAdd/$2", 	$output);
		$output				= preg_replace("/(href=')\/([^\/][\S]*')/imxU", 		"$1$linkAdd/$2",	$output);
		$output				= preg_replace("/(href=')([^:\/\/][\S]*')/imxU", 		"$1$linkAdd/$2", 	$output);

		$output				= preg_replace('/(src=")\/([^\/][\S]*")/imxU', 			"$1$linkAdd/$2", 	$output);
		$output				= preg_replace('/(src=")([^:\/\/][\S]*")/imxU', 		"$1$linkAdd/$2", 	$output);
		$output				= preg_replace("/(src=')\/([^\/][\S]*')/imxU", 			"$1$linkAdd/$2", 	$output);
		$output				= preg_replace("/(src=')([^:\/\/][\S]*')/imxU", 		"$1$linkAdd/$2", 	$output);

		$output				= preg_replace('/(background=")\/([^\/][\S]*")/imxU', 	"$1$linkAdd/$2", 	$output);
		$output				= preg_replace('/(background=")([^:\/\/][\S]*")/imxU', 	"$1$linkAdd/$2", 	$output);
		$output				= preg_replace("/(background=')\/([^\/][\S]*')/imxU", 	"$1$linkAdd/$2", 	$output);
		$output				= preg_replace("/(background=')([^:\/\/][\S]*')/imxU", 	"$1$linkAdd/$2", 	$output);	
		
		//Удаляем двойной http:// в link
		$output				= preg_replace("/(http:\/\/)([^=]*)(http:\/\/)/imxU", "$3", 				$output);
		$output				= preg_replace("/(https:\/\/)([^=]*)(https:\/\/)/imxU", "$3", 				$output);
		
		$output				= preg_replace("/(\/\/\/)/imxU", 					"/", 					$output);
		
		$output				= preg_replace('/(href\(")(\/[\S]*)("\))/imxU', 			"$1$linkAdd$2$3", 	$output);
		$output				= preg_replace("/(href\(')(\/[\S]*)('\))/imxU", 			"$1$linkAdd$2$3", 	$output);
		
		
		// Перекодируем & в "секретный код"
		$output 			= str_replace('&+','treiyreih8974y897989bhvkfsdp974983jophijojoghg',$output);

		//print_r(' href: '.$href.' output: '.$output);
		//echo "charsetMatch: ".$charsetMatch[0]."<br><br>"."mb_detect_encoding: ".$mb_detect_encoding."<br><br>".$output;
		//var_dump($charset);

		return $output;
	}	
	
	
	//Метод класса: Uploading http:// file with php function file_get_contents
	public function file_get_contents_utf8($fn) {
		$content = file_get_contents($fn);
		return mb_convert_encoding($content, 'UTF-8',
		mb_detect_encoding($content, 'UTF-8, CP1252, ASCII, ISO-8859-1', true));
	}	
	
	
	//Class method: creating and making setting for the artificial neuro network
	public function fannCreateAdjust($annParam){
		
		//Derive from fileNameData numInputData and numOutputData
		$string	=	$this->file_get_contents_utf8($annParam['dirData'].$annParam['fileNameData']);
		$string	=	preg_replace('/^([\s\S]*)([\n])([\s\S]*)$/ixuU', '$1', $string);
		$annParam['numInputData']	=	(int) preg_replace('/^([\d]*)(\s)([\d]*)(\s)([\d]*)$/ixuU', '$3', $string);
		$annParam['numOutputData']	=	(int) preg_replace('/^([\d]*)(\s)([\d]*)(\s)([\d]*)$/ixuU', '$5', $string);
		//print_r($annParam);
		
		$ann =	fann_create_standard(	$annParam['numLayers'], 		$annParam['numInputData'], 
										$annParam['numNeuronsHidden'],	$annParam['numOutputData']);
	
		if ($ann) {
			fann_set_activation_function_hidden	($ann, 	$annParam['activationFunctionHidden']);
			fann_set_activation_function_output	($ann, 	$annParam['activationFunctionOutput']);
			fann_set_activation_steepness_hidden($ann,	$annParam['activationSteepnessHidden']);
			fann_set_activation_steepness_output($ann,	$annParam['activationSteepnessOutput']);
			fann_set_learning_rate				($ann, 	$annParam['learningRate']);
			fann_set_learning_momentum			($ann,	$annParam['learningMomentum']);
			fann_set_sarprop_temperature		($ann,	$annParam['sarpropTemperature']);
		/*	*/
		}

		return $ann;
	}	

	
	
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	#       Abstract protected functions						        #
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #	
	
	//Class method: language train detection
	abstract protected function langDetectionTrainA01($ann, $rowSample, $dirName, $annParam);
		/*	input	(array)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->langDetectionTrainA01($rowSample, $dirName, $annParam);	*/	

	//Class method: language train detection
	abstract protected function langDetectionTrainA03($ann, $rowSample, $dirName, $annParam);
		/*	input	(array)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->langDetectionTrainA03($rowSample, $dirName);	*/	
			
	//Class method: language run detection
	abstract protected function langDetectionRunA01($string, $dirName, $langSelectArray, $rowNum, $trainReportArray, $annParam);
		/*	input	(string)  
			output	(string)
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->langDetectionRun($string, $dirName, $langSelectArray, $rowNum, $trainReportArray);	*/
		
}  

 
class microFunctionsAnn extends Ann {

	// Инициируем класс для работы с БД (as default)
	public function __construct () {
	
	}	
	
	//Class method: PATTERN
	public function aaaBbbbCcc(){
		/*	input		(string, array) nothing  
			output	(string, array) nothing, except
			$microFunctionsXU	= new microFunctionsXU;
			$var = $microFunctionsXU->aaaBbbbCcc();		*/


		/* Инициируем класс для работы с БД
		$opts	= array('db' => 'u53393_arbirru' );
		$db		= new SafeMySQL($opts); // with some of the default settings overwritten  */

		// Построение SELECT SQL-оператора с placeholders
		$table	=	'table';
		$strSQL =	'SELECT		field 
					 FROM 		?n
					 WHERE 		field = ?s';
		// ?s ("string") ?i ("integer") ?n ("name" table and field names) ?a ("array") ?u ("update") ?p ("parsed") - special type placeholder, for inserting already parsed statements without any processing, to avoid double parsing.
					
		// SQL-оператор выполняется	
		$row 	=	$this->db->getRow( $strSQL, $table, '' );  //$db->getAll   $db->getRow( $strSQL, $table, '' );

		// Построение INSERT-UPDATE SQL-оператора с placeholders
		$insertUpdateArray['field_1']			= '';
		$insertUpdateArray['field_2']			= '';
				
		$table									= 'table';
		$sql  = "INSERT INTO ?n SET ?u ON DUPLICATE KEY UPDATE ?u";
		// SQL-оператор выполняется	
		$this->db->query($sql,					$table,  
												$insertUpdateArray,
												$insertUpdateArray);
												//$db->query
		return;
	}

	
	//Class method: converting ini txt file into bunch data.data files for ANN
	public function ppppGetBulkDataFile($annParam){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->ppppGetBulkDataFile($annParam);	*/

		//Delete all files in data directory
		$this->deleteFileDir($annParam['dirData']);
			
		$reportBulkDataFile		=	'';
		
		//Getting cutted by 'dateFinishDTT' array from file with our standard
			//Goal is to run the cycle to process each date
			$annParam['dataArrayGeneral'] 		=	$this->fileTitlesDates2Array($annParam, '', '');
			//print_r($annParam['dataArrayGeneral']); return;

		foreach($annParam['dataArrayGeneral'] as $key0 => $str0){


			//Define temporary top date to which we cut array on top end
			$annParam['dateTop']		=	$annParam['dataArrayGeneral'][$key0]['date'];		
		
			//Define temporary date on which we cut array on bottom end in date format
			//See more http://stackoverflow.com/questions/7651263/subtract-1-day-with-php	
				$depthDataDay			=	((int)$annParam['depthData'])*365;
			if(!empty($annParam['depthData']) AND $depthDataDay > 10){
				//print_r($depthDataDay.' 1<br />');
				$annParam['dateBottom']	=	date('Y-m-d', strtotime($annParam['dateTop']."-$depthDataDay days")); 
			}
			else{
				//print_r($depthDataDay.' 2<br />');
				$depthDataDay			=	(int)100*365; //One century
				$annParam['dateBottom']	=	date('Y-m-d', strtotime($annParam['dateTop']."-$depthDataDay days"));
			
			}
		
	
			if(	$annParam['dateTop'] >= $annParam['dateStartDTT'] AND
				$annParam['dateTop'] <= $annParam['dateFinishDTT']){
				
				//Getting cutted by 'dateFinishDTT' array from file with our standard				
				$annParam['dataArray'] 		=	$this->fileTitlesDates2Array($annParam);
					//unset($annParam['dataArrayLimitByDepth'][$key0]['in']);
					//unset($annParam['dataArrayLimitByDepth'][$key0]['out']);
					
					/*
					print_r($depthDataDay.'<br />'); 
					print_r($annParam['dateTop'].'<br />');
					print_r($annParam['dateBottom'].'<br />');
					if($annParam['dateTop'] > $annParam['dateBottom']){ print_r('Да'.'<br />');}
					if($annParam['dateTop'] < $annParam['dateBottom']){ print_r('Странно'.'<br />');}
					if(	!($annParam['dateTop'] < $annParam['dateBottom']) AND 
						!($annParam['dateTop'] > $annParam['dateBottom']))
					{print_r('Думай'.'<br />');}
					print_r($annParam['dataArray']); 
					return;
					*/

				$annParam['fileNameData']	=	'data-'.$annParam['dateTop'].'.data';
				$annParam['fileNameTest']	=	'test-'.$annParam['dateTop'].'.data';
				
				$annLog						=	$this->ppppGetDataTestFile($annParam);
				
				$reportBulkDataFile			.=	'data- / test- '.$annParam['dateTop'].'.data'.'<br />';
				
			}
		}
			
		$annLog['reportBulkDataFile']			=	$reportBulkDataFile;
		
		return $annLog;
	}


	//Unused. Class method: bulk train data.data file to get trained ANN
	public function ppppBulkTrainData01($ann, $annParam){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->ppppTrainData01($ann, $annParam);	*/

		/*
				
		$annLog 						=	$this->ppppTrainData01($ann, $annParam);
	
		$annLog['reportBulkTrainFile']	=	$annParam['fileNameAnn'].'&nbsp;&nbsp;&nbsp;'.$annLog['reportTrainFile'];
		*/
		
		return $annLog;			
	}
	
		
	//Class method: converting ini txt file into data.data file for ANN
	public function ppppGetDataTestFile($annParam){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->ppppGetDataTestFile($annParam);	*/
		
		//print_r('Start ppppGetDataTestFile: ');
		//print_r($annParam['dataArray']); return;
				
		//Delete data files: data.data	& test.data
		if(is_readable	($annParam['dirData'].$annParam['fileNameData']) )
		{	unlink		($annParam['dirData'].$annParam['fileNameData']);}
		if(is_readable	($annParam['dirData'].$annParam['fileNameTest']) )
		{	unlink		($annParam['dirData'].$annParam['fileNameTest']);}		
		
		
		//Set first line for data file
			//http://leenissen.dk/fann/html/files2/gettingstarted-txt.html
			//The first line consists of three numbers:
			//The first is the number of training pairs in the file, 
				$annParam['numTrainPair']		=	count($annParam['dataArray']) -1; //Now it is defined as defauls, later it will be updated
			//the second is the number of inputs and 
				$annParam['numInputData']		=	count($annParam['dataArray'][0]['in']);
			//the third is the number of outputs.
				$annParam['numOutputData']		=	count($annParam['dataArray'][0]['out']);
			//The rest of the file is the actual training data, consisting of one line with inputs, one with outputs etc.

		//Enriching or update array with normalization data
			//Should be after $annParam['numInputData'] is defined
			$annParam['dataArray'] = $this->normalizationVertical($annParam['dataArray'], $annParam);
			//print_r($annParam['dataArray']);			
			
		//Create data files (data.data	& test.data) and set first line
			//http://leenissen.dk/fann/html/files2/gettingstarted-txt.html
			//The first line consists of three numbers:
			//The first is the number of training pairs in the file,
			//the second is the number of inputs and
			//the third is the number of outputs.
			//The rest of the file is the actual training data, consisting of one line with inputs, one with outputs etc.
		$firstLine	=	array(	0 	=>	$annParam['numTrainPair'], 
								1	=>	$annParam['numInputData'],
								2	=>	$annParam['numOutputData']);		
		$this->arrayWriteString($annParam['dirData'], $annParam['fileNameData'], $firstLine, '');
		
		//Write the main data rows
		foreach($annParam['dataArray'] as $key0 => $str0){
			
			//Not write an input row if output row is absent
			//but write it in separate file for testing
			$field	=	'valueNorm'; //!!!'value';  'valueNorm';
				//First, check if the test file has created
			if(is_readable	($annParam['dirData'].$annParam['fileNameTest'])){ continue;}
				//Second, check if the date more than 'dateFinishDTT' than create test file and move on
			else if(
				empty($annParam['dataArray'][$key0]['out']) OR 
				$annParam['dataArray'][$key0]['date'] > $annParam['dateFinishDTT']){	
				$this->arrayWriteString($annParam['dirData'], 
										$annParam['fileNameTest'], $annParam['dataArray'][$key0]['in'], $field);
				continue;
			}
						
			//Limit file creating by dateFinishDTT and by depthData ($annParam['depthData'] -> $depthDataDay)
			if( $annParam['dataArray'][$key0]['date']	>	$annParam['dateFinishDTT']
			){continue;}			

			//Write down input data
				$field	=	'valueNorm'; //!!!'value';  'valueNorm';
				$this->arrayWriteString($annParam['dirData'], $annParam['fileNameData'], $annParam['dataArray'][$key0]['in'], $field);
			//Write down output data
				$field	=	'value';
				//print_r($annParam['dataArray'][$key0]['out']);
				$this->arrayWriteString($annParam['dirData'], $annParam['fileNameData'], $annParam['dataArray'][$key0]['out'], $field);
		}

		//Log data meta out
		$annLog['dataFileLineCount']	=	$this->getNumLineFile($annParam['dirData'],$annParam['fileNameData']);
		$annLog['dataFileNumData']		=	$annLog['dataFileLineCount'] - 2;	
		$annLog['dataFileNumTrainPair']	=	$annLog['dataFileNumData']/2;
		$annLog['firstLine']			=	$firstLine[0].' '.$firstLine[1].' '.$firstLine[2];
		
		$keyLast						=	count($annParam['dataArray']);
		
		//Log data to check by absolute values
		$annLog['dataStartAbs']			=	$annParam['dataArray'][0]['date'].' '.			$annParam['dataArray'][0]['in'][0]['value'];
		$annLog['dataInOutEndAbs']		=	$annParam['dataArray'][$keyLast-2]['date'].' '.	$annParam['dataArray'][$keyLast-2]['in'][0]['value'];
		$annLog['dataTestAbs']			=	$annParam['dataArray'][$keyLast-1]['date'].' '.	$annParam['dataArray'][$keyLast-1]['in'][0]['value'];

		//Log data to check by normalized values		
		$annLog['dataStartNorm']		=	$annParam['dataArray'][0]['date'].' '.			round($annParam['dataArray'][0]['in'][0]['valueNorm'],6);
		$annLog['dataInOutEndNorm']		=	$annParam['dataArray'][$keyLast-2]['date'].' '.	round($annParam['dataArray'][$keyLast-2]['in'][0]['valueNorm'],6);
		$annLog['dataTestNorm']			=	$annParam['dataArray'][$keyLast-1]['date'].' '.	round($annParam['dataArray'][$keyLast-1]['in'][0]['valueNorm'],6);

		
		$annLog['reportDataTestFile']		=
			'<b>CountLines:</b> '.$annLog['dataFileLineCount'].'<br />'.
			'<b>CountRowsWithData:</b> '.$annLog['dataFileNumData'].'<br />'.
			'<b>CountDataPairs:</b> '.$annLog['dataFileNumTrainPair'].'<br />'.
			'<b>FirstLine:</b> '.$annLog['firstLine'].'<br />'.
			'<br />'.
			'<b>Data Start Abs</b>`: '.$annLog['dataStartAbs'].'<br />'.
			'<b>Data End Abs:</b> '.$annLog['dataInOutEndAbs'].'<br />'.
			'<b>Data Test Abs:</b> '.$annLog['dataTestAbs'].'<br />'.
			'<br />'.
			'<b>Data Start Norm</b>`: '.$annLog['dataStartNorm'].'<br />'.
			'<b>Data End Norm:</b> '.$annLog['dataInOutEndNorm'].'<br />'.
			'<b>Data Test Norm:</b> '.$annLog['dataTestNorm'].'<br />'.
			': '.''.'<br />'.
			'';
			
		
		//print_r($firstLine);
		//print_r($annParam['dataArray']);
		
		//print_r($langSelectArray);
	
		
		return $annLog;
	}


	//Class method: train data.data file to get trained ANN
	public function ppppTrainData01($ann, $annParam){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->ppppTrainData01($ann, $annParam);	*/
				
		if ($ann) {
		
			
			$annParam['fullFileNameData'] = $annParam['dirData'].$annParam['fileNameData'];	//dirname(__FILE__)	
			
			if(is_readable($annParam['fullFileNameData'])){
				$train_data	=	fann_read_train_from_file($annParam['fullFileNameData']);
				/* See more http://leenissen.dk/fann/html/files/fann_train-h.html#fann_read_train_from_file
				The file must be formatted like
					num_train_data num_input num_output
					inputdata seperated by space
					outputdata seperated by space */
				
				//echo '<br>File '.$annParam['fullFileNameData'].' is readable<br>'.'<br>';
					//sleep(3);
					//var_dump($train_data);	//Reply into Network: resource(29) of type (FANN Train Data)
			}
			else{
				echo '<br>File '.$annParam['fullFileNameData'].' is UNreadable<br>'.'<br>';
			}

		
			/*
			 * Задаем параметры обучения
			 * $annParam['numLayers']		-	это количество промежуточных слоев.
			 * $annParam['numNeuronsHidden']	-	это количество нейронов в промежуточном слое. Здесь нужно экспериментальным путем подбирать это число.
			 * $annParam['numInput']			-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
			 * $annParam['numOutput']		-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
			 * */	
			
			//print_r($annParam);
			
			$fannGetMseArr	=	array();	
			
			for($iter = 0; $iter < $annParam['maxEpoch']; $iter++){
				
				$fannResetMse				=	fann_reset_MSE($ann);
				
				$fannTrainOnData			=	fann_train_on_data($ann, $train_data,	
					1, $annParam['epochsBetweenReports'], $annParam['desiredError']);
				
					$fannGetMseArr[$iter]	=	(float) fann_test_data($ann, $train_data); //fann_get_MSE($ann);
				if(	$fannGetMseArr[$iter]	<	$annParam['acceptedError'] AND $iter >= $annParam['minEpoch']){ break;}
			}

			//Form name of a addSave file
			//print_r();
			$addDate						=	preg_replace('/^([^\d]*)([\d]{4,4}-[\d]{2,2}-[\d]{2,2})([^\d]*)$/imxuU', '$2', $annParam['fileNameData']);
												//preg_replace('/^([^\d]*?)([\d]*?)([^\d]*?)$/imxuU', '$2', $annParam['fileNameData']);
			//print_r();
			if(empty($annParam['cycle'])){$annParam['cycle']	=	0;}
			$annParam['cycle']				=	$this->nameFilledZeroNumDigits($annParam['cycle'], 3);				
				
			$annLog['epoch']				=	$iter;
			
			$annLog['mse']					=	fann_test_data($ann, $train_data);
			$annLog['mse']					=	(float) $annLog['mse'];
				//print_r($annLog['mse'].' ');
			$annLog['mse']					=	round($annLog['mse']*100000,0);
				//print_r($annLog['mse'].' ');
			$annLog['mse']					=	$this->nameFilledZeroNumDigits($annLog['mse'], 4);
				
			$annParam['dateTeach']			=	date('Y-m-d&H-i-s');
			$annParam['fileNameAnn']		=	'ann-'.$addDate.'-'.
												'c'.$annParam['cycle'].'-'.
												'e'.$annLog['epoch'].'-'.
												'm'.$annLog['mse'].'-'.
												'#'.$annParam['dateTeach'].'.data';
			
			$result	=	fann_save($ann, $annParam['dirAnn'].$annParam['fileNameAnn']);
			
			//var_dump($trainReportArray);
			fann_destroy($ann);
		}			
		
			$annLog['reportBulkTrainFile']	=	$annParam['fileNameAnn'];
			
		//print_r($fannGetMseArr);
		//print_r($trainReportArray);
		
		return $annLog;	

	}


	//Class method: run test with trained ANN to get a prediction
	public function ppppRunTest($annParam){
		/*	input	(string, array, nothing)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->ppppRunTest($ann, $annParam);	*/
			
		// Загружаем модель из файла. Эту модель мы создали на предыдущем шаге.
		$ann 					= fann_create_from_file($annParam['dirAnn'].$annParam['fileNameAnn']);

			//var_dump($ann);

			//echo $string;	
		$arrayInput				=	$this->file2Array($annParam['dirData'].$annParam['fileNameTest']);;

		$output 				=	fann_run($ann, $arrayInput);
			//print_r($output);
	
		//$report['date']			=	$this->restoreDateHyphen($annParam['tempDate']);
		
		$report['test']			=	$output;
		
		$report['testRound'][0]	=	round(	$output[0]*100,0);
		$report['testRound'][1]	=	round(	$output[1]*100,0);
		$report['testRound'][2]	=	round(	$output[2]*100,0);
		$report['testRound'][3]	=	round(	$output[3]*100,0);
		$report['testRound'][4]	=	round(	$output[4]*100,0);
		
		$report['testIntpr']	=	$this->testItemInterptetation01($report['test']);
		
		//print_r($report);

		return $report;
	}
	

	
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	#       Functions for language detection					        #
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #	
	
	
	//Class method: preparing language train dataset, Approach 01
	public function langDetectionDataA01($rowSample, $dirName, $langSelectArray, $annParam){
		/*	input	(array)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->langDetectionDataA01($langSelectArray);	*/			
			
		//print_r($langSelectArray);
		
		foreach($rowSample as $key0 => $str){
			
			//Unsed. Set names of language files
			$langArray	=	array(	0 => 'de', 1 => 'en', 2 => 'es', 3 => 'fr', 
									4 => 'it', 5 => 'pl', 6 => 'pt', 7 => 'ru');
						
			if(is_readable	($dirName.'data-'.$key0.'.data') )
				{	unlink	($dirName.'data-'.$key0.'.data'); }
		
			//print_r($langArray);
			//print_r($langSelectArray);
			//'de''en''es''fr''it''pl''pt''ru'
			//echo $rowSample[$key0].' ';
			
			//Count language patterns and form the outIni array variable	
			$i	=	0;	$n	=	0;
			foreach($langSelectArray as $key1 => $str1){
				
				$filename	=	'/var/www/ann.userto.com/AnnFann/LangDetect/'.'rowSample-'.$rowSample[$key0].'/'.
								$langSelectArray[$key1]->langNameS .'.txt';

				//echo '00: '.$filename.'<br />';
				
				if(!is_readable($filename)){	continue; }


				//echo '01: '.$filename.'<br />';
				
				if( $langSelectArray[$key1]->selected != 1 OR $langSelectArray[$key1]->selected != '1' ){	continue;	}
				$outIni[$i]	=	0;
				$i			+=	1;
				$n			+=	1;
			}
			
			$annParam['numOutput']	=	$n;	
			
			//Set first line for data file
				//http://leenissen.dk/fann/html/files2/gettingstarted-txt.html
				//The first line consists of three numbers:
				//The first is the number of training pairs in the file, 
				//the second is the number of inputs and 
				//the third is the number of outputs.
				//The rest of the file is the actual training data, consisting of one line with inputs, one with outputs etc.
			$firstLine	=	array(0  => $annParam['numOutput'], 1 => 256, 2 => $annParam['numOutput']);
			//print_r($firstLine);
			
			$filename	=	'data-'.$key0.'.data';
			$this->arrayWriteString($dirName, $filename, $firstLine, '');
			
			
			//print_r($outIni);
			
			$i	=	0;
			
			//Form data.data file
			foreach($langSelectArray as $key1 => $str1){
			
				$out	=	$outIni;
				//print_r($out);
				
				$filename	=	'/var/www/ann.userto.com/AnnFann/LangDetect/rowSample-'.$rowSample[$key0].'/'. 
								$langSelectArray[$key1]->langNameS .'.txt';
								
				if(!is_readable($filename) ){	continue; }
				
				if( $langSelectArray[$key1]->selected != 1 OR $langSelectArray[$key1]->selected != '1' ){	
					//print_r($langSelectArray[$key1]);
					continue;	}
				
				//echo '<br />'.$filename.'<br />';
				
				$txt	=	$this->file_get_contents_utf8($filename);
				
				//echo substr($txt, 0, 128).'<br />';
				
				$inp	=	$this->generateFrequencies($txt);	// Inputs	
				if($annParam['normalizYN'] == 'Y'){ $inp	=	$this->normalizationHorisontal($inp, $annParam); }
							
							$filename	=	'data-'.$key0.'.data';
							$this->arrayWriteString($dirName, $filename, $inp, '');
							
				$out[$i]	=	1;											// Outputs
				
							$filename	=	'data-'.$key0.'.data';
							$this->arrayWriteString($dirName, $filename, $out, '');
							//echo ' inp: '.count($inp).'  out: '.count($out);				
				
				$i		+=	1;
				sleep(0.3);
			}
			sleep(0);
		}
		
		return $annParam;
	}

	
	//Class method: language ANN training, Approach 01 fixed train
	public function langDetectionTrainA01($ann, $rowSample, $dirName, $annParam){
		/*	input	(array)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->langDetectionTrainA01($ann, $rowSample, $dirName, $annParam);	*/

		/*
		 * Задаем параметры сети.
		 * $annParam['numLayers']		-	это количество промежуточных слоев.
		 * $annParam['numNeuronsHidden']	-	это количество нейронов в промежуточном слое. Здесь нужно экспериментальным путем подбирать это число.
		 * $annParam['numInput']			-	это количество выходящих сигналов. В случае определения языка - равно 256 - это количество входов, оно должно равняться количеству знаков ANSII.
		 * $annParam['numOutput']		-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
		 * */
	
		if ($ann) {
		
			foreach($rowSample as $key0 => $str0){
			
				$filename = $dirName.'data-'.$key0.'.data';	//dirname(__FILE__)	

				if(is_readable	($dirName.'/fann-'.$key0.'.txt') )
					{	unlink	($dirName.'/fann-'.$key0.'.txt'); }
			

				
				if(is_readable($filename)){
					$train_data	=	fann_read_train_from_file($filename);
					/* See more http://leenissen.dk/fann/html/files/fann_train-h.html#fann_read_train_from_file
					The file must be formatted like
						num_train_data num_input num_output
						inputdata seperated by space
						outputdata seperated by space */
					
					//echo '<br>File '.$filename.' is readable<br>'.'<br>';
						//var_dump(($train_data));	//Reply into Network: resource(29) of type (FANN Train Data)
				}
				else{
					echo '<br>File '.$filename.' is UNreadable<br>'.'<br>';
				}

			
				/*
				 * Задаем параметры обучения
				 * $annParam['numLayers']		-	это количество промежуточных слоев.
				 * $annParam['numNeuronsHidden']	-	это количество нейронов в промежуточном слое. Здесь нужно экспериментальным путем подбирать это число.
				 * $annParam['numInput']			-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
				 * $annParam['numOutput']		-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
				 * */	
				
				
				
				$fannGetMseArr	=	array();	
				
				for($iter = 0; $iter <= $annParam['maxEpoch']; $iter++){
					
					$fannResetMse			=	fann_reset_MSE($ann);
					
					$fannTrainOnData		=	fann_train_on_data($ann, $train_data,	
						1, $annParam['epochsBetweenReports'], $annParam['desiredError']);
					
					$fannGetMseArr[$iter]	=	fann_get_MSE($ann);
					if($fannGetMseArr[$iter] <  $annParam['acceptedError'] AND $iter >= $annParam['minEpoch']){ break;}
				}
		/*	*/						
				
				//print_r($fannTrainOnData);
				
				/* Workable prior version	
				if (fann_train_on_data($ann, $train_data,	
						$annParam['maxEpoch'], $annParam['epochsBetweenReports'], $annParam['desiredError'])){
						//echo 'You are at the step 3 of train.php  '.dirname(__FILE__).'/fannSave.txt'.'<br />'.'<br />';
						//echo '<span style="color: green;">You are good at the step 5 of train.php  result: '.$result.'</span><br />'.'<br />';

				}
				else{
					echo "<br><span style='color: red'>Something wrong</span>";
				}
				*/
				
				$result	=	fann_save($ann, $dirName.'/fann-'.$key0.'.txt');
			}
			
			$trainReportArray['epoch']	=	$iter;
			$trainReportArray['mse']	=	fann_test_data($ann, $train_data);
			//var_dump($trainReportArray);
										fann_destroy($ann);
		}			
		
		//print_r($fannGetMseArr);
		return $trainReportArray;
	}


	//Class method: language ANN training, Approach 03 cascadetrain
	public function langDetectionTrainA03($ann, $rowSample, $dirName, $annParam){
		/*	input	(array)  
			output	(nothing) except a file
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->langDetectionTrainA01($ann, $rowSample, $dirName, $annParam);	*/

		/*
		 * Задаем параметры сети.
		 * $annParam['numLayers']		-	это количество промежуточных слоев.
		 * $annParam['numNeuronsHidden']	-	это количество нейронов в промежуточном слое. Здесь нужно экспериментальным путем подбирать это число.
		 * $annParam['numInput']			-	это количество выходящих сигналов. В случае определения языка - равно 256 - это количество входов, оно должно равняться количеству знаков ANSII.
		 * $annParam['numOutput']		-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
		 * */
	
		if ($ann) {
			
			foreach($rowSample as $key0 => $str0){
			
				$filename = $dirName.'data-'.$key0.'.data';	//dirname(__FILE__)	

				if(is_readable	($dirName.'/fann-'.$key0.'.txt') )
					{	unlink	($dirName.'/fann-'.$key0.'.txt'); }
			

				
				if(is_readable($filename)){
					$train_data	=	fann_read_train_from_file($filename);
					//echo '<br>File '.$filename.' is readable<br>'.'<br>';
						//var_dump(($train_data));	
				}
				else{
					echo '<br>File '.$filename.' is UNreadable<br>'.'<br>';
				}

			
				/*
				 * Задаем параметры обучения
				 * $annParam['numLayers']		-	это количество промежуточных слоев.
				 * $annParam['numNeuronsHidden']	-	это количество нейронов в промежуточном слое. Здесь нужно экспериментальным путем подбирать это число.
				 * $annParam['numInput']			-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
				 * $annParam['numOutput']		-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
				 * */	
				
				
				
				$fannGetMseArr	=	array();	
				
				for($iter = 0; $iter <= $annParam['maxEpoch']; $iter++){
					
					$fannResetMse			=	fann_reset_MSE($ann);
					
					$fannTrainOnData		=	fann_cascadetrain_on_data($ann, $train_data,	
						128, $annParam['epochsBetweenReports'], $annParam['acceptedError']);
					
					$fannGetMseArr[$iter]	=	fann_get_MSE($ann);
					if($fannGetMseArr[$iter] <  $annParam['acceptedError'] AND $iter >= $annParam['minEpoch']){ break;}
				}
		/*	*/						
				
				//print_r($fannTrainOnData);
				
				/* Workable prior version	
				if (fann_train_on_data($ann, $train_data,	
						$annParam['maxEpoch'], $annParam['epochsBetweenReports'], $annParam['desiredError'])){
						//echo 'You are at the step 3 of train.php  '.dirname(__FILE__).'/fannSave.txt'.'<br />'.'<br />';
						//echo '<span style="color: green;">You are good at the step 5 of train.php  result: '.$result.'</span><br />'.'<br />';

				}
				else{
					echo "<br><span style='color: red'>Something wrong</span>";
				}
				*/
				
				$result	=	fann_save($ann, $dirName.'/fann-'.$key0.'.txt');
			}
			
			$trainReportArray['epoch']	=	$iter;
			$trainReportArray['mse']	=	fann_test_data($ann, $train_data);
			//var_dump($trainReportArray);
										fann_destroy($ann);
		}			
		
		//print_r($fannGetMseArr);
		return $trainReportArray;
	}

	
	//Class method: language detection, Approach 01
	public function langDetectionRunA01($string, $dirName, $langSelectArray, $rowNum, $trainReportArray, $annParam){
		/*	input	(string)  
			output	(string)
			$microFunctionsAnn	= new microFunctionsAnn();
			$var = $microFunctionsAnn->langDetectionRunA01($string, $dirName, $langSelectArray, $rowNum, $trainReportArray);	*/

		// Загружаем модель из файла. Эту модель мы создали на предыдущем шаге.
		$ann = fann_create_from_file($dirName.'/fann-'.$rowNum.'.txt');

		//echo 'langRunDetection: '.$string.'<br />';
		//print_r($langSelectArray);
		/* Ниже я в нашу сеть передаю текст на разных языках
		 * Смотрим результат
		 */
			//echo $string;	
		$arrayInput	=	$this->generateFrequencies($string);
			//print_r($arrayInput);
		if($annParam['normalizYN'] == 'Y'){ $arrayInput	=	$this->normalizationHorisontal($arrayInput, $annParam); }
		$output =	fann_run($ann, $arrayInput);

			//print_r($output);
	
		//Формируем JSON строку
		$string		= '';
		$string		= '[';
		
		//for ($key0=0; $key0<=100; $key0++) {		

		$key1	= 0;
		foreach($langSelectArray as $key0 => $str){
			
				$string .= '{';
				$string .= '"langName":"'.	$langSelectArray[$key0]->langName	.'",';	//
				$string .= '"langNameS":"'.	$langSelectArray[$key0]->langNameS	.'",';	//
				$string .= '"selected":"'.	$langSelectArray[$key0]->selected	.'",';	//
				$string .= '"checked":"'.	$langSelectArray[$key0]->checked	.'",';	//
			if( $langSelectArray[$key0]->selected != 1 OR $langSelectArray[$key0]->selected != '1' ){	
				
				$string .= '"relNum":"'.	'--'	.'",';
				$string .= '"mse":"'.		'--'	.'",';
				$string .= '"mse":"'.		'--'	.'"';				//	
				//$key1	-=	1;	
					//print_r($langSelectArray[$key0]);
			}
			else{
				$string .= '"relNum":"'.	round(	$output[$key1]*100,1)		.'",';	//
				$string .= '"epoch":"'.				$trainReportArray['epoch']		.'",';
				$string .= '"mse":"'.		round(	$trainReportArray['mse']*100,3)	.'"';
				$key1	+=	1;
			}
				$string .= '},';

		}
			/*	That does not work now
				$string	.= '{';
				$string .= '"msetrainReportArray":"'.	round($trainReportArray*100,1)	.'"';	
				$string	.= '}';
			*/
		$string	    .= ']';		
		$string		 = preg_replace("/^([\s\S]*)(,\])$/imxuU", "$1]", $string);

		return $string;

		/*
			'<div class="row">'.
					'<div class="col-md-4 col-sm-4 col-xs-6"				>'.
						'<div class="checkbox marginTopBottom0em">'.
							'<label><input type="checkbox" value="" ng-model="langDetect.selectDeuch" 	>German</label>'.
						'</div>'.
					'</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-6 text-left"	>'.round($output[0]*100,1).'%</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-0"></div>'.
			'</div>'.
			'<div class="row">'.
					'<div class="col-md-4 col-sm-4 col-xs-6"				>'.
						'<div class="checkbox marginTopBottom0em">'.
							'<label><input type="checkbox" value="" ng-model="langDetect.selectDeuch" 	>English</label>'.
						'</div>'.
					'</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-6 text-left"	>'.round($output[1]*100,1).'%</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-0"></div>'.
			'</div>'.		
			'<div class="row">'.
					'<div class="col-md-4 col-sm-4 col-xs-6"				>'.
						'<div class="checkbox marginTopBottom0em">'.
							'<label><input type="checkbox" value="" ng-model="langDetect.selectDeuch" 	>Espanol</label>'.
						'</div>'.
					'</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-6 text-left"	>'.round($output[2]*100,1).'%</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-0"></div>'.
			'</div>'.		
			'<div class="row">'.
					'<div class="col-md-4 col-sm-4 col-xs-6"				>'.
						'<div class="checkbox marginTopBottom0em">'.
							'<label><input type="checkbox" value="" ng-model="langDetect.selectDeuch" 	>French</label>'.
						'</div>'.
					'</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-6 text-left"	>'.round($output[3]*100,1).'%</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-0"></div>'.
			'</div>'.		
			'<div class="row">'.
					'<div class="col-md-4 col-sm-4 col-xs-6"				>'.
						'<div class="checkbox marginTopBottom0em">'.
							'<label><input type="checkbox" value="" ng-model="langDetect.selectDeuch" 	>Italian</label>'.
						'</div>'.
					'</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-6 text-left"	>'.round($output[4]*100,1).'%</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-0"></div>'.
			'</div>'.		
			'<div class="row">'.
					'<div class="col-md-4 col-sm-4 col-xs-6"				>'.
						'<div class="checkbox marginTopBottom0em">'.
							'<label><input type="checkbox" value="" ng-model="langDetect.selectDeuch" 	>Polish</label>'.
						'</div>'.
					'</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-6 text-left"	>'.round($output[5]*100,1).'%</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-0"></div>'.
			'</div>'.		
			'<div class="row">'.
					'<div class="col-md-4 col-sm-4 col-xs-6"				>'.
						'<div class="checkbox marginTopBottom0em">'.
							'<label><input type="checkbox" value="" ng-model="langDetect.selectDeuch" 	>Portuguese</label>'.
						'</div>'.
					'</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-6 text-left"	>'.round($output[6]*100,1).'%</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-0"></div>'.
			'</div>'.
			'<div class="row">'.
					'<div class="col-md-4 col-sm-4 col-xs-6"				>'.
						'<div class="checkbox marginTopBottom0em">'.
							'<label><input type="checkbox" value="" ng-model="langDetect.selectDeuch" 	>Russian</label>'.
						'</div>'.
					'</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-6 text-left"	>'.round($output[7]*100,1).'%</div>'.
					'<div class="col-md-4 col-sm-4 col-xs-0"></div>'.
			'</div>';			
		*/
		
	}

	


	
}

?>