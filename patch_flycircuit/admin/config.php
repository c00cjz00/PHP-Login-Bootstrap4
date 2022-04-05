<?php
/**
* Configuration edit page
*
* Tags correspond to setting name, hover over them for setting description
**/
$userrole = 'Superadmin';
$title = 'Edit Site Configuration';
require '../login/misc/pagehead.php';
$settingsArr = $conf->pullAllSettings(new PHPLogin\AuthorizationHandler);
 ?>

<script src="js/editconfig.js"></script>

</head>
<body>
<div class="container  bg-white">
<?php require '../login/misc/pullnav.php'; ?>
<div class="container">
<form id="settingsForm" action="#" enctype="multipart/form-data">
<div class="form-group" id="configForm">
<h4>Edit Site Configuration</h3>
<?php

//Gets categories from settings array
if ($settingsArr['status'] === true) {
    foreach ($settingsArr['settings'] as $key => $value) {
        $groupedArr[$value[4]][] = $value;
    }

    $i = 1;
    //Builds tabs
    foreach ($groupedArr as $category => $catval) {
        if ($i === 1) {
            echo "<ul class='nav nav-tabs' id='myTab' role='tablist'><li class='nav-item'><a class='nav-link active' href='#{$category}' data-toggle='tab'>{$category}</a></li>&nbsp;&nbsp;&nbsp;";
        } else {
            echo "<li class='nav-item'><a class='nav-link' href='#{$category}' data-toggle='tab'>{$category}</a></li>&nbsp;&nbsp;&nbsp;";
        }
        $i++;
    }

    echo "</ul>
          <br>
          <div class='tab-content'  id='myTabContent'>";

    $x = 1;
    //Builds content within tabs
    foreach ($groupedArr as $category => $catval) {
        if ($x === 1) {
            echo "<div class='tab-pane fade show active' id='{$category}'>";
			echo "<div class='container'><div class='row'>";
        } else {
            echo "<div class='tab-pane fade' id='{$category}'>";
			echo "<div class='container'><div class='row'>";			
        }

        foreach ($catval as $setting) {
            $setting[1] = htmlspecialchars($setting[1], ENT_QUOTES);
            $setting[2] = htmlspecialchars($setting[2], ENT_QUOTES);

            //Input Type
            switch ($setting[3]) {

            case "textarea":
                echo "<div class='col-sm-12'>
                      <button type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</button>
                      <br><textarea id='{$setting[0]}' class='form-control textarea' rows='4' name='{$setting[0]}'>{$setting[1]}</textarea>
                      </div>";
                break;

            case "password":
                echo "<div class='col-sm-12'>
                      <button type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</button>
                      <br><input type='password' class='form-control password' name='{$setting[0]}' value='{$setting[1]}'></input><br>
                      </div>";
                break;

            case "boolean":
                if ($setting[1] == 'true') {
                    echo "<div class='col-sm-12'>
                          <button type='button' class='btn btn-primary text' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</button><br>
                          <select class='form-control' name='{$setting[0]}'>
                            <option value='true' selected>True</option>
                            <option value='false'>False</option>
                          </select><br></div>";
                } else {
                    echo "<div class='col-sm-12'>
                          <button type='button' class='btn btn-primary text' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</button><br>
                          <select class='form-control' name='{$setting[0]}'>
                            <option value='true'>True</option>
                            <option value='false' selected>False</option>
                          </select><br></div>";
                }
                break;

            case "number":
                echo "<div class='col-sm-12'>
                      <button type='button' class='btn btn-primary text' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</button><br>
                      <input type='number' class='form-control boolean' name='{$setting[0]}' value='{$setting[1]}'></input><br>
                      </div>";
                break;

            case "email":
            echo "<div class='col-sm-12'>
                  <button type='button' class='btn btn-primary text' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</button><br>
                  <input type='email' class='form-control boolean' name='{$setting[0]}' value='{$setting[1]}'></input><br>
                  </div>";
                break;

            case "url":
            echo "<div class='col-sm-12'>
                  <button type='button' class='btn btn-primary text' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</button><br>
                  <input type='url' class='form-control boolean' name='{$setting[0]}' value='{$setting[1]}'></input><br>
                  </div>";
                break;

            case "timezone":

                echo "<div class='col-sm-12'>
                      <button type='button' class='btn btn-primary text' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</button><br>
                      <select class='form-control' name='{$setting[0]}' value='{$setting[1]}'>";

                  foreach (timezone_identifiers_list() as $timezone) {
                      if ($setting[1] == $timezone) {
                          echo "<option value='$timezone' selected>$timezone</option>";
                      } else {
                          echo "<option value='$timezone'>$timezone</option>";
                      }
                  };

                echo "</select><br></div>";
                break;

            default:
                echo "<div class='col-sm-12'>
                      <button type='button' class='btn btn-primary text' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</button><br>
                      <input class='form-control' name='{$setting[0]}' value='{$setting[1]}'></input><br>
                      </div>";
			}
        }
        echo '</div></div></div>';

        $x++;
    }
    echo '</div>'; ?>
</div>

</form>

<div class="col-sm-12">
    <div class="col-sm-12">
        <div class="row">
            <div id="message"></div>

        </div>
    </div>
</div>

<button class='btn btn-success' id="savebtn">Save</button>
<button class='btn btn-info' id='testemail'>Test Email Config</button>

</div>
<br><br><br>
<script>
$(function () {
  //ENABLES TOOLTIPS
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<br><br><?php include "../login/misc/pagefooter.php"; ?>
</div>
</body>
</html>
<?php
} else {
  echo $settingsArr['message'];
} ?>
