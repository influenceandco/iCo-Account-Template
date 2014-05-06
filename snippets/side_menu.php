<ul id="side_menu">
	<a href="../dashboard" id="users"><li>Dashboard</li></a>
	<?php if($_SESSION["clearance_level"] > 0){ ?>
	<a href="../manage-users" id="users"><li>Manage users</li></a>
	<? } ?>

	<a href="../account" id="account"><li>My account</li></a>
	<a href="../scripts/logout.php" id="logout"><li>Logout</li></a>
</ul>