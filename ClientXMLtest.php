<?php
$xmlstr = file_get_contents("http://api.worldweatheronline.com/free/v1/weather.ashx?q=Viana+do+Castelo&format=xml&num_of_days=3&key=sattd4uyxvb8h223w2hgrwhw");
//echo($xmlstr);

$xml = new SimpleXMLElement($xmlstr);

$days = array();
for($d=0; $d < 3; $d++) {
 $days[$d]= new Cday($xml->weather[$d]->date, $xml->weather[$d]->tempMaxC, $xml->weather[$d]->tempMinC, $xml->weather[$d]->weatherIconUrl);
}

//var_dump($days);

class Cday {
	public $date;
	public $tmax;
	public $tmin;
	public $icon;
	
	public function __construct($_date, $_tmax,$_tmin,$_icon) {
		$this->date = $_date;
		$this->tmax = $_tmax;
		$this->tmin = $_tmin;
		$this->icon = $_icon;
	}
}

function mostra($days) {
	$xhtml = new SimpleXMLElement("<div/>");
	foreach($days as $day) {
		$lista = $xhtml->addChild("ul");
		$lista->addChild("li",$day->date);
		$lista->addChild("li",$day->tmin);
		$lista->addChild("li",$day->tmax);
		$limg = $lista->addChild("li");
		$img = $limg->addChild("img");
		$img->addAttribute("src",$day->icon);
	}
	return $xhtml->asXML();
	
}
?>

<html>
	<head>
		
	</head>
	<body>
		
	<div>
		<?php echo mostra($days); ?>
	</div>
	</body>
</html>