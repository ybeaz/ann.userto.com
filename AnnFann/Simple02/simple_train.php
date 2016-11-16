<?php


$max_epochs = 1000;
$epochs_between_reports = 1000;
$desired_error = 0.001;
//echo "Hello World 0";

if (function_exists('fann_create_standard')) {
    //echo "<br>fann_create_standard functions are available.<br />\n";
} else {
    //echo "<br>fann_create_standard functions are not available.<br />\n";
}


	$num_layers = 3;
	$num_input = 9;
	$num_neurons_hidden = 81;
	$num_output = 3;	
	
		echo 'You are at the step 1 of train.php'.'<br />'.'<br />';	
	$ann =	fann_create_standard($num_layers, $num_input, $num_neurons_hidden, $num_output);
		echo 'You are at the step 2 of train.php'.'<br />'.'<br />';

	

if ($ann) {
    fann_set_activation_function_hidden($ann, FANN_SIGMOID_SYMMETRIC);
    fann_set_activation_function_output($ann, FANN_SIGMOID_SYMMETRIC);

    $filename = dirname(__FILE__) . "/data.data";
echo '<br>'.dirname(__FILE__).'<br>'.'<br>'.$filename;
//print_r($filename);

    if (fann_train_on_file($ann, $filename, $max_epochs, $epochs_between_reports, $desired_error)){
        //print_r($ann);
		fann_save($ann, dirname(__FILE__) . "/classify.txt");
		echo "<br>Seems something happened:  ". dirname(__FILE__)."/classify.txt";
		//print_r($ann);
	}
	else{
		echo "<br>Something wrong";
	}

    fann_destroy($ann);
}
?>