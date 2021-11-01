<?php
		$file = file_get_contents('emails.txt');
	
		if(empty($file)){
			if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
				file_put_contents('emails.txt',$_POST['email']);
			}
		}else{
			if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){

				$content =file_get_contents('emails.txt');
				$content = explode(',',$content);

				if(in_array($_POST['email'],$content) > 0){
					return;
				}else{
					
					array_push($content,$_POST['email']);
					
					file_put_contents('emails.txt',implode(',',$content));
					echo file_get_contents('emails.txt');


					mail('test@localhost.com', 'the subject', 'test test');
				}	
			}
		}
?>	
