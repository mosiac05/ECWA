    <div class="wrap">
    
    <div class="block-45">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <ul class="block-45-list">
              <li><a href="#"><?=$about_us->getData('email'); ?></a></li>
              <li><a href="tel:/<?=$about_us->getData('phone_num'); ?>"><?=$about_us->getData('phone_num'); ?></a></li>
            </ul>
          </div>
          <div class="col-md-6 text-md-right">
            <ul class="block-45-icons">
              <li><a href="<?=$about_us->getData('facebook'); ?>"><span class="fa fa-facebook"></span></a></li>
              <li><a href="<?=$about_us->getData('twitter'); ?>"><span class="fa fa-twitter"></span></a></li>
              <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
              <li><a href="<?=$about_us->getData('instagram'); ?>"><span class="fa fa-instagram"></span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <header role="banner">
     
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand absolute" href="index.html">ECWA GoodNews <br class="hidden-md hidden-lg"> Church<!-- <span class="fa fa-heart text-primary"></span> -->  </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item <?php if(isset($_GET['home'])) { echo 'active'; } ?>">
                <a class="nav-link" href="index.php?home">Home</a>
              </li>
              <li class="nav-item dropdown <?php if(isset($_GET['ministry_details'])) { echo 'active'; } ?>">
                <a class="nav-link dropdown-toggle" href="ministry.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ministries</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                	<?php 
                		$ministry_query = $ministry->getAll();

                		while($ministry_data = mysqli_fetch_assoc($ministry_query)) {
                	 ?>
                  <a class="dropdown-item" href="index.php?ministry_details=<?=$ministry_data['id']; ?>"><?=$ministry_data['name']; ?></a>
                <?php } ?>
                </div>

              </li>

              <li class="nav-item dropdown <?php if(isset($_GET['sermons']) || isset($_GET['sermon_details']) || isset($_GET['category'])) { echo 'active'; } ?>">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sermons</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                  <a class="dropdown-item" href="sermons.php">All</a>
                	<?php 
                		$category_query = $sermon_category->getAll();

                		while($category_data = mysqli_fetch_assoc($category_query)) {
                	 ?>
                  <a class="dropdown-item" href="sermons.php?category=<?=$category_data['id'] ?>"><?=$category_data['category']; ?></a>
                <?php } ?>
                </div>

              </li>
              <li class="nav-item <?php if(isset($_GET['about_us'])) { echo 'active'; } ?>">
                <a class="nav-link" href="index.php?about_us">About</a>
              </li>
             
              <li class="nav-item dropdown <?php if(isset($_GET['events']) || isset($_GET['event_details']) || isset($_GET['announcements']) || isset($_GET['programs'])) { echo 'active'; } ?>">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Other Pages</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                  <a class="dropdown-item" href="index.php?events">Events</a>
                  <a class="dropdown-item" href="index.php?announcements">Announcements</a>
                  <a class="dropdown-item" href="index.php?announcements">Weekly Activities</a>
                </div>

              </li>
              <li class="nav-item <?php if(isset($_GET['contact'])) { echo 'active'; } ?>">
                <a class="nav-link" href="index.php?contact">Contact</a>
              </li>
            </ul>
            
            
          </div>
        </div>
      </nav>
    </header>
    <!-- END header -->
