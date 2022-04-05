<?php
# configure start 
# binary path, you can edit myDT_config.php
$dirBin=dirname(__FILE__); // cjz new 
include($dirBin."/../../dbconf.php"); // cjz new 

/* 資料表單結構 default column*/
$con=mysqli_connect($host,$username,$password,$db_name); mysqli_set_charset( $con, 'utf8');
if (mysqli_connect_errno()){
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

/* 選擇資料庫表單 */
$sql="select `neuron`,`gender`,`age`,`driver`,`neurotransmitter`,`birthtiming` from neuronList";
if ($result=mysqli_query($con,$sql)){
 while ($row=mysqli_fetch_row($result)){
  $neuron=trim($row[0]);
  $neuronArr[$neuron]["neuron"]=$neuron;  
  $neuronArr[$neuron]["neuronName"]=$neuron;  
  $neuronArr[$neuron]["gender"]=trim($row[1]);  
  $neuronArr[$neuron]["age"]=trim($row[2]);  
  $neuronArr[$neuron]["driver"]=trim($row[3]);  
  $neuronArr[$neuron]["neurotransmitter"]=trim($row[4]);  
  $neuronArr[$neuron]["birthtiming"]=trim($row[5]);  
  $neuronArr[$neuron]["class"]="";
  $neuronArr[$neuron]["type"]="";
  $neuronArr[$neuron]["imagingTechnique"]="Confocal";
  $neuronArr[$neuron]["library"]="FlyCircuit";
  $neuronArr[$neuron]["reference"]="Chiang et al., 2011";
  $neuronArr[$neuron]["bridgeID01"]=trim($row[0]);
  $neuronArr[$neuron]["bridgeID02"]="";
  $neuronArr[$neuron]["bridgeID03"]="";
  $neuronArr[$neuron]["bridgeID04"]="";
 }
}	
$sql="select `neuron`,`neuPrint`,`name`,`class` from  flyem";
if ($result=mysqli_query($con,$sql)){
 while ($row=mysqli_fetch_row($result)){
  $neuron=trim($row[1]);
  $neuronArr[$neuron]["neuron"]="FlyEM-HB-".$neuron;
  $neuronArr[$neuron]["neuronName"]=trim($row[2]);
  $neuronArr[$neuron]["gender"]="F";  
  $neuronArr[$neuron]["age"]="";  
  $neuronArr[$neuron]["driver"]="";  
  $neuronArr[$neuron]["neurotransmitter"]="";  
  $neuronArr[$neuron]["birthtiming"]="";  
  $neuronArr[$neuron]["class"]=trim($row[3]); 
  $tmpArr=explode("_",trim($row[2]));  $tmp=""; for($i=0;$i<(count($tmpArr)-1);$i++){ $tmp.=$tmpArr[$i]."_"; }	  
  $neuronArr[$neuron]["type"]=substr($tmp,0,-1);
  $neuronArr[$neuron]["imagingTechnique"]="FIB-SEM";
  $neuronArr[$neuron]["library"]="JRC FlyEM Hemibrain";
  $neuronArr[$neuron]["reference"]="Xu et al., 2020";
  $neuronArr[$neuron]["bridgeID01"]="";
  $neuronArr[$neuron]["bridgeID02"]=trim($row[0]); 
  $neuronArr[$neuron]["bridgeID03"]=trim($row[1]);  
  $neuronArr[$neuron]["bridgeID04"]=trim($row[1]); 
 }
}

$sql="TRUNCATE TABLE flycircuit_db"; mysqli_query($con,$sql); 
foreach ($neuronArr as $neuron => $value){
 $a01=$neuronArr[$neuron]["neuron"];
 $a02=$neuronArr[$neuron]["neuronName"]; 
 $a03=$neuronArr[$neuron]["gender"];
 $a04=$neuronArr[$neuron]["age"];
 $a05=$neuronArr[$neuron]["driver"];
 $a06=$neuronArr[$neuron]["neurotransmitter"];
 $a07=$neuronArr[$neuron]["birthtiming"];
 $a08=$neuronArr[$neuron]["class"];
 $a09=$neuronArr[$neuron]["type"];
 $a10=$neuronArr[$neuron]["imagingTechnique"];
 $a11=$neuronArr[$neuron]["library"];
 $a12=$neuronArr[$neuron]["reference"];
 $a13=$neuronArr[$neuron]["bridgeID01"];
 $a14=$neuronArr[$neuron]["bridgeID02"];
 $a15=$neuronArr[$neuron]["bridgeID03"];
 $a16=$neuronArr[$neuron]["bridgeID04"];
 $sql="INSERT INTO flycircuit_db (`id`, `neuron`, `neuronName`, `gender`, `age`, `driver`, `neurotransmitter`, `birthtiming`, `class`, `type`, `imagingTechnique`, `library`, `reference`, `bridgeID01`, `bridgeID02`, `bridgeID03`, `bridgeID04`) VALUES (NULL, '".$a01."', '".$a02."', '".$a03."', '".$a04."', '".$a05."', '".$a06."', '".$a07."', '".$a08."', '".$a09."', '".$a10."', '".$a11."', '".$a12."', '".$a13."', '".$a14."', '".$a15."', '".$a16."')";
 //echo $sql."\n";
 //exit();
 mysqli_query($con,$sql);
}


/*FlyCircuit 1.0 - single neurons (Chiang2010)
exit();
if (isset($_GET["mytable"]) && (trim($_GET["mytable"])!="") ){
 $table_name=$_GET["mytable"];
 $annotation="Search result:"; 
}elseif (isset($_GET["carttable"]) && (trim($_GET["carttable"])!="") ){
 $table_name=$_GET["carttable"]; 
 $annotation="Neuron cart:";
  $sql="CREATE TABLE IF NOT EXISTS usertable LIKE neuronList"; mysqli_query($con,$sql);
  $sql="TRUNCATE TABLE usertable"; mysqli_query($con,$sql); 
 if (isset($_SESSION["neuron"])){
  $neuronArr=$_SESSION["neuron"];
  foreach ($neuronArr as $neuron => $value){
   //$gender=$neuronArr[$neuron]["gender"];
   //$age=$neuronArr[$neuron]["age"];
   //$driver=$neuronArr[$neuron]["driver"];
   //$neurotransmitter=$neuronArr[$neuron]["neurotransmitter"];
   //$birthtiming=$neuronArr[$neuron]["birthtiming"];
   //$neuronVolume=$neuronArr[$neuron]["neuronVolume"];
   //$author=$neuronArr[$neuron]["author"];
   //echo $neuron."<br>";
   $sql="INSERT INTO usertable SELECT null,lsm, neuron, gender, age, driver, neurotransmitter, birthtiming, neuronVolume, author FROM neuronList WHERE neuron='".$neuron."'"; 
   mysqli_query($con,$sql);
   //echo $sql."<br>";
  } 
 }
 
}else{
 $table_name="neuronList";
}

$sql="select count(*) from ".$table_name;
if ($result=mysqli_query($con,$sql)){
 while ($row=mysqli_fetch_row($result)){
  $totalNeuron=trim($row[0]);
 }
}
*/