<?php
/*echo '< pre>';
print_r($_POST);
echo '< /pre>';
*/

if ($_SERVER['HTTP_HOST'] == "study.physics.itmo.ru") {

function current_date() {
	date_default_timezone_set('Europe/Moscow');
	$current_date = date('Y-m-d H:i:s');
	return $current_date;
}

function hash_generate() {
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$result = substr(str_shuffle($permitted_chars), 0, 10);
	return $result;
}

function curl_initialize($ch) {
	//$encoded = "Zm5BR2IzNDU6VE80Z3ZONTY=";
	//$authheader = sprintf('Authorization: Basic %s', $encoded );
	$headers=array( 
		'Content-Type: application/x-www-form-urlencoded',
		'Authorization: Basic Zm5BR2IzNDU6VE80Z3ZONTY=',
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLINFO_HEADER_OUT, false);
}

function get_osciloscope_autoset() {
	$ch = curl_init('https://172.16.27.33:1880/test_oscilloscope?autoset');
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>Autoset response code is " . $json[autoset] . "</span></div>";
	curl_close($ch);
}

function get_osciloscope_image() {
	
	
	//Update image on the server side
	$ch = curl_init('https://172.16.27.33:1880/test_oscilloscope?screenshot');
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	//Return updated image from the server
	return download_osciloscope_screenshot();
	curl_close($ch);
}

function download_osciloscope_screenshot() {
	
	//unlink('/var/www/html/dev5physicsifmoru/web/lab/images/oscilloscope-screenshot.png');

	//The resource that we want to download.
	$fileUrl = 'https://172.16.27.33:1880/ui/screenshot.png';
	 
	//The path & filename to save to. YOU SHOULD CHANGE THIS PATH
	$saveTo = '/var/www/html/moodle/oscilloscope-screenshot.png';
	 
	//Open file handler.
	$fp = fopen($saveTo, 'w+');
	 
	//If $fp is FALSE, something went wrong.
	if($fp === false){
		throw new Exception('Could not open: ' . $saveTo);
	}
	 
	//Create a cURL handle.
	$ch = curl_init($fileUrl);
	curl_initialize($ch);
	//Pass our file handle to cURL.
	curl_setopt($ch, CURLOPT_FILE, $fp);
	 
	//Timeout if the file doesn't download after 20 seconds.
	//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	//curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	 
	//Execute the request.
	curl_exec($ch);
	 
	//If there was an error, throw an Exception
	if(curl_errno($ch)){
		throw new Exception(curl_error($ch));
	}
	 
	//Get the HTTP status code.
	$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	 
	//Close the cURL handler.
	curl_close($ch);
	 
	//Close the file handler.
	fclose($fp);
	
	$result_array = array();
	if($statusCode == 200){
		$screenshot = "<img src='images/oscilloscope-screenshot.png?" . hash_generate() .  "' />";
		$result_array[screenshot_url] = $screenshot;
		$result_array[status_code] = current_date() . " - Screenshot updated. Responce code is " . $statusCode;
	} 
	else {
		$screenshot = "";
		$result_array[screenshot_url] = $screenshot;
		$result_array[status_code] = current_date() . " - Screenshot hasn't updated. Responce code is " . $statusCode;
	}
	return json_encode($result_array);
}

function set_gen_output_ch1($channel_num,$channel_status) {
	if ($channel_num == 1 and $channel_status == "ON") {
		$ch = curl_init('https://172.16.27.33:1880/test_generator?C1_output=ON');
	}
	elseif ($channel_num == 1 and $channel_status == "OFF") {
		$ch = curl_init('https://172.16.27.33:1880/test_generator?C1_output=OFF');
	}
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	$returned_channel_code = $json[C1_output];
	if ($returned_channel_code == "200") {
		return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 1 output is " . $channel_status. "</span>
		<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 1 output response code is " . $json[C1_output] . "</span></div></div>";
		
	}
	else {
		return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 1 output is BAD</span></div>
		<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 1 output response code is " . $json[C1_output] . "</span></div></div>";
		
		
	}
	curl_close($ch);
}

function set_gen_output_ch2($channel_num,$channel_status) {
	if ($channel_num == 2 and $channel_status == "ON") {
		$ch = curl_init('https://172.16.27.33:1880/test_generator?C2_output=ON');
	}
	elseif ($channel_num == 2 and $channel_status == "OFF") {
		$ch = curl_init('https://172.16.27.33:1880/test_generator?C2_output=OFF');
	}
	curl_initialize($ch); 
	$json = json_decode(curl_exec($ch),true);
	$returned_channel_code = $json[C2_output];
	if ($returned_channel_code == "200") {
		return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 2 output is " . $channel_status. "</span>
		<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 2 output response code is " . $json[C2_output] . "</span></div></div>";
		
	}
	else {
		return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 2 output is BAD</span></div>
		<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 2 output response code is " . $json[C2_output] . "</span></div></div>";
	}
}

function set_gen_output_ch1_values($generator_ch1_out_v,$generator_ch1_out_freq) {
	$ch = curl_init('https://172.16.27.33:1880/test_generator?C1_vpp=' . $generator_ch1_out_v . '&C1_freq=' . $generator_ch1_out_freq . '&C1_status');
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	curl_close($ch);
	$c1_vpp_status = $json[C1_vpp];
	$c1_freq_status = $json[C1_freq];
	$c1_vpp_value = $json[C1_status][vpp];
	$c1_freq_value = $json[C1_status][freq];
	//return $json;
	return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>VPP status is " . $c1_vpp_status . ", FREQ status is " . $c1_freq_status . "</span>
	<div><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>VPP value is " . $c1_vpp_value . ", FREQ value is " . $c1_freq_value . "</span></div></div>";
}

function set_gen_output_ch2_values($generator_ch2_out_v,$generator_ch2_out_freq) {
	$ch = curl_init('https://172.16.27.33:1880/test_generator?C2_vpp=' . $generator_ch2_out_v . '&C2_freq=' . $generator_ch2_out_freq . '&C2_status');
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	$c2_vpp_status = $json[C2_vpp];
	$c2_freq_status = $json[C2_freq];
	$c2_vpp_value = $json[C2_status][vpp];
	$c2_freq_value = $json[C2_status][freq];
	//return $json;
	return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>VPP status is " . $c2_vpp_status . ", FREQ status is " . $c2_freq_status . "</span>
	<div><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>VPP value is " . $c2_vpp_value . ", FREQ value is " . $c2_freq_value . "</span></div></div>";
	curl_close($ch);
}

//Get generator channel 1 output values
function get_output_ch1_values($channel_num,$channel_status) {
	$result_array = array();
	if ($channel_num == 1 and $channel_status == "ON") {
		$ch = curl_init('https://172.16.27.33:1880/test_generator?C1_status');
	}
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	curl_close($ch);
	$returned_channel_code = $json[C1_status][HTTP];
	$returned_channel_status = $json[C1_status][output];
	if ($returned_channel_code == "200" and $returned_channel_status == "ON") {
		$vpp = $json[C1_status][vpp];
		$freq = $json[C1_status][freq];
		$result_array[vpp] = $vpp;
		$result_array[freq] = $freq;
		$result_array[status] = $returned_channel_code;
		return json_encode($result_array);
	}
	else {
		$vpp = "";
		$freq = "";
		$result_array[vpp] = $vpp;
		$result_array[freq] = $freq;
		return json_encode($result_array);
	}
	
}

//Get generator channel 2 output values
function get_output_ch2_values($channel_num,$channel_status) {
	$result_array = array();
	if ($channel_num == 2 and $channel_status == "ON") {
		$ch = curl_init('https://172.16.27.33:1880/test_generator?C2_status');
	}
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	curl_close($ch);
	$returned_channel_code = $json[C1_status][HTTP];
	$returned_channel_status = $json[C1_status][output];
	if ($returned_channel_code == "200" and $returned_channel_status == "ON") {
		$vpp = $json[C1_status][vpp];
		$freq = $json[C1_status][freq];
		$result_array[vpp] = $vpp;
		$result_array[freq] = $freq;
		$result_array[status] = $returned_channel_code;
		return json_encode($result_array);
	}
	else {
		$vpp = "";
		$freq = "";
		$result_array[vpp] = $vpp;
		$result_array[freq] = $freq;
		return json_encode($result_array);
	}
	
}

//Get oscilloscope channel 1 input values
function get_input_ch1_values($channel_num,$channel_status) {
	$result_array = array();
	if ($channel_num == 1 and $channel_status == "ON") {
		$ch = curl_init('https://172.16.27.33:1880/test_oscilloscope?C1_status');
	}
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	curl_close($ch);
	$returned_channel_code = $json[C1_status][HTTP];
	$returned_channel_status = $json[C1_status][input];
	if ($returned_channel_code == "200" and $returned_channel_status == "ON") {
		$vpp = $json[C1_status][vpp];
		$vamp = $json[C1_status][vamp];
		$freq = $json[C1_status][freq];
		$result_array[vpp] = $vpp;
		$result_array[vamp] = $vamp;
		$result_array[freq] = (string)$freq;
		$result_array[status] = $returned_channel_code;
		return json_encode($result_array);
	}
	else {
		$vpp = "";
		$vamp = "";
		$freq = "";
		$result_array[vpp] = $vpp;
		$result_array[vamp] = $vamp;
		$result_array[freq] = $freq;
		//return $json;
		return json_encode($result_array);
	}
	
}

//Get oscilloscope channel 2 input values
function get_input_ch2_values($channel_num,$channel_status) {
	$result_array = array();
	if ($channel_num == 2 and $channel_status == "ON") {
		$ch = curl_init('https://172.16.27.33:1880/test_oscilloscope?C2_status');
	}
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	curl_close($ch);
	$returned_channel_code = $json[C2_status][HTTP];
	$returned_channel_status = $json[C2_status][input];
	if ($returned_channel_code == "200" and $returned_channel_status == "ON") {
		$vpp = $json[C2_status][vpp];
		$vamp = $json[C2_status][vamp];
		$freq = $json[C2_status][freq];
		$result_array[vpp] = $vpp;
		$result_array[vamp] = $vamp;
		$result_array[freq] = $freq;
		$result_array[status] = $returned_channel_code;
		//return $json;
		return json_encode($result_array);
	}
	else {
		$vpp = "";
		$vamp = "";
		$freq = "";
		$result_array[vpp] = $vpp;
		$result_array[vamp] = $vamp;
		$result_array[freq] = $freq;
		return json_encode($result_array);
	}
	
}

//Get oscilloscope-input values
function get_input_ch1($channel_num,$channel_status) {
	if ($channel_num == 1 and $channel_status == "ON") {
		$ch = curl_init('https://172.16.27.33:1880/test_oscilloscope?C1_input=ON&C1_status');
	}
	elseif ($channel_num == 1 and $channel_status == "OFF") {
		$ch = curl_init('https://172.16.27.33:1880/test_oscilloscope?C1_input=OFF&C1_status');
	}
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	$returned_channel_code = $json[C1_input];
	if ($returned_channel_code == "200") {
		return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 1 input is " . $channel_status. "</span>
		<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 1 input response code is " . $json[C1_input] . "</span></div></div>";
	}
	else {
		return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 1 input is BAD</span></div>
		<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 1 input response code is " . $json[C1_input] . "</span></div></div>";
	}
	curl_close($ch);
}

function get_input_ch2($channel_num,$channel_status) {
	if ($channel_num == 2 and $channel_status == "ON") {
		$ch = curl_init('https://172.16.27.33:1880/test_oscilloscope?C2_input=ON&C2_status');
	}
	elseif ($channel_num == 2 and $channel_status == "OFF") {
		$ch = curl_init('https://172.16.27.33:1880/test_oscilloscope?C2_input=OFF&C2_status');
	}
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
	$returned_channel_code = $json[C2_input];
	if ($returned_channel_code == "200") {
		return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 2 input is " . $channel_status. "</span>
		<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 2 input response code is " . $json[C2_input] . "</span></div></div>";
		
	}
	else {
		return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 2 input is BAD</span></div>
		<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>CHANNEL 2 input response code is " . $json[C2_input] . "</span></div></div>";
	}
	curl_close($ch);
}

//Set setup values
function set_setup_values($set_setup_coordinate_value,$setup_capacity1,$setup_capacity2) {
	$result_array = array();
	$ch = curl_init('https://172.16.27.33:1880/setup?setcoord=' . $set_setup_coordinate_value . '&setcapacity1=' . $setup_capacity1 . '&setcapacity2=' . $setup_capacity2);
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
		$get_coord = $json[setcoord];
		$get_capacity1 = $json[setcapacity1];
		$get_capacity2 = $json[setcapacity2];
		if ($get_coord == "200") {
			$get_coord_status = "OK";
		}
		else {
			$get_coord_status = "ERROR";
		}
		if ($get_capacity1 == "200") {
			$get_capacity1_status = "OK";
		}
		else {
			$get_capacity1_status = "ERROR";
		}
		if ($get_capacity2 == "200") {
			$get_capacity2_status = "OK";
		}
		else {
			$get_capacity2_status = "ERROR";
		}
	return get_setup_values() . "<div class='history-item-setup'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>Coordinate: " . $get_coord_status . ", Capacity1: " . $get_capacity1_status . ", Capacity2: " . $get_capacity2_status . "</span></div>";
}

//Get setup values
function get_setup_values() {
	$result_array = array();
	$ch = curl_init('https://172.16.27.33:1880/setup?status');
	curl_initialize($ch);
	$json = json_decode(curl_exec($ch),true);
		$get_coord = $json[status][getcoord];
		$get_capacity1 = $json[status][getcapacity1];
		$get_capacity2 = $json[status][getcapacity2];
		return "<div class='history-item'><span class='history-item-date'>" . current_date() . " - </span><span class='history-item-data'>Coordinate: " . $get_coord . ", Capacity1: " . $get_capacity1 . ", Capacity2: " . $get_capacity2 . "</span></div>";
}

//Get oscilloscope screenshot
if(($_POST[f]['get-osciloscope-screenshot']) == "ON") {
	echo get_osciloscope_image();
}

//Oscilloscope autoset
if(($_POST[f]['get-osciloscope-autoset']) == "ON") {
	echo get_osciloscope_autoset();
}

//Enable/Disable Gen-output-ch1(2)
if(($_POST[f]['gen-output-ch1']) == "ON") {
	$channel_num = 1;
	$channel_status = "ON";
	echo set_gen_output_ch1($channel_num,$channel_status);
}
elseif(($_POST[f]['gen-output-ch1']) == "OFF") {
	$channel_num = 1;
	$channel_status = "OFF";
	echo set_gen_output_ch1($channel_num,$channel_status);
}

if(($_POST[f]['gen-output-ch2']) == "ON") {
	$channel_num = 2;
	$channel_status = "ON";
	echo set_gen_output_ch2($channel_num,$channel_status);
}
elseif(($_POST[f]['gen-output-ch2']) == "OFF") {
	$channel_num = 2;
	$channel_status = "OFF";
	echo set_gen_output_ch2($channel_num,$channel_status);
}

if((isset($_POST[f]['generator-ch1-out-v'])) and (isset($_POST[f]['generator-ch1-out-freq']))) {
	$generator_ch1_out_v = $_POST[f]['generator-ch1-out-v'];
	$generator_ch1_out_freq = $_POST[f]['generator-ch1-out-freq'];
	echo set_gen_output_ch1_values($generator_ch1_out_v,$generator_ch1_out_freq);
}

if((isset($_POST[f]['generator-ch2-out-v'])) and (isset($_POST[f]['generator-ch2-out-freq']))) {
	$generator_ch2_out_v = $_POST[f]['generator-ch2-out-v'];
	$generator_ch2_out_freq = $_POST[f]['generator-ch2-out-freq'];
	echo set_gen_output_ch2_values($generator_ch2_out_v,$generator_ch2_out_freq);
}

if((isset($_POST[f]['set-setup-coordinate-value'])) || (isset($_POST[f]['setup-capacity1'])) || (isset($_POST[f]['setup-capacity2']))) {
	$set_setup_coordinate_value = $_POST[f]['set-setup-coordinate-value'];
	$setup_capacity1 = $_POST[f]['setup-capacity1'];
	$setup_capacity2 = $_POST[f]['setup-capacity2'];
	echo set_setup_values($set_setup_coordinate_value,$setup_capacity1,$setup_capacity2);
}

if($_POST[f]['get-setup-values'] == "GET-SETUP-VALUES") {
	echo get_setup_values();
}

//Enable/Disable Gen-input-ch1(2)
if(($_POST[f]['osc-input-ch1']) == "ON") {
	$channel_num = 1;
	$channel_status = "ON";
	echo get_input_ch1($channel_num,$channel_status);
}
elseif(($_POST[f]['osc-input-ch1']) == "OFF") {
	$channel_num = 1;
	$channel_status = "OFF";
	echo get_input_ch1($channel_num,$channel_status);
}

if(($_POST[f]['osc-input-ch2']) == "ON") {
	$channel_num = 2;
	$channel_status = "ON";
	echo get_input_ch2($channel_num,$channel_status);
}
elseif(($_POST[f]['osc-input-ch2']) == "OFF") {
	$channel_num = 2;
	$channel_status = "OFF";
	echo get_input_ch2($channel_num,$channel_status);
}

//Get input values
if(($_POST[f]['get-osciloscope-ch1-values-hidden']) == "ON") {
	$channel_num = 1;
	$channel_status = "ON";
	echo get_input_ch1_values($channel_num,$channel_status);
}

if(($_POST[f]['get-osciloscope-ch2-values-hidden']) == "ON") {
	$channel_num = 2;
	$channel_status = "ON";
	echo get_input_ch2_values($channel_num,$channel_status);
}

//print_r($_POST);
}
else {
	echo "Incorrect request";
}
?>
