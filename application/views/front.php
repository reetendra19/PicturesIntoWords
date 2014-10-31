<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Pictures Into Words</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

</head>
<body>
	<div class='container'>
		<h1>Pictures Into Words</h1>
		
	<!--
		<div class='frontpage'>
			<h2>Log in:</h2>
			<form action='/controllers/login' method='post'>
				<table>
					<tbody>
						<tr>
							<td>Email:</td><td><input type='text' name='email'></td>
						</tr>
						<tr>
							<td>Password:</td><td><input type='password' name='password'></td>
						</tr>
					</tbody>
				</table>
				<input class='submitter' type='submit' name='login' value='Log In'>
			</form>
			<div class='red'>
				<?php 
				if($this->session->flashdata('loginerrors'))
				{
					echo $this->session->flashdata('loginerrors');
				}
				?>
			</div>
	-->
			<div>
				<br>
				<br>
				<p style='display:inline; font-size:1.3em'>Explore the PHP site as a guest user: </p>
				<form style='display:inline' action='/controllers/login' method='post'>
					<input type='hidden' name='email' value='guest@guest.com'>
					<input type='hidden' name='password' value='password'>
					<input type='submit' name='login' value='Enter'>
				</form>
			</div>
		</div>

	<!--
		<div class='frontpage'>
			<h2>New to us?  Register here:</h2>
			<form action='/controllers/register' method='post'>
				<table>
					<tbody>
						<tr>
							<td>Name:</td><td><input type='text' name='name'></td>
						</tr>
						<tr>
							<td>Email:</td><td><input type='text' name='email'></td>
						</tr>
						<tr>
							<td>Password:</td><td><input type='password' name='password'></td>
						</tr>
						<tr>
							<td>Confirm Password:</td><td><input type='password' name='Confirm'></td>
						</tr>
					</tbody>
				</table>
				<input class='submitter' type='submit' name='register' value='Register'>
			</form>
			<div class='red'>
				<?php 
					if($this->session->flashdata('regerrors'))
					{
						echo $this->session->flashdata('regerrors');
					}
				?>
			</div>
		</div>
	-->
		
		<div style='padding:20px'>
			<p id='beta-message'>Be a Beta Tester! Try out our new version <span class='glyphicon glyphicon-arrow-right'></span> <a class='btn' style='background:#4775A3; color:white' href='http://afternoon-brook-6624.herokuapp.com/'>Go</a></p>
		</div>
		
	</div>
</body>
</html>