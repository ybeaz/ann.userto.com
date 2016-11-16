<?php
//Классы общего и универсального назначения

class securityFunctions{
	//$securityFunctions		= new securityFunctions();


	
	//Static method stringSpecCharEscape
	public static function stringSpecCharEscape($string){
		//input		(string)  
		//output	(string)
		// securityFunctions::stringSqlEscape($string);
		
		//trim позволяет видимо избежать пустых вводимых данных
			$string 	= trim($string);
		//replace \r & \n with <br/>  See also: http://stackoverflow.com/questions/5946114/how-to-replace-r-n-with-br	
			$string		= 	nl2br($string);
		//addslashes экранирует спец. символы, но она не учитывает кодировку БД и возможен обход фильтрации. 
			//$string 	= 	addslashes($string);
		//htmlspecialchars — преобразует спец. символы в html сущности.
			$string		= 	htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false);
		//replace \s with " "
			 $string	=	preg_replace('/(\s)/imxuU', ' ', $string);	 
			 
		return $string;
	}

	
}


class commonFunctions{
	// $commonFunctions		= new commonFunctions();


	
}


?>