<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<meta charset="utf-8">
	<title>AL414 Level 1</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.5/angular.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			// var counter = 15

			// $(document).on('keyup', '#entry', function(e)
			// {
			// 	if (e.keyCode == 32)
			// 	{
			// 		counter -= 1;
			// 		$('#count').text(counter);
			// 	}
			// })

			$('#preference').hide();

			$('#entry').submit(function()
			{	
				// console.log($('#typing').val().split(' ').length);
				// if string is less than 15 words
				if ($('#typing').val().split(' ').length > 15)
				{
					alert('Please limit your sentence to 15 words');
				}
				else if (!$('#typing').val())
				{
					alert('Please write something');
				}
				else
				{
					$.post($(this).attr('action'), $(this).serialize(), function(data){
						console.log(data);
						// toggle the div visibility:
						$('#preference').show();
						$('#entry').hide();
						// display user's entry: 
						$('#whattheytyped').text(data.default_descr.typing);
						// display db defaults retrieval:
						$('#defaultanswer').text(data.default_descr.default_descr);
						// clear radio buttons from #preference:
						$("input:radio[name=vote]").prop('checked', false);

						$('#wrds').text('15');


						if(data.complete)
						{
							// on 10th photo, new Next button:
							$('#next').replaceWith("<a style='text-decoration:underline;' href='/controllers/review/'>Next</a>");
						}
					}, 'json')
				}	
				return false;
			})

			$('#comparison').submit(function()
			{
				if (!$('input:radio[name=vote]:checked').val()) 
				{
					alert('Please make a choice')
					return false;
				}
				else
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
					
					$('#entry').focus(function()
						{
							$('#wrds').text("{{15 - wordcount.split(' ').length}}");
						})
				} 
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
			<input class='user_input' id='typing' type='text' name='user_input' spellcheck='true' ng-model='wordcount'>
			<input type='submit' value='Go'>

			<p>You have <span id='wrds'>{{15 - wordcount.split(' ').length}}</span> words left</p>

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