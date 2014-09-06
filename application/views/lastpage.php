<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Pictures Into Words</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
	<div class='container'>
		<h1>Good work, 
			<?php 
			$current_user = $this->session->userdata('current_user');
			echo $current_user['name'];
			?>
		</h1>
		<h3>Thanks for helping with our site development.</h3>
		<p>Your answers have been collected and will be reviewed to learn about how people are responding to this process. We hope you've enjoyed your experience.</p>
		<h4>What would you like to do next?</h4>
		
		<ul id='checkpoint'>
			<a href="/controllers/introduction"><li>Do it again</li></a>
			<a href="/controllers/logout"><li>Log out</li></a>
		</ul>
		
	</div>


</body>
</html>