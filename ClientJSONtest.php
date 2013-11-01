<?php
$jsonstr = 
file_get_contents("http://api.worldweatheronline.com/free/v1/weather.ashx?q=moncao,Viana+do+Castelo&format=json&num_of_days=3&key=sattd4uyxvb8h223w2hgrwhw");
//echo($jsonstr);

$json = json_decode($jsonstr);
//var_dump($json);

$curr_location		= $json->data->request[0]->query;
$curr_temp			= $json->data->current_condition[0]->temp_C;
$curr_hum			= $json->data->current_condition[0]->humidity;
$curr_icon			= $json->data->current_condition[0]->weatherIconUrl[0]->value;

$d3_temp = $json->data->weather[2]->tempMaxC;
?>

<html>
	<head>
		
	</head>
	<body>
		<section>
			<h1>local : <?php echo $curr_location; ?></h1>
			<h2>temperatura atual : <?php echo $curr_temp ?></h2>
			<h2>humidade atual : <?php echo $curr_hum."%" ?></h2>
			<h2><img src="<? echo $curr_icon; ?>"/></h2>
			<h2>temp max no dia 3: <?php echo $d3_temp; ?></h2>
		</section>
	</body>
</html>