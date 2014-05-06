<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>AL414</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

</head>
<body>
	<div class='container'>
		<h1>Welcome to AL414</h1>
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
			<div class='red'><?php 
			if($this->session->flashdata('regerrors'))
			{
				echo $this->session->flashdata('regerrors');
			}
		?>
			</div>
		</div>
		
		<div class='frontpage'>
			<h2>Already registered?  Log in:</h2>
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
		</div>
	</div>
</body>
</html>