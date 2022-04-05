<?php
$title = "Public Page";
include "login/misc/pagehead.php";
?>
</head>
<body>
<div class="container  bg-white">
  <?php require 'login/misc/pullnav.php'; ?>
    <div class="container">
	<div class="col-12 pt-1">
		<h4 class="blog-post-title"><em>FlyCircuit</em></h4>
		<p class="text-justify">is a public database for online archiving, cell type inventory, browsing, searching, analysis and 3D visualization of individual neurons in the Drosophila brain. For more details, please read the associated manuscript -- "Three-dimensional reconstruction of brain-wide wiring networks in Drosophila at single-cell resolution" (Current Biology 2011, 21(1), pp.1-11). Registration is only necessary for users who want to up/download data or activate 3D viewer to view more than 5 images.</p>
		<br><h4>Update information</h4>
		<p class="text-justify">FlyCircuit updates in version 1.1, image entries have been increased (from 12528 to 18161 for females and 3699 to 5422 for males). All single neuron registrations in the whole brain have been redone. The warping has been improved by adding a second local warping (with the help of the affine non-rigid transformation in Amira or Avizo) to register the brain region nearby the neuron. The presentation of spatial distribution for each neuron has been arranged from lateral to medial (on both sides). The polarity of some neurons (projection neurons in the female brain) has been predicted and described in the Annotation space in the Neuron ID page. 3D viewer environment has been updated, Java security requirement fulfilled. The Analysis part has not been updated, new algorithm will be available soon. The old version of FlyCircuit may still be retrieved from http://211.73.64.34/flycircuit. For registered users, the transformed images of single neurons may be downloaded from the Neuron ID pages. Due to the bandwidth limitation, we no longer let people upload their own image to FlyCircuit for further registration. This service will resume when capablilty becomes affordable.</p>
		<br>
		<h4>Acknowledgment</h4>
		<p class="text-justify">We appreciate everyone using data from the FlyCircuit. Nevertheless, we suggest that the following statement be used: "Images from FlyCircuit were obtained from the NCHC (National Center for High-performance Computing) and NTHU (National Tsing Hua University), Hsinchu, Taiwan".</p>
		<p class="text-justify">Java (Download) is needed for interactive 3D visualization. Your computer may already have one.</p>
		<p class="text-justify">For the novice, we recommend to start from "Gallery" for application examples and "Help/Tutor" for step-by-step demonstrations.</p>		
    </div>
    </div>
<br><br><?php include "login/misc/pagefooter.php"; ?>
</div>
</body>
</html>
