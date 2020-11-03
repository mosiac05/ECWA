<?php
	$event_query = $event->getOne($_GET['event_details']);
	$event_data = mysqli_fetch_assoc($event_query);

	$dbConfig->checkRecordExist($event_data);

	$banner_query = $banner->getFirst();
	$banner_data = mysqli_fetch_assoc($banner_query);
?>
<section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/banner_images/<?=$banner_data['image']; ?>);">
  <div class="container">
    <div class="row align-items-center justify-content-center site-hero-inner">
      <div class="col-md-8 text-center">

        <div class="mb-5 element-animate">
          <div class="block-17">

            <h1 class="heading mb-4"><?=$event_data['title']; ?></h1>
            <span class="lead"><?=date('l jS F\, Y g:iA', strtotime($event_data['date'])); ?></span>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>
<!-- END section -->





<div class="site-section bg-light">
  <div class="container">
    <div class="row">
      
      <div class="col-md-6 col-lg-8 order-md-2 pl-lg-5">
        <div class="row">
          <div class="col-md-12 col-lg-12 mb-5">
 							
 							<p><img src="images/event_images/<?=$event_data['image']; ?>" alt="<?=$event_data['image']; ?>" class="img-fluid"></p>
              <p class="lead"><?=$event_data['text']; ?></p>
              <!-- <div class="pt-5">
                <p>Categories:  <a href="#">Design</a>, <a href="#">Events</a>  Tags: <a href="#">#course</a>, <a href="#">#trends</a></p>
              </div> -->
          </div>
        </div>

        
      </div>
      <!-- END content -->
      <div class="col-md-6 col-lg-4 order-md-1">
        <div class="block-25 mb-5">
          <div class="heading">Recent Events</div>
          <ul>
            <?php 
              $event_query = $event->getLatest(3);

              while($event_data = mysqli_fetch_assoc($event_query)) {
             ?>
            <li>
              <a href="index.php?event_details=<?=$event_data['id']; ?>" class="d-flex">
                <figure class="image mr-3">
                  <img src="images/event_images/<?=$event_data['image']; ?>" alt="<?=$event_data['image']; ?>" class="img-fluid">
                </figure>
                <div class="text">
                  <h3 class="heading"><?=$event_data['title']; ?></h3>
                </div>
              </a>
            </li>
          <?php } ?>
          </ul>
        </div>
</div>
      <!-- END Sidebar -->
    </div>
  </div>
</div>
