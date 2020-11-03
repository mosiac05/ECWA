<?php 
	require_once './includes/head.php';
 ?>
<?php
	
	if(!isset($_SESSION["user_email"]))
	{
		include 'login.php';
	}
	else
	{

		require_once './includes/nav.php';

 ?>
<!-- Start app main Content -->
<div class="main-content">

<?php
		if(isset($_SESSION['messages'])){
			$messages = $dbConfig->displayMessage();
			$i = 0;
			while ($i < count($messages)) {
			$words = explode('|', $messages[$i]);
			
	 ?>
	<div class="col-12 alert <?=$words[1] ?> alert-dismissible show fade" role="alert">
		<div class="alert-body">
	      <button class="close" data-dismiss="alert"><span>&times;</span></button>
	      <?=$words[0]; ?>
	  </div>
	</div>
	<?php 
				$i += 1;
		}
	}
?>


<?php
		if($dbConfig->checkUserActive() && $dbConfig->checkUserIsStaff())
		{
				if(isset($_GET['dashboard']))
				{
					include 'dashboard.php';
				}
				elseif(isset($_GET['banners']) || isset($_GET['banner_edit']))
				{
					include 'banners.php';
				}
				elseif(isset($_GET['services']) || isset($_GET['service_edit']))
				{
					include 'services.php';
				}
				elseif(isset($_GET['events']) || isset($_GET['event_edit']))
				{
					include 'events.php';
				}
				elseif(isset($_GET['programs']) || isset($_GET['program_edit']))
				{
					include 'programs.php';
				}
				elseif(isset($_GET['zones']) || isset($_GET['zone_edit']))
				{
					include 'zones.php';
				}
				elseif(isset($_GET['bible_quotes']) || isset($_GET['bible_quote_edit']))
				{
					include 'bible_quotes.php';
				}
				elseif(isset($_GET['ministries']) || isset($_GET['ministry_edit']))
				{
					include 'ministries.php';
				}
				elseif(isset($_GET['board_members']) || isset($_GET['board_member_edit']))
				{
					include 'board_members.php';
				}
				elseif(isset($_GET['categories']) || isset($_GET['category_edit']))
				{
					include 'categories.php';
				}
				elseif(isset($_GET['sermon_create']) || isset($_GET['sermon_edit']))
				{
					include 'sermon_create.php';
				}
				elseif(isset($_GET['sermons']))
				{
					include 'sermons.php';
				}
				elseif(isset($_GET['sermon_single']))
				{
					include 'sermon_single.php';
				}
				elseif(isset($_GET['contacts']))
				{
					include 'contacts.php';
				}
				elseif(isset($_GET['about_us']))
				{
					include 'about_us.php';
				}
				elseif(isset($_GET['announcement']))
				{
					include 'announcement.php';
				}
				elseif(isset($_GET['staffs']) || isset($_GET['admins']))
				{
					include 'staffs.php';
				}
				elseif(isset($_GET['user_single']))
				{
					include 'user_single.php';
				}
				elseif(isset($_GET['logout']))
				{
					$auth->logout(1);
				}
				else
				{
					$dbConfig->setMessage("Please avoid malicious editing of the URL!|alert-light");
					include 'dashboard.php';
				}			
		}
		else
		{
			$auth->logout();
		}

	}
 ?>   
</div>     
        
<!-- Start app Footer part -->
<?php 
	require_once './includes/footer.php';
 ?>
<!-- General JS Scripts -->
<?php 
	require_once './includes/js.php';
 ?>