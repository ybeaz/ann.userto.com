<?php


echo 'You are at the start of run.php'.'<br />'.'<br />';
//var_dump('Check var_dump work');
//print_r('Check print_r work');



//**********************************************************
// Шаг   Фабрика загрузки внешних классов
//**********************************************************	
		//http://phpfaq.ru/safemysql
		//https://github.com/colshrapnel/safemysql/blob/master/safemysql.class.php

	$factoryRequire 	= array();
	$factoryRequire[0] 	= 'ann';
	
	foreach($factoryRequire as $key0 => $str){
		require_once ( '/var/www/ann.userto.com/Includes/'.$factoryRequire[$key0].'.class.php' );
	}

//**********************************************************
// Шаг   Creating new objects of a classes
//**********************************************************
	
	$microFunctionsAnn	=	new microFunctionsAnn();

echo 'You are at the step 2 of run.php'.'<br />'.'<br />';

/*
 * Загружаем модель из файла. Эту модель мы создали на предыдущем шаге.
 * */
$ann = fann_create_from_file(dirname(__FILE__)."/classify.txt");


/*
 * Ниже я в нашу сеть передаю 3 текста на разных языках
 * Смотрим результат
 * */
	
$enInp	=	$microFunctionsAnn->generateFrequencies("ANN are slowly adjusted so as to produce the same output as in
            the examples. The hope is that when the ANN is shown a new
            X-ray images containing healthy tissues");

if($GLOBALS['normalizYN'] == 'Y'){ $enInp	=	$microFunctionsAnn->normalization($enInp, $GLOBALS); }

$output =	fann_run($ann, $enInp);
		echo 	'  Deuch: '.round($output[0],4).
				'  English: '.round($output[1],4).
				'  Espanol: '.round($output[2],4).			
				'  French: '.round($output[3],4).
				'  Italian: '.round($output[4],4).
				'  Polish: '.round($output[5],4).
				'  Portuguese: '.round($output[6],4).
				'  Russian: '.round($output[7],4).'<br />';
//print_r($output);


	/*	*/	
$frInp	=	$microFunctionsAnn->generateFrequencies("Voyons, Monsieur, absolument pas, les camions d’aujourd’hui ne se traînent pas, bien au contraire. Il leur arrive même de pousser les voitures. Non, croyez moi, ce qu’il vous faut, c’est un camion !
			 - Vous croyez ? Si vous le dites. Est-ce que je pourrais l’avoir en rouge ?
			 - Bien entendu cher Monsieur,vos désirs sont des ordres, vous l’aurez dans quinze jours clé en main. Et la maison sera heureuse de vous offrir le porte-clé. Si vous payez comptant. Cela va sans dire, ajouta Monsieur Filou.
			 - Ah, si ce ");

if($GLOBALS['normalizYN'] == 'Y'){ $frInp	=	$microFunctionsAnn->normalization($frInp, $GLOBALS); }
	
$output = 	fann_run($ann, $frInp);
		echo 	'  Deuch: '.round($output[0],4).
				'  English: '.round($output[1],4).
				'  Espanol: '.round($output[2],4).			
				'  French: '.round($output[3],4).
				'  Italian: '.round($output[4],4).
				'  Polish: '.round($output[5],4).
				'  Portuguese: '.round($output[6],4).
				'  Russian: '.round($output[7],4).'<br />';
//print_r($output);

	/*	*/	
$plInp	=	$microFunctionsAnn->generateFrequencies("tworząc dzieło literackie, pracuje na języku. To właśnie język stanowi tworzywo, dzięki któremu powstaje tekst. Język literacki ( lub inaczej artystyczny) powstaje poprzez wybór odpowiednich środków i przy wykorzystaniu odpowiednich zabiegów technicznych.
            Kompozycja - jest to układ elementów treściowych i formalnych dzieła dokonanych według określonych zasad konstrukcyjnych.
            Kształtowanie tworzywa dzieła literackiego jest procesem skomplikowanym i przebiegającym na wielu poziomach.
            Składa się na nie:");
if($GLOBALS['normalizYN'] == 'Y'){ $plInp	=	$microFunctionsAnn->normalization($plInp, $GLOBALS); }
$output = 	fann_run($ann, $plInp);

		echo 	'  Deuch: '.round($output[0],4).
				'  English: '.round($output[1],4).
				'  Espanol: '.round($output[2],4).			
				'  French: '.round($output[3],4).
				'  Italian: '.round($output[4],4).
				'  Polish: '.round($output[5],4).
				'  Portuguese: '.round($output[6],4).
				'  Russian: '.round($output[7],4).'<br />';
				//'de''en''es''fr''it''pl''pt''ru'
				//'Deuch''English''Spanish''French''Italian''Polish''Portuguese''Russian'
				//'Deuch''English''Spanish''French''Italian''Polish''Portuguese''Russian'
				
				
?>