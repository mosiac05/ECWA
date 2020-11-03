<?php
	include './classes/service.php';
	include './classes/program.php';
	include './classes/zone.php';
	include './classes/board_member.php';

	$banner_query = $banner->getFirst();
	$banner_data = mysqli_fetch_assoc($banner_query);
?>
<section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/banner_images/<?=$banner_data['image']; ?>);">
  <div class="container">
    <div class="row align-items-center justify-content-center site-hero-inner">
      <div class="col-md-8 text-center">

        <div class="mb-5 element-animate">
          <div class="block-17">
            <h1 class="heading mb-4">About The Church.</h1>
            <div class="lead"><?=$banner_data['caption']; ?></div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>
<!-- END section -->



<section class="site-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 order-md-2">
        <div class="block-16">
          <figure>
            <img src="images/about_us/<?=$about_us->getData('image'); ?>" alt="Image placeholder" class="img-fluid img-shadow">
            <a href="<?=$about_us->getData('video_link'); ?>" class="play-button popup-vimeo"><span class="ion-ios-play"></span></a>
          </figure>
        </div>
      </div>
      <div class="col-md-6 order-md-1">
        <div class="block-15">
          <div class="heading">
            <h2>Welcome To ECWA GoodNews Church</h2>
          </div>
          <div class="text mb-5">
          <p class="text-black">Church Pastor: <strong><?=$about_us->getData('pastor_name'); ?></strong></p>
          <p class="mb-4"><?=$about_us->getData('text'); ?></p>
          </div>              
        </div>
      </div>          
    </div>

  </div>
</section>
<!-- END section -->


<div class="container site-section">
  <div class="container">


    <div class="row">
      <div class="col-md-12">
        <div class="section-heading mb-5">
          <h2 class="heading">Leadership</h2>
        </div>
      </div>
    </div>
   
    <div class="row"> 
    	<?php 
    		$board_query = $board_member->getAll();

    		while($board_data = mysqli_fetch_assoc($board_query)) {
    	 ?>     
      <div class="col-md-6 col-lg-3">
        <div class="block-38 text-center">
          <div class="block-38-img">
            <div class="block-38-header">
              <img src="images/board_member_images/<?=$board_data['image']; ?>" alt="<?=$board_data['image']; ?>">
              <h3 class="block-38-heading"><?=$board_data['name']; ?></h3>
              <p class="block-38-subheading"><?=$board_data['position']; ?></p>
            </div>
            <div class="block-38-body">
              <p><?=$board_data['text']; ?></p>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</div>

<section class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-4 mb-5">
        <div class="block-43">
          <div class="block-43-icon">
            <span class="icon-wrapper">
              <span class="icon fa fa-book text-primary"></span>  
            </span>
            
          </div>
          <div class="block-43-text">
            <h3 class="block-43-heading">Connect With God</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A quibusdam nisi eos accusantium eligendi velit deleniti nihil ad deserunt rerum.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 mb-5">
        <div class="block-43">
          <div class="block-43-icon">
            <span class="icon-wrapper">
              <span class="icon fa fa-user text-primary"></span>  
            </span>
            
          </div>
          <div class="block-43-text">
            <h3 class="block-43-heading">Come As You Are</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A quibusdam nisi eos accusantium eligendi velit deleniti nihil ad deserunt rerum.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 mb-5">
        <div class="block-43">
          <div class="block-43-icon">
            <span class="icon-wrapper">
              <span class="icon fa fa-heart text-primary"></span>  
            </span>
            
          </div>
          <div class="block-43-text">
            <h3 class="block-43-heading">Brotherly Love</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A quibusdam nisi eos accusantium eligendi velit deleniti nihil ad deserunt rerum.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2 class="heading">Weekly Activities</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-md v_center">
                    <tr>
                        <th>Days</th>
                        <th>Activities</th>
                        <th>Time</th>
                        <th>Venue</th>
                    </tr>
                    <!-- One Day -->
                    
                    <?php 
                      $days = ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'];

                      for ($i=0; $i < 7; $i++) { 
                        $program_query = $program->getByDay($days[$i]);
                          if(is_null($program_query) || empty($program_query))
                          {
                            continue;
                          }
                      ?>
                    <tr class="text-center">
                        <td class="pt-5" rowspan="<?php echo $program->getNumberOfProgramsByDay($days[$i]); ?>"><?php echo $days[$i]; ?></td>
                    </tr>
                      <?php
                        while($program_data = mysqli_fetch_assoc($program_query)) {
                      
                     ?>
                    <tr>
                      <td><?=$program_data['activity']; ?></td>
                      <td><?=$program_data['time']; ?></td>
                      <td><?=$program_data['venue']; ?></td>                       
                    </tr>
                  <?php } } ?>
                    </table>
                </div>
              </div>
          </div>
      </div>
	  </div>
  </div>
</section>


<section class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2 class="heading">Our Church Services</h2>
        </div>
      </div>
    </div>
    <div class="row">      
    	<?php 
    		$service_query = $service->getAll();

    		while($service_data = mysqli_fetch_assoc($service_query)) {

    	 ?>
      <div class="col-md-6 col-lg-4 mb-5">
        <div class="block-20">
          <figure>
            <a href="#"><img src="images/service_images/<?=$service_data['image']; ?>" alt="<?=$service_data['image']; ?>" class="img-fluid"></a>
          </figure>
          <div class="text text-center">
            <h3 class="heading"><a href="#"><?=$service_data['heading']; ?></a></h3>
            <p><?=$service_data['text'] ?></p>
            <!-- <p><a href="#">Read More</a></p> -->
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</section>

<section class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2 class="heading">Zonal Fellowship Meetings</h2>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped table-md v_center">
                      <tr>
                          <th>#</th>
                          <th>Zones</th>
                          <th>Meeting Point</th>
                          <th>Leader</th>
                          <th>Phone Number</th>
                      </tr>
                      <?php 
                        $zone_query = $zone->getAll();

                        $i = 0;

                        while($zone_data = mysqli_fetch_assoc($zone_query)) {
                          $i++;
                       ?>
                      <tr>
                          <td><?=$i; ?></td>
                          <td><?=$zone_data['zone']; ?></td>
                          <td><?=$zone_data['meeting_point']; ?></td>
                          <td><?=$zone_data['leader']; ?></td>
                          <td><a href="tel:/<?=$zone_data['phone_num']; ?>"><?=$zone_data['phone_num']; ?></a></td>
                      </tr>
                    <?php } ?>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</section>
