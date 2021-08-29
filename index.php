<?php include_once 'sendemail.php'; ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>PHP Contact Form with Google reCAPTCHA V2 by CodeAT21</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Stylesheet file -->
<link rel="stylesheet" href="css/style.css">

<!-- Google recaptcha API library -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div class="contact__form">
	<div class="container">
		<div class="wrapper">
			<div class="form__inner">
				<form action="" method="post" class="form">
					<h3>Contact Us</h3>
					<!-- Status message -->
					<?php if(!empty($statusMsg)){ ?>
						<div class="status__msg <?php echo $status; ?>"><?php echo $statusMsg; ?></div>
					<?php } ?>
					
					<!-- Form fields -->
					<div class="form__input">
						<label for="name">Name</label>
						<input type="text" name="name" placeholder="Enter your name" value="<?php echo !empty($postData['name'])?$postData['name']:''; ?>" required>
					</div>
					<div class="form__input">
						<label for="email">Email</label>
						<input type="email" name="email" placeholder="Enter your email" value="<?php echo !empty($postData['email'])?$postData['email']:''; ?>" required>
					</div>
					<div class="form__input">
						<label for="subject">Subject</label>
						<input type="text" name="subject" placeholder="Enter subject" value="<?php echo !empty($postData['subject'])?$postData['subject']:''; ?>" required>
					</div>
					<div class="form__input">
						<label for="message">Message</label>
						<textarea name="message" placeholder="Type your message here" required><?php echo !empty($postData['message'])?$postData['message']:''; ?></textarea>
					</div>
					<div class="form__input">
						<!-- Google reCAPTCHA box -->
						<div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
					</div>
					<input type="submit" name="submit" class="btn" value="Submit">
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>