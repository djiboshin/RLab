//Set setup values
$('#setup-values').submit(function(){
	$.post(
		'lab.php',
		 $("#setup-values").serialize(),         
		function(msg) {
			$('#setup-values').show('slow');
			$('#history').prepend(msg);
		}
	);
	return false;
});

//Get setup values
$('#get-setup-values').submit(function(){
	$.post(
		'lab.php',
		 $("#get-setup-values").serialize(),         
		function(msg) {
			$('#history').prepend(msg);
		}
	);
	return false;
});

//Submit form for OUTPUT channel 1 after submit button GET VALUES
$('#generator-output-ch1-values').submit(function(){
	var checkbox = document.getElementById("gen-output-ch1");
	checkbox.disabled = true;
	$.post(
		'lab.php',
		 $("#generator-output-ch1-values").serialize(),         
		function(msg) {
			var checkbox = document.getElementById("gen-output-ch1");
			checkbox.disabled = false;
			//$('#generator-output-ch1-values').show('slow');
			$('#history').prepend(msg);
		}
	);
	return false;
});

//Submit form for OUTPUT channel 2 after submit button GET VALUES
$('#generator-output-ch2-values').submit(function(){
	var checkbox = document.getElementById("gen-output-ch2");
	checkbox.disabled = true;
	$.post(
		'lab.php',
		 $("#generator-output-ch2-values").serialize(),         
		
		function(msg) {
			var checkbox = document.getElementById("gen-output-ch2");
			checkbox.disabled = false;
			//$('#generator-output-ch2-values').show('slow');
			$('#history').prepend(msg);
		}
	);
	return false;
});

//Submit form after checkbox for OUTPUT CHANNEL 1 was changed
$('#gen-output-ch1').on('change', function(){
	$.post(
		'lab.php',
		 $("#generator-output-ch1").serialize(),         
		
		function(msg) {
			//$('#generator-output-ch1').show('slow');
			$('#history').prepend(msg);
			const string = msg;
			const substring = "200";
			const substringon = "ON";
			const substringoff = "OFF";
			const substringch1 = "CHANNEL 1";
			if ((string.includes(substring) == true) && (string.includes(substringon) == true) && (string.includes(substringch1) == true)) {
				var submitbutton = document.getElementById("submit-generator-output-ch1");
				submitbutton.disabled = false;
			}
			else if ((string.includes(substring) == true) && (string.includes(substringoff) == true) && (string.includes(substringch1) == true)) {
				var submitbutton = document.getElementById("submit-generator-output-ch1");
				submitbutton.disabled = true;

			}
		}
	);
	return false;
});

//Submit form after checkbox for OUTPUT CHANNEL 2 was changed
$('#gen-output-ch2').on('change', function(){
	$.post(
		'lab.php',
		 $("#generator-output-ch2").serialize(),         
		
		function(msg) {
			//$('#generator-output-ch2').show('slow');
			$('#history').prepend(msg);
			const string = msg;
			const substring = "200";
			const substringon = "ON";
			const substringoff = "OFF";
			const substringch2 = "CHANNEL 2";
			if ((string.includes(substring) == true) && (string.includes(substringon) == true) && (string.includes(substringch2) == true)) {
				var submitbutton = document.getElementById("submit-generator-output-ch2");
				submitbutton.disabled = false;
			}
			else if ((string.includes(substring) == true) && (string.includes(substringoff) == true) && (string.includes(substringch2) == true)) {
				var submitbutton = document.getElementById("submit-generator-output-ch2");
				submitbutton.disabled = true;
			}
		}
	);
	return false;
});


//Submit form after checkbox for INPUT CHANNEL 1 was changed
$('#osciloscope-input-ch1').on('change', function(){
	$.post(
		'lab.php',
		 $("#osciloscope-input-ch1").serialize(),         
		
		function(msg) {
			//$('#generator-output-ch1').show('slow');
			$('#history').prepend(msg);
			const string = msg;
			const substring = "200";
			const substringon = "ON";
			const substringoff = "OFF";
			const substringch1 = "CHANNEL 1";
			if ((string.includes(substring) == true) && (string.includes(substringon) == true) && (string.includes(substringch1) == true)) {
				var submitbutton = document.getElementById("submit-osciloscope-input-ch1");
				submitbutton.disabled = false;
			}
			else if ((string.includes(substring) == true) && (string.includes(substringoff) == true) && (string.includes(substringch1) == true)) {
				var submitbutton = document.getElementById("submit-osciloscope-input-ch1");
				submitbutton.disabled = true;

			}
		}
	);
	return false;
});

//Submit form after checkbox for INPUT CHANNEL 2 was changed
$('#osciloscope-input-ch2').on('change', function(){
	$.post(
		'lab.php',
		 $("#osciloscope-input-ch2").serialize(),         
		
		function(msg) {
			//$('#generator-output-ch1').show('slow');
			$('#history').prepend(msg);
			const string = msg;
			const substring = "200";
			const substringon = "ON";
			const substringoff = "OFF";
			const substringch1 = "CHANNEL 2";
			if ((string.includes(substring) == true) && (string.includes(substringon) == true) && (string.includes(substringch1) == true)) {
				var submitbutton = document.getElementById("submit-osciloscope-input-ch2");
				submitbutton.disabled = false;
			}
			else if ((string.includes(substring) == true) && (string.includes(substringoff) == true) && (string.includes(substringch1) == true)) {
				var submitbutton = document.getElementById("submit-osciloscope-input-ch2");
				submitbutton.disabled = true;

			}
		}
	);
	return false;
});

//Submit form for INPUT channel 1 after submit button
$('#osciloscope-input-ch1-values').submit(function(){
	var submitbutton = document.getElementById("submit-osciloscope-input-ch1");
	submitbutton.disabled = true;
	var checkbox = document.getElementById("osc-input-ch1");
	checkbox.disabled = true;
	$.post(
		'lab.php',
		 $("#osciloscope-input-ch1-values").serialize(),
		function(msg) {
			var checkbox = document.getElementById("osc-input-ch1");
			checkbox.disabled = false;
			const string = msg;
			const substring = "200";
			if (string.includes(substring) == true) {
				var submitbutton = document.getElementById("submit-osciloscope-input-ch1");
				submitbutton.disabled = false;
			}
			var result = JSON.parse(msg);
			$('#osciloscope-input-ch1-vpp').text(result.vpp);
			$('#osciloscope-input-ch1-vamp').text(result.vamp);
			$('#osciloscope-input-ch1-freq').text(result.freq);
		}
	);
	return false;
});

//Submit form for INPUT channel 2 after submit button
$('#osciloscope-input-ch2-values').submit(function(){
	var submitbutton = document.getElementById("submit-osciloscope-input-ch2");
	submitbutton.disabled = true;
	var checkbox = document.getElementById("osc-input-ch2");
	checkbox.disabled = true;
	$.post(
		'lab.php',
		 $("#osciloscope-input-ch2-values").serialize(),         
		function(msg) {
			var checkbox = document.getElementById("osc-input-ch2");
			checkbox.disabled = false;
			const string = msg;
			const substring = "200";
			if (string.includes(substring) == true) {
				var submitbutton = document.getElementById("submit-osciloscope-input-ch2");
				submitbutton.disabled = false;
			}
			var result = JSON.parse(msg);
			$('#osciloscope-input-ch2-vpp').text(result.vpp);
			$('#osciloscope-input-ch2-vamp').text(result.vamp);
			$('#osciloscope-input-ch2-freq').text(result.freq);
		}
	);
	return false;
});


//Submit form for Oscilloscope autoset after submit button
$('#osciloscope-autoset').submit(function(){
	$.post(
		'lab.php',
		 $("#osciloscope-autoset").serialize(),         
		
		function(msg) {
			$('#history').prepend(msg);
		}
	);
	return false;
});

//Submit form for Oscilloscope screenshot after submit button
$('#osciloscope-get-screenshot').submit(function(){
	$.post(
		'lab.php',
		 $("#osciloscope-get-screenshot").serialize(),         
		
		function(msg) {
			var result = JSON.parse(msg);
			$('#osciloscope-screenshot').html(result.screenshot_url);
			$('#history').prepend($("<div class='history-item'></div>").text(result.status_code));
		}
	);
	return false;
});

//Submit form for Device values after submit button
$('#device-values').submit(function(){
	$.post(
		'lab.php',
		 $("#device-values").serialize(),         
		
		function(msg) {
			$('#history').prepend(msg);
		}
	);
	return false;
});