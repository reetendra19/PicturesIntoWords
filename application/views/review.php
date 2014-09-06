<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Pictures Into Words</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>

	<h1>Review your work, 
		<?php 
		$current_user = $this->session->userdata('current_user');
		echo $current_user['name'];
		?>, and change your answers if you like:</h1>

	<form id='updatevote' action='/controllers/checkpoint' method='post'>
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

</body>
</html>