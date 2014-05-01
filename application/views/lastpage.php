<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>AL414 Checkpoint</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{

		}
	</script>
</head>
<body>
	<div class='container'>
		<h1>Good work, <?php echo $this->session->userdata('current_user')['name']; ?></h1>
		<h3>What would you like to do next?</h3>
		<ul id='checkpoint'>
			<a href="/controllers/logout"><li>Advance to the next level</li></a>
			<a href="/controllers/logout"><li>Do more on this level</li></a>
			<a href="/controllers/logout"><li>Log out</li></a>
		</ul>
	</div>


</body>
</html>