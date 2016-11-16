<?php
$train_file = (dirname(__FILE__) . "/classify.txt");
if (!is_file($train_file))
    die("The file xor_float.net has not been created! Please run simple_train.php to generate it");

$ann = fann_create_from_file($train_file);
if (!$ann)
    die("ANN could not be created");


$input = array(1, 1);
$input = array(1, -1);
$input = array(-1, -1);
$input = array(-1, 1);

$input = array(0.3, 0.3, 0.34, 0, 0, 0, 0, 0, 0 );
$output = fann_run($ann, $input);
echo '  $output[0]: '.round($output[0],4).'  $output[1]: '.round($output[1],4).'  $output[2]: '.round($output[2],4).'<br />'.'<br />';

$input = array(0, 0, 0, 0.3, 0.3, 0.34, 0, 0, 0 );
$output = fann_run($ann, $input);
echo '  $output[0]: '.round($output[0],4).'  $output[1]: '.round($output[1],4).'  $output[2]: '.round($output[2],4).'<br />'.'<br />';

$input = array(0, 0, 0, 0, 0, 0, 0.3, 0.3, 0.34 );
$output = fann_run($ann, $input);
echo '  $output[0]: '.round($output[0],4).'  $output[1]: '.round($output[1],4).'  $output[2]: '.round($output[2],4).'<br />'.'<br />';


//printf("xor test (%f,%f) -> %f\n", $input[0], $input[1], $calc_out[0], $calc_out[0]);
fann_destroy($ann);
?>