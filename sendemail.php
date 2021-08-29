<?php
// Google reCAPTCHA API key configuration
$siteKey 	= '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
$secretKey 	= '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

// Email configuration
$toEmail = 'admin@example.com';
$fromName = 'Sender Name';
$formEmail = 'sender@example.com';

$postData = $statusMsg = $valErr = '';
$status = 'error';

// If the form is submitted
if(isset($_POST['submit'])){
    // Get the submitted form data
    $postData = $_POST;
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
		
		// Validate reCAPTCHA box
		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){

			// Verify the reCAPTCHA response
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);
			
			// Decode json data
			$responseData = json_decode($verifyResponse);
			
			// If reCAPTCHA response is valid
			if($responseData->success){
				
				$subject = 'New contact request submitted';
				$htmlContent = "
					<h2>Contact Request Details</h2>
					<p><b>Name: </b>".$name."</p>
					<p><b>Email: </b>".$email."</p>
                    <p><b>Subject: </b>".$subject."</p>
					<p><b>Message: </b>".$message."</p>
				";
				
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				$headers .= 'From:'.$fromName.' <'.$formEmail.'>' . "\r\n";
				
				// Send email
				@mail($toEmail, $subject, $htmlContent, $headers);
				
				$status = 'success';
				$statusMsg = 'Thank you! Your contact request has submitted successfully, we will get back to you soon.';
				$postData = '';
			}else{
				$statusMsg = 'Robot verification failed, please try again.';
			}
		}else{
			$statusMsg = 'Please check on the reCAPTCHA box.';
		}
}