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

	<?php 
		// echo "dollar-defaults:";
		// var_dump($defaults);
		// echo "dollar-userinputs:";
		// var_dump($userinputs);
	 ?>

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
				?>
				<tr>
					<td><img class='small' src='/assets/img/01-<?=$value['id']?>.jpg'></td>

						<input type='hidden' name='picture_id_<?=$value['id']?>' value='<?=$value['id']?>'>
					<td class='responsereview'>
						<p>
						<input type='radio' id='<?=$value['id']?>_1' name='vote_<?=$value['id']?>' value='1' 
							<?php if ($value['vote']==1) 
								{
									echo 'checked="checked"';
								} 
							?>
						>
						 
							<label for='<?=$value['id']?>_1'><?=$value['default_descr']?></label><br>
						<input type='radio' id='<?=$value['id']?>_2' name='vote_<?=$value['id']?>' value='2'
							<?php if ($value['vote']==2) 
								{
									echo 'checked="checked"';
								} 
							?>
						>
							<label for='<?=$value['id']?>_2'><?=$value['typing']?></label><br>
						<input type='radio' id='<?=$value['id']?>_3' name='vote_<?=$value['id']?>' value='3' 
							<?php if ($value['vote']==3) 
								{
									echo 'checked="checked"';
								} 
							?>
						>
							<label for='<?=$value['id']?>_3'>They are equivalent</label>
						</p>
					</td>
				</tr>
			<?php
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


<!-- ANOTHER HARD-CODED ROW, BETTER THIS TIME, FROM THE LOOP THAT POSTS PICTURE ID PROPERLY: -->
		<!--     <tr>
					<td><img class='small' src='/assets/img/01-".$value['id']?>.jpg'></td>
					<input type='hidden' name='picture_id_".$value['id']?>' value='".$value['id']?>'>
					<td class='responsereview'><p>
						<?php 

						 ?>
						<input type='radio' id='1' name='".$value['id']?>' value='1' selected>
						
							<label for='1'> ".$value['default_descr']?></label><br>

						<input type='radio' id='2' name='".$value['id']?>' value='2'>
							<label for='2'> ".$value['typing']?></label><br>
						<input type='radio' id='3' name='".$value['id']?>' value='3'>
							<label for='3'> They are equivalent</label></p>
					</td>
				</tr> -->
<!-- END HARD-CODED ROW -->


</body>
</html>