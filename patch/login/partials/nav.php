     <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <!--a class="navbar-brand" href="#">Navbar</a-->
	  <?php
	  //SITE LOGO (IF SET) OR SITE NAME
	  if (str_replace(' ', '', $this->mainlogo) == '') {
		//No logo, just renders site name as link
		echo '<ul class="nav navbar-nav navbar-left"><li class="sitetitle"><a class="navbar-brand" href="'.$this->base_url.'">'.$this->site_name.'</a></li></ul>';
	  } else {
		//Site main logo as link
		echo '<ul class="nav navbar-nav navbar-left"><li class="mainlogo"><a class="navbar-brand" href="'.$this->base_url.'"><img src="'.$this->mainlogo.'" height="36px"></a></li></ul>';
	  }
	  ?>	  
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo $this->base_url; ?>/index.php">Homepage</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $this->base_url; ?>/page_2.php">Private Page</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $this->base_url; ?>/page_3.php">Public Page</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Other Pages</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">PHP-Login Github</a>
              <a class="dropdown-item" href="#">Site Root</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $this->base_url; ?>/page_4.php">Admin Page</a>
          </li>
        </ul>
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
			} ?>

			<ul class="nav navbar-nav navbar-right">			
				<li class="nav-item dropdown">
				  <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  <button type="button" class="btn btn-outline-primary my-2 my-sm-0"><?php echo $user; ?></button>
				  </a>
				  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
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
				</li>
			</ul>
		<?php
		} else {
				//User not logged in?>
			<ul class="nav navbar-nav navbar-right">			
			<li class="dropdown">
			<a href="<?php echo $this->base_url; ?>/login/index.php" class="btn btn-outline-primary my-2 my-sm-0" role="button" aria-pressed="true">Sign In</a>
			</li>
			</ul>

		<?php
			};

		?>		
		
		
      </div>
    </nav>