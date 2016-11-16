<?php


//**********************************************************
// Шаг   Фабрика загрузки внешних классов
//**********************************************************	
	$factoryRequire 	= array();
	$factoryRequire[0] 	= 'ann';
	
	foreach($factoryRequire as $key0 => $str){
		require_once ( '/var/www/ann.userto.com/Includes/'.$factoryRequire[$key0].'.class.php' );
	}

//**********************************************************
// Шаг   Creating new objects of a classes
//**********************************************************
	
	$microFunctionsAnn	=	new microFunctionsAnn();

	echo 'You are at the start of data2file.php'.'<br />'.'<br />';
	//var_dump('Check var_dump work');
	//print_r('Check print_r work');

//**********************************************************
// Шаг   Delete the ald xor.data file
//**********************************************************
		
	unlink("data.data");
	//print_r($GLOBALS);


echo <<<END
<!DOCTYPE html>
<html>
<head>
		<title></title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
END;
	
//**********************************************************
// Шаг   Begins
//**********************************************************
	
	//Set names of language files
	$langArray	=	array(	0 => 'de', 1 => 'en', 2 => 'es', 3 => 'fr', 
							4 => 'it', 5 => 'pl', 6 => 'pt', 7 => 'ru');
	
	//'de''en''es''fr''it''pl''pt''ru'

	
	
	//Count language patterns and form the outIni array variable	
	$i	=	0;
	foreach($langArray as $key0 => $str0){
		
		$filename	=	$langArray[$key0].".txt";
		if(!is_readable($filename) ){	continue; }
	
		//echo $filename.'<br />';
	
		$outIni[$i]	=	0;
		$i			+=	1;
	}
	
	$GLOBALS['numOutput']	=	count($outIni);	
	
	//Set first line for data file
	$firstLine	=	array(0  => $GLOBALS['numOutput'], 1 => 256, 2 => $GLOBALS['numOutput']);
	$microFunctionsAnn->stringWriteFromArray($firstLine);
	
	
	//print_r($outIni);
	
	$i	=	0;
	
	//Form data.data file
	foreach($langArray as $key0 => $str0){
	
		$out	=	$outIni;
		
		$filename	=	$langArray[$key0].".txt";
		if(!is_readable($filename) ){	continue; }
		
		echo '<br />'.'<br />'.$filename.'<br />';
		
		$txt	=	$microFunctionsAnn->file_get_contents_utf8($filename);
		
		echo substr($txt, 0, 128).'<br />';
		
		$inp	=	$microFunctionsAnn->generateFrequencies($txt);	// Inputs	
		if($GLOBALS['normalizYN'] == 'Y'){ $inp	=	$microFunctionsAnn->normalization($inp, $GLOBALS); }
					$microFunctionsAnn->stringWriteFromArray($inp);
		$out[$i]	=	1;											// Outputs
					$microFunctionsAnn->stringWriteFromArray($out);
					echo ' inp: '.count($inp).'  out: '.count($out);				
		
		$i		+=	1;
		sleep(0.5);
	}
	
				
echo <<<END
</body>
</html>	
END;


?>