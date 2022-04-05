<?php
/*
 * Example PHP implementation used for the index.html example
 */

// cjz new
$dirBin=dirname(__FILE__);  // cjz new
include($dirBin."/dbconf.php");  // cjz new

// DataTables PHP library
// include( "../lib/DataTables.php" );  // cjzold
define("DATATABLES", true, true);  // cjz new
include( $DT_folder."/lib/Bootstrap.php" ); // cjz new


if (isset($_GET["mytable"]) && (trim($_GET["mytable"])!="") ){
 $table_name=$_GET["mytable"];
}else{
 $table_name="flycircuit_db";
}

// Alias Editor classes so they are easy to use
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, $table_name )
    ->fields(
        Field::inst( 'id' ),
        Field::inst( 'neuron' ),
        Field::inst( 'neuronName' ),
        Field::inst( 'gender' ),
        Field::inst( 'age' ),
        Field::inst( 'driver' ),
        Field::inst( 'neurotransmitter' ),
        Field::inst( 'birthtiming' ),
        Field::inst( 'class' ),
        Field::inst( 'type' ),
        Field::inst( 'imagingTechnique' ),
        Field::inst( 'library' ),
        Field::inst( 'reference' ),		
        Field::inst( 'bridgeID01' ),	
        Field::inst( 'bridgeID02' ),	
        Field::inst( 'bridgeID03' ),	
        Field::inst( 'bridgeID04' )	
    )
    ->process( $_POST )
    ->json();
