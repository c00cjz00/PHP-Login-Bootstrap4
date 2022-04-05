<?php
session_start();
/* echo "<pre>";
var_dump($_POST);
echo "</pre>";*/
//if (isset($_POST["copyCart"])){
	if (isset($_POST["mySelected"]) && (trim($_POST["mySelected"])!="")){
		$mySelected=trim($_POST["mySelected"]);
		$tmpArr=explode(",",$mySelected);
		for($i=0;$i<count($tmpArr);$i++){
			$neuron=trim($tmpArr[$i]);
			$_SESSION["neuron"][$neuron]=$neuron;
		}
	}
//}

if ( isset($_SESSION["neuron"]) ) {
	$cartNum=number_format(count($_SESSION["neuron"]))." neurons";
} else {
	$cartNum="";
}
echo $cartNum;
?>
