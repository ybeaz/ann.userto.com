<?php
$num_input = 2;
$num_output = 1;
$num_layers = 3;
$num_neurons_hidden = 3;
$desired_error = 0.001;
$max_epochs = 500000;
$epochs_between_reports = 1000;
//echo "Hello World 0";

if (function_exists('fann_create_standard')) {
    //echo "<br>fann_create_standard functions are available.<br />\n";
} else {
    //echo "<br>fann_create_standard functions are not available.<br />\n";
}

$ann = fann_create_standard($num_layers, $num_input, $num_neurons_hidden, $num_output);
//echo "<br>Hello World 1";

if ($ann) {
    fann_set_activation_function_hidden($ann, FANN_SIGMOID_SYMMETRIC);
    fann_set_activation_function_output($ann, FANN_SIGMOID_SYMMETRIC);

    $filename = dirname(__FILE__) . "/xor.data";
echo '<br>'.dirname(__FILE__).'<br>'.'<br>'.$filename;
//print_r($ann);

    if (fann_train_on_file($ann, $filename, $max_epochs, $epochs_between_reports, $desired_error)){
        print_r($ann);
		fann_save($ann, dirname(__FILE__) . "/xor_float.net");
		echo "<br>Seems something happened:  ". dirname(__FILE__)."/xor_float.net";
		//print_r($ann);
	}
	else{
		echo "<br>Something wrong";
	}

    fann_destroy($ann);
}
?>