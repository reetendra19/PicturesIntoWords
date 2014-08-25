<!doctype html>
<html>
<head>
	<meta charset='utf-8'>
	<title>Pictures Into Words</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>
<body>
	<?php if($this->session->flashdata('newuser'))
	{
		echo"<script type='text/javascript'>alert('New user registered!');</script>";
	} ?>
	<h3 style='float:right;'>Logged in as 
		<?php 
		$current_user = $this->session->userdata('current_user');
		echo $current_user['name'];
		?>
	</h3>

	<h1>Welcome to <em>Pictures Into Words</em></h1>
	<div class='container' id='instructions'>
		<p>
			The purpose of this activity is to improve your ability to write effective sentences, using a time-tested method:  Writing a sentence that describes a picture, in no more than 15 words.
		</p>

		<p>The activity has two steps:  
			<ol>
				<li>Look at a picture and write a sentence that tells the reader what's going on in the picture.  Remember, it has to be a sentence, not just a list of things that you see.  One way to put yourself in the right frame of mind is to imagine that your sentence will be read by someone who can't see the picture.  Ask yourself how best to make that picture come alive for the reader. </li> 
				<li>Once you've submitted your sentence, a standard sentence will appear.  This is not the "right" answer because there is no single right answer.  But it's a decent description of the picture.  And it's now your job to decide if your description of the picture is more effective than the standard answer.</li>
			</ol>
		</p>
		<p>
			When you've gone through 10 pictures, you'll review your preferences before submitting your final answers. And if you wish, you may choose to submit your work for review and grading by our staff.
		</p>
		<p>
			Are you ready to begin?
		</p>
		<!-- <a href="/controllers/exercise1"><button>Start now</button></a> -->
		<a class='button' href="/controllers/exercise1">Start now</a>
	</div>

</body>
</html>