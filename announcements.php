<?php
	include './classes/service.php';
	include './classes/program.php';

	$banner_query = $banner->getFirst();
	$banner_data = mysqli_fetch_assoc($banner_query);
?>
<section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/banner_images/<?=$banner_data['image']; ?>);">
  <div class="container">
    <div class="row align-items-center justify-content-center site-hero-inner">
      <div class="col-md-8 text-center">

        <div class="mb-5 element-animate">
          <div class="block-17">
            <h1 class="heading mb-4">Church Announcements</h1>
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
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2 class="heading">Announcements</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body text-black">
                <p><?=$about_us->getData('announcement'); ?></p>
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