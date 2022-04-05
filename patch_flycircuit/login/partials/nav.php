   <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-3 pt-1">
			<?php
			// SIGN IN / USER SETTINGS BUTTON
			$auth = new PHPLogin\AuthorizationHandler;

			// Pulls either username or first/last name (if filled out)
			if ($auth->isLoggedIn()) {
				$usr = PHPLogin\ProfileData::pullUserFields($_SESSION['uid'], array('firstname', 'lastname'));
				if ((is_array($usr)) && (array_key_exists('firstname', $usr) && array_key_exists('lastname', $usr))) {
					$user = $usr['firstname']. ' ' .$usr['lastname'];
				} else {
					$user = $_SESSION['username'];
				} 
			?>			
			<div class="dropdown">
			  <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">c00cjz00</button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item active" href="<?php echo $this->base_url; ?>/user/profileedit.php">Edit Profile</a>
				<a class="dropdown-item" href="<?php echo $this->base_url; ?>/user/accountedit.php">Account Settings</a>
				<div class="dropdown-divider"></div>				
				<!-- Superadmin Controls -->
				<?php if ($auth->isSuperAdmin()): ?>
				<a class="dropdown-item" href="<?php echo $this->base_url; ?>/admin/config.php">Edit Site Config</a>
				<a class="dropdown-item" href="<?php echo $this->base_url; ?>/admin/permissions.php">Manage Permissions</a>
				<div class="dropdown-divider"></div>
				<?php endif; ?>
				<!-- Admin Controls -->
				<?php if ($auth->isAdmin()): ?>
				<a class="dropdown-item" href="<?php echo $this->base_url; ?>/admin/users.php">Manage User</a>
				<a class="dropdown-item" href="<?php echo $this->base_url; ?>/admin/roles.php">Manage Roles</a>
				<a class="dropdown-item" href="<?php echo $this->base_url; ?>/admin/mail.php">Mail Log</a>
				<div class="dropdown-divider"></div>
				<?php endif; ?>
				<a class="dropdown-item" href="<?php echo $this->base_url; ?>/login/logout.php">Logout</a>				
			  </div>
			</div>
			<?php
			} else {
			//User not logged in
			?>
		    <a class="btn btn-sm btn-outline-secondary" href="/login/">Sign up</a>
			<?php } ?>			
          </div>
          <div class="col-6 text-center">
            <a class="blog-header-logo text-dark" href="#"><em>Flycircuit</em></a>
          </div>
          <div class="col-3 d-flex justify-content-end align-items-center">
		    <a class="text-muted" href="#"><i class="fa fa-cart-arrow-down" style="font-size:30px;color:grey;"></i></a>
          </div>
        </div>
      </header>
      <div class="py-1">	  
		<nav class="navbar navbar-expand-md navbar-light py-1">
		  <a class="navbar-brand" href="#"></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
			  <li class="nav-item">
				<a class="nav-link" href="/index.php">&nbsp;&nbsp;Introduction</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="/datatableTemplateAuth_flycircuit.php">&nbsp;&nbsp;Browsing</a>
			  </li>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
				  &nbsp;&nbsp;Search
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				  <a class="dropdown-item" href="#">Text-based</a>
				  <a class="dropdown-item" href="#">Image-based &#9792</a>
				  <a class="dropdown-item" href="#">Image-based &#9794</a>
				</div>
			  </li>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
				  &nbsp;&nbsp;Analysis
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				  <a class="dropdown-item" href="#">Neuron Comparison</a>
				  <a class="dropdown-item" href="#">NeuroRetriever</a>
				  <a class="dropdown-item" href="#">Kaleido</a>
				</div>
			  </li>	
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
				  &nbsp;&nbsp;Download
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				  <a class="dropdown-item" href="#">Data</a>
				  <a class="dropdown-item" href="#">Snapshot</a>
				</div>
			  </li>				  
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
				  &nbsp;&nbsp;Help
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				  <a class="dropdown-item" href="#">Tutor</a>
				  <a class="dropdown-item" href="#">Site Map</a>
				  <a class="dropdown-item" href="#">Contact FlyCircuit</a>
				</div>
			  </li>
			</ul>
		  </div>
		</nav>	  
	  </div>
      <div class="jumbotron p-3 p-md-3 text-white rounded bg-info">
        <div class="col-md-10 px-0">
          <h1 class="display-5 font-italic">Welcome to FlyCircuit Database</h1>
          <p class="lead my-3"><em>FlyCircuit</em> is a public database for online archiving, cell type inventory, browsing, searching, analysis and 3D visualization of individual neurons in the <em>Drosophila</em> brain.</p>
        </div>
      </div>
    </div>