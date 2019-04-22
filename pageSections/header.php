<!-- Site Header -->
<header>
	<nav class="navbar navbar-static-top navbar-default navbar-expand-md shadow navbar-dark bg-dark">
		<a href="index.php"><img src="img/bangor_logo_c2_flush.svg" alt="Bangor University" , height="50em"></a>
		<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navBar" aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation"></button>
		<div class="collapse navbar-collapse" id="navBar">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item <?=($page=="home") ? "active" : ""?>">
					<a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Homepage</a>
				</li>
				<li class="nav-item <?=($page=="makeRequest") ? "active" : ""?>">
					<a class="nav-link" href="makeRequest.php"><i class="fa fa-pen-fancy" aria-hidden="true"></i> Make Request</a>
				</li>
				<li class="nav-item <?=($page=="test") ? "active" : ""?>">
					<a class="nav-link" href="testPage.php"><i class="fa fa-cog" aria-hidden="true"></i> Test Page</a>
				</li>
				<?php
				// Include admin dropdown if user is admin
					if ($_SESSION['userRole'] == "CENTRAL_FINANCE") {
						include "pageSections/admin.php";
					}
				?>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<!-- Trigger logout modal -->
				<button class="btn btn-outline-danger my-2 my-sm-0" type="button" , data-toggle="modal" , data-target="#modelLogout"><i class="fa fa-door-closed"></i>Logout</button>
			</form>
		</div>
	</nav>

	<div class="modal fade" id="modelLogout" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Logging out?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					You are about to log out, are you sure? <br> You will need to log in again to continue using the
					site.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times "></i> Cancel</button>
					<form id="do_logout" action="api/logout.php" method="POST">
						<button type="submit" class="btn btn-danger" name="do_logout"><i class="fa fa-door-closed"></i>Logout</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</header>
