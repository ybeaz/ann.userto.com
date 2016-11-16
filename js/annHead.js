


	
	//Not used. To clean main textArea
	function cleanTextArea(){
		
		var langDetect	=	document.getElementById('langDetect');
			langDetect.innerHTML	=	'';
		var txt			=	document.getElementById('textarea01');
			txt.value	=	'';
			
			return;
	}


	//Not used. To make post request and detect language
	function detectLanguage(){
		
		var optPost		=	'LangDetect';
		var langDetect	=	document.getElementById('langDetect');
			langDetect.innerHTML	=	'';
		var txt			=	document.getElementById('textarea01').value;
		
	    $.ajax({
	        type: 			'POST',
	        url: 			'http://ann.userto.com/php/annGetPost.php',
	        data: {
				optPost:		optPost,
	            txt:			txt
	        },
	        dataType: 'text',
	        success: function(echo){
					langDetect.innerHTML	=	echo;
					//console.info('echo: ',echo);
                }
	    });
		
	}

	




