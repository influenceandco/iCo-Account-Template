<?php session_start(); if(!$_SESSION["user"]){header("Location: ../login");}
include("../scripts/dbconnect.php");?>


<?php include("../snippets/header.php");?><!-- header-->

<title>Dashboard| Influence & Co.</title>
	
<!--body goes here-->
	<?php include("../snippets/alert_modal.php");?>
	<?php include("../snippets/navbar.php");?>

	<div id="main_section">
		<div class="container">
			<div class="row-fluid">
				<div class="span3">
					<?php include("../snippets/side_menu.php");?>
				</div>
				<div class="span9">	
				
				</div>
			</div>
		</div>

	</div>


<!-- end of body -->
<?php include("../snippets/footer.php");?> <!--global footer -->

<?php include("../snippets/javascripts.php");?> <!--global javascripts -->
<script src="../assets/js/check.session.min.js"></script>

<!--any other custom scripts here-->
<script type="text/javascript">
$("#dashboard").addClass("active");
</script>

</body>
</html>