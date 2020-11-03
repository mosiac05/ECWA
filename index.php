<?php 
	include './includes/head.php';
 ?>
<?php include './includes/nav.php'; ?>

<?php 
	if(isset($_GET['home']))
	{
		include './home.php';
	}
	elseif(isset($_GET['ministry_details']))
	{
		include './ministry_details.php';
	}
	elseif(isset($_GET['sermons']))
	{
		include './sermons.php';
	}
	elseif(isset($_GET['sermon_details']))
	{
		include './sermon_details.php';
	}
	elseif(isset($_GET['about_us']))
	{
		include './about_us.php';
	}
	elseif(isset($_GET['events']))
	{
		include './events.php';
	}
	elseif(isset($_GET['event_details']))
	{
		include './event_details.php';
	}
	elseif(isset($_GET['announcements']))
	{
		include './announcements.php';
	}
	elseif(isset($_GET['programs']))
	{
		include './programs.php';
	}
	elseif(isset($_GET['contact']))
	{
		include './contact.php';
	}
	else
	{
		include './home.php';
	}
 ?>

<?php include './includes/footer.php'; ?>

<?php include './includes/js.php'; ?>