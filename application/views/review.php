<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>AL414 Review</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{

		}
	</script>
</head>
<body>
	<h1>Review your work, 
		<?php 
		$current_user = $this->session->userdata('current_user');
		echo $current_user['name'];
		?>, and change your answers if you like:</h1>

	<form action='/controllers/checkpoint' method='post'>
		<table>
			<?php 
			
			foreach(array_reverse($defaults) as $default => $value)
			{

				// echo $value['picture_id'].'<br>'.
				// 	 $value['default_descr'].'<br>'.
				// 	 $value['typing'].'<br>'.
				// 	 $value['vote'].'<br>';
				echo"
				<tr>
					<td><img class='small' src='/assets/img/01-".$value['id'].".jpg'>
					</td>
					<td class='responsereview'><p><input type='radio' name='vote".$value['id']."' value='1'> ".$value['default_descr']."<br>
						<input type='radio' name='vote".$value['id']."' value='2'> ".$value['typing']."<br>
						<input type='radio' name='vote".$value['id']."' value='3'> They are equivalent</p>
					</td>
				</tr>
					";
			}
			?>
			<td></td>
			<td><input class='submitter' type='submit' name='save' value='Save'></td>
		</table>
	</form>

<!-- TWO HARD-CODED ROWS TO REFER TO IN BUILDING THE FOREACH LOOP: -->
	<!-- <form action='/controllers/prefsave' method='post'>
		<table>
			<tr>
				<td><img class='small' src="/assets/img/01-1.jpg">
				</td>
				<td class='responsereview'><p><input type='radio' name='vote-01-01' value='1'> (echo Our answer, four five six seven eight nine ten eleven twelve thirteen fourteen fifteen)<br>
					<input type='radio' name='vote-01-01' value='2'> (echo User's answer, four five six seven eight nine ten eleven twelve thirteen fourteen fifteen)<br>
					<input type='radio' name='vote-01-01' value='3'> They are equivalent</p>
				</td>
			</tr>
			<tr>
				<td><img class='small' src="/assets/img/01-2.jpg">
				</td>
				<td class='responsereview'><p><input type='radio' name='vote-01-02' value='1'> (echo Our answer, four five six seven eight nine ten eleven twelve thirteen fourteen fifteen)<br>
					<input type='radio' name='vote-01-02' value='2'> (echo User's answer, four five six seven eight nine ten eleven twelve thirteen fourteen fifteen)<br>
					<input type='radio' name='vote-01-02' value='3'> They are equivalent</p>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input class='submitter' type='submit' name='save' value='Save'></td>
			</tr>
		</table>
 	</form>  -->
<!-- END HARD-CODED REF EXAMPLES - - - - - - - - - - - - - - - - -  -->


</body>
</html>