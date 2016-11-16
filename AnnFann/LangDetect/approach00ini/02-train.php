<?php

//**********************************************************
// Шаг   Фабрика загрузки внешних классов
//**********************************************************	
		//http://phpfaq.ru/safemysql
		//https://github.com/colshrapnel/safemysql/blob/master/safemysql.class.php

	$factoryRequire 	= array();
	$factoryRequire[0] 	= 'ann';
	
	foreach($factoryRequire as $key0 => $str){
		require_once ( '/var/www/ann.userto.com/Includes/'.$factoryRequire[$key0].'.class.php' );
		//require_once ( '/home/u53393/my.yacontent.com/www/services/Includes/'.$factoryRequire[$key0].'.class.php' );
	}

//**********************************************************
// Шаг   Creating new objects of a classes
//**********************************************************
	
	$microFunctionsAnn	=	new microFunctionsAnn();

	echo 'You are at the start of train.php'.'<br />'.'<br />';
	//var_dump('Check var_dump work');
	//print_r('Check print_r work');

/*
 * Задаем параметры сети.
 * $GLOBALS['numLayers']		-	это количество промежуточных слоев.
 * $GLOBALS['numNeuronsHidden']	-	это количество нейронов в промежуточном слое. Здесь нужно экспериментальным путем подбирать это число.
 * $GLOBALS['numInput']			-	это количество выходящих сигналов. В случае определения языка - равно 256 - это количество входов, оно должно равняться количеству знаков ANSII.
 * $GLOBALS['numOutput']		-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
 * */
  	
		echo 'You are at the step 1 of train.php'.'<br />'.'<br />';	
	$ann =	fann_create_standard($GLOBALS['numLayers'], $GLOBALS['numInput'], $GLOBALS['numNeuronsHidden'], $GLOBALS['numOutput']);
		echo 'You are at the step 2 of train.php'.'<br />'.'<br />';

	
if ($ann) {
    fann_set_activation_function_hidden($ann, FANN_SIGMOID_SYMMETRIC);
    fann_set_activation_function_output($ann, FANN_SIGMOID_SYMMETRIC);

	
    $filename = dirname(__FILE__) . "/data.data";	
	
	if(is_readable($filename)){
		echo '<br>File '.$filename.' is readable<br>'.'<br>';
			//print_r($filename);	
	}
	else{
		echo '<br>File '.$filename.' is UNreadable<br>'.'<br>';
	}


/*
 * Задаем параметры обучения
 * $GLOBALS['numLayers']		-	это количество промежуточных слоев.
 * $GLOBALS['numNeuronsHidden']	-	это количество нейронов в промежуточном слое. Здесь нужно экспериментальным путем подбирать это число.
 * $GLOBALS['numInput']			-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
 * $GLOBALS['numOutput']		-	это количество выходящих сигналов. В случае определения языка - равно количеству определяемых языков.
 * */	
	
    if (fann_train_on_file($ann, $filename, $GLOBALS['maxEpochs'], $GLOBALS['epochsBetweenReports'], $GLOBALS['desiredError'])){
			echo 'You are at the step 3 of train.php  '.dirname(__FILE__).'/classify.txt'.'<br />'.'<br />';
		$result	=	fann_save($ann, dirname(__FILE__).'/classify.txt');
			echo '<span style="color: green;">You are good at the step 5 of train.php  result: '.$result.'</span><br />'.'<br />';

	}
	else{
		echo "<br><span style='color: red'>Something wrong</span>";
	}

	
    fann_destroy($ann);
}

?>