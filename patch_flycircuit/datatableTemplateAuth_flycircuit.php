<?php
# configure start 
# binary path, you can edit myDT_config.php
$dirBin=dirname(__FILE__); // cjz new 
include($dirBin."/dbconf.php"); // cjz new 

$title = "Flycircuit - Browsing";
include ($dirBin."/login/misc/pagehead.php");

/* 資料表單結構 default column*/
$con=mysqli_connect($host,$username,$password,$db_name); mysqli_set_charset( $con, 'utf8');
if (mysqli_connect_errno()){
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

/* 選擇資料庫表單 */

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

if ($table_name=="neuronList"){
 $buttonText="Browsing: $totalNeuron neurons";	
 $buttonColor="info";
}else{
 $buttonText=$annotation." ".$totalNeuron." neurons";	
 $buttonColor="danger";
}

?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.3/css/colReorder.dataTables.min.css">		
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$DT_folder;?>/css/editor.dataTables.min.css">
	<!--link rel="stylesheet" type="text/css" href="<?=$DT_folder;?>/examples/resources/syntax/shCore.css"-->
	<!--link rel="stylesheet" type="text/css" href="<?=$DT_folder;?>/examples/resources/demo.css"-->	
	<style type="text/css" class="init">
		#leftbutton {
			position: relative;
			float: left;
		}
		#rightbutton {
			position: relative;
			float: right;
		}
		tfoot input {
			width: 100%;
			padding: 3px;
			box-sizing: border-box;
		}
		div.dataTables_wrapper {
			width: 100%;
			margin: 0 auto;
		}	
	</style>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>	
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/colreorder/1.5.3/js/dataTables.colReorder.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>	
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
	<script type="text/javascript" language="javascript" src="<?=$DT_folder;?>/js/dataTables.editor.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>	
	
	<script type="text/javascript" class="init">
	var mytable = "<?=$table_name;?>";
	</script>
    <script type="text/javascript" charset="utf-8" src="datatableTemplateAuth_flycircuit.js"></script>

</head>
<body>
<div class="container  bg-white">
  <?php require 'login/misc/pullnav.php'; ?>
    <div class="container">
	<div class="col-12 pt-1">
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" >
			<div class="modal-content"></div><!-- /.modal-content -->
		</div> <!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->  
    <div class="container">
		<?php 
		/*if (isset($_POST["copyCart"])){
			if (isset($_POST["mySelected"]) && (trim($_POST["mySelected"])!="")){
				$mySelected=trim($_POST["mySelected"]);
				$tmpArr=explode(",",$mySelected);
				for($i=0;$i<count($tmpArr);$i++){
					$neuron=trim($tmpArr[$i]);
					$_SESSION["neuron"][$neuron]=$neuron;
				}
			}
		}
		if ( isset($_SESSION["neuron"]) ) {
		echo count($_SESSION["neuron"])."<br>";
		}*/
		/* if ( !isset($_SESSION["peter"]) ) {
			$_SESSION["peter"] = 0;
		 }else{
			$_SESSION["peter"] = $_SESSION["peter"] +1;
		 }
		 echo $_SESSION["peter"] ."_cjz<Br>";*/
		?>
        <!--h3>Hello, <?=$_SESSION["username"]?>!</h3-->
		<!--div class="demo-html"-->
			<!--table id="example" class="display" style="width:100%"-->
			<!--div id="leftbutton">
			<button id="button_search" class="btn btn-<?=$buttonColor;?>"><?=$buttonText;?></button>
			</div-->							
			<table id="example" class="display table table-striped nowrap" style="width:100%">
				<thead>
					<tr>
						<th></th>
						<th>images</th>
						<th>neuron</th>
						<th>gender</th>
						<th>age</th>
						<th>driver</th>
						<th>neurotransmitter</th>
						<th>birth</th>
						<th>volume</th>
						<th>author</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th>images</th>
						<th>neuron</th>
						<th>gender</th>
						<th>age</th>
						<th>driver</th>
						<th>neurotransmitter</th>
						<th>birth</th>
						<th>volume</th>
						<th>author</th>
					</tr>
				</tfoot>
			</table>
		<!--/div-->		
    </div><br>
	<div class="container">
	  <button id="button_selectall" class="btn btn-secondary">Select all</button>
	  <button id="button_removeall" class="btn btn-secondary">Remove selected</button>
	  <!--button id="button_search" class="btn btn-info">Selected neurons</button-->
	  <form id="myform" action="process.php" method="post">
		<div class="form-group">
		  <textarea class="form-control" rows="3" name="mySelected" id="mySelected"></textarea>
		</div>	  
		<input type="button" class="btn btn-info" id="copyID" value="Copy" />
		<?php if  (isset($_GET["carttable"]) && ($_GET["carttable"]=="usertable")){ ?>
		<a href="?neuronReset=1" role="button" type="submit" class="btn btn-danger" id="emptycart" name="emptycart">Empty cart</a>
		<?php }else{ ?>
		<button type="submit" class="btn btn-info" id="copyCart" name="copyCart">Add to cart</button>
		<?php }?>
	  </form>
	</div>
	<Br>
    <script type="text/javascript">
        var button = document.getElementById("copyID"),
            input = document.getElementById("mySelected");

        button.addEventListener("click", function(event) {
            event.preventDefault();
            input.select();
            document.execCommand("copy");
        });
    </script>	
	<script>
	/* get all form */
	$( "form" ).each( function () {
		/* each form add onsubmit event */
		$( this ).bind( "submit", function (event) {
			event.preventDefault(); // return false
			var formHTML = event.target; // $( this ) => not work !!
			console.log( formHTML ); // formHTML element
			// https://developer.mozilla.org/en-US/docs/Web/API/FormData/Using_FormData_Objects
			var formData = new FormData( formHTML );
			console.log( formData );
			// https://api.jquery.com/jquery.ajax/
			// https://www.w3schools.com/jquery/ajax_ajax.asp
			// https://www.w3schools.com/jquery/jquery_ref_ajax.asp
			/* AJAX request */
			ajax( formHTML, formData, "#neuronNum" ); // ajax( form, data, destination )
		} );
	});
	function ajax( form, data, destination ) {
		$.ajax({
			method: form.method,
			url: form.action,
			data: data,
			dataType: "HTML",
			/* formData */
			contentType: false, // formData with $_POST or $_FILES in server (PHP)
			processData: false
		})
		/* handle success */
		.done( function(result) {
			$( destination ).html( result );
			console.log(result);
		} )
		/* handle error */
		.fail( function(error) {
			alert("Cannot Set Data!");
			console.error(error);
		} );
	}
	</script>
    </div>
    </div>
<br><?php include "login/misc/pagefooter.php"; ?>
</div>
</body>
</html>