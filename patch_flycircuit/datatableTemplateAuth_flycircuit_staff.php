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
 $table_name="fc13List";
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
        Field::inst( 'lsm' ),
        Field::inst( 'neuron' ),
        Field::inst( 'gender' ),
        Field::inst( 'age' ),
        Field::inst( 'driver' ),
        Field::inst( 'neurotransmitter' ),
        Field::inst( 'birthtiming' ),
        Field::inst( 'neuronVolume' ),
        Field::inst( 'author' )	
    )
    ->process( $_POST )
    ->json();
