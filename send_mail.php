<?php

#Cleaning Html,Script Tags and special characters
function postTextClean($text) {
   $text 			= trim(addslashes(htmlspecialchars(strip_tags($_POST[$text]))));
   $search 			= array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü');
   $replace 	    = array('c','c','g','g','i','i','o','o','s','s','u','u');
   $new_text 		= str_replace($search,$replace,$text);
   return $new_text;
}

if (isset($_POST)) {
	// Mail Account
	$mail_to      		= '*************@gmail.com';

	#Let's get the data from the form	
	$contact_name 		= postTextClean('contact_name');
	$contact_email		= postTextClean('contact_email');
	$contact_subject	= postTextClean('contact_subject');
	$contact_message 	= postTextClean('contact_message');

	$message            = "<h2>From</h2>
						   <p>{$contact_email}</p>
						   <h2>Name</h2>
						   <p>{$contact_name}</p>
						   <h2>Subject</h2>
						   <p>{$contact_subject}</p>
						   <h2>Message</h2>
						   <p>{$contact_message}</p>";

	// Content type header to send HTML email
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";

	// Extra Headers
	$headers .= "To:{$contact_name}<{$mail_to}>"."\r\n";
	$headers .= "From:{$contact_email}<{$contact_email}>"."\r\n";

	if (mail($mail_to,$contact_subject, $message,$headers)) {
		echo "<div class='alert alert-success'>Your message has been sent.</div>";
	}else {
		echo "<div class='alert alert-danger'>Your message could not be sent</div>";
		exit();
	}
}

?>
