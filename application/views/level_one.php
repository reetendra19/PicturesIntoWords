<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>AL414 Level 1</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#preference').hide();

			$('#entry').submit(function()
			{
				$.post($(this).attr('action'), $(this).serialize(), function(data){
					// toggle the div visibility:
					$('#preference').show();
					$('#entry').hide();
					// display user's entry:
					$('#whattheytyped').text(data.typing);
					// display db defaults retrieval:
					$('#defaultanswer').text(data.default_descr.default_descr);
					// clear radio buttons from #preference:
					$("input:radio[name=vote]").prop('checked', false);

					if(data.complete)
					{	
						// on 10th photo, new Next button:
						$('#next').replaceWith("<a style='text-decoration:underline;' href='/controllers/review/'>Next</a>");
					}
				}, 'json')
				return false;
			})

			$('#comparison').submit(function()
			{
				$.post($(this).attr('action'), $(this).serialize(), function(data){
					// advance the picture:
					new_source = "/assets/img/01-"+ data.count +".jpg";
					$('img').attr('src', new_source);
					// toggle div visibility back:
					$('#preference').hide();
					$('#entry').show();
					// clear text entry box from #entry:
					$('.user_input').val("");
				}, 'json')
				return false;	 
			})

			$(document).on('click', 'a', function()
			{
				var choice = $("input:radio[name=vote]:checked").val();
				// alert(choice);
				$(this).attr('href', $(this).attr('href') + choice);
			})

		}); 
	</script>
</head>

<body>
	
	<h1>Level One</h1>

	<div class='container'>
	<!-- IMAGE DISPLAY: increments until 10th time -->
		<div class='center'>
			<img src="/assets/img/01-1.jpg">
		</div>

		<!-- ENTRY form visible on page load, switches to hidden after 'Go' button -->
		<form id='entry' class='center' action='/controllers/process_ex1/entry' method='post'>
			<p>Describe what you see in this picture in no more than 15 words, using a complete sentence.</p>
			<input class='user_input' type='text' name='user_input' spellcheck='true'>
			<input type='submit' value='Go'>
		</form>


		<!-- PREFERENCE div hidden at page load, switches to visible after 'Go' button -->
		<div id='preference' class='center'>
			<form id='comparison' action='/controllers/process_ex1/preference' method='post'>
				<p>Which description do you feel is most effective? (Check one)</p>
				<p><input type='radio' id='1' name='vote' value='1'> 
					<label for='1'><span id='defaultanswer'></span></label><br>
				<input type='radio' id='2' name='vote' value='2'> 
					<label for='2'><span id='whattheytyped'></span></label><br>
				<input type='radio' id='3' name='vote' value='3'> 
					<label for='3'>The statements are equivalent</p></label>
				<input id='next' type='submit' value='Next'>
			<!-- 'Next' button above causes page refresh and next incremented photo; after 10th photo, 'Next' button leads to next view -->
			</form>

		</div>
	</div>
</body>
</html>